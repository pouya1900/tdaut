<?php

namespace App\Http\Controllers;

use App\Events\SendConfirmationEmailEvent;
use App\Http\Requests\LoginRequest;
use App\Models\Department;
use App\Models\Member;
use App\Models\Profile;
use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $user;
    private $member;
    private $request;
    private $auth;

    public function __construct(User $user, Member $member, Request $request, Auth $auth)
    {
        $this->user = $user;
        $this->member = $member;
        $this->request = $request;
        $this->auth = $auth;
    }


    public function login($type)
    {
        if ($type != "user" && $type != 'member') {
            abort(404);
        }

        if ($this->auth::guard('member')->check()) {
            return redirect(route('profile_show', $this->auth::guard('member')->user()->id));
        }

        if ($this->auth::guard('user')->check()) {
            return redirect(route('user.show', $this->auth::guard('user')->user()->id));
        }

        return view('front.auth.login', compact('type'));
    }


    public function do_member_login(LoginRequest $request)
    {
        $login = $request->input('email');

        // check login field
//        $login_type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
//
//        $request->merge([$login_type => $login]);
//
//        if ($login_type == 'email') {
//            $credentials = $request->only('email', 'password');
//        } else {
//            $credentials = $request->only('username', 'password');
//        }

        $credentials = $request->only('email', 'password');

        if ($this->auth::guard('member')->attempt($credentials, $request->has('remember'))) {

            if (!$this->auth::user()->email_verified_at) {
                $this->auth::logout();
                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['error' => trans('trs.account_not_confirmed_text')]);
            }

            return redirect(route('profile_show', $this->auth::guard('member')->user()->id));
        }


        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => trans('trs.error_logging'),
            ]);


    }

    public function do_user_login(LoginRequest $request)

    {
        $login = $request->input('email');

        // check login field
//        $login_type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

//        $request->merge([$login_type => $login]);
//
//        if ($login_type == 'email') {
//            $credentials = $request->only('email', 'password');
//        } else {
//            $credentials = $request->only('username', 'password');
//        }

        $credentials = $request->only('email', 'password');


        if ($this->auth::guard('user')->attempt($credentials, $request->has('remember'))) {
            return redirect(route('user_show', $this->auth::guard('user')->user()->id));
        }


        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => trans('trs.error_logging'),
            ]);

    }

    public function logout()
    {
        $this->auth::guard('member')->logout();
        $this->auth::guard('user')->logout();

        return redirect(route('index'));
    }

    public function register_member()
    {
        $ranks = Rank::all();
        $departments = Department::all();

        return view('front.auth.register_member', compact('ranks', 'departments'));
    }

    public function register_user()
    {
        return view('front.auth.register_user');
    }

    public function do_register_member()
    {
        $type = $this->request->input('type');

        $validation = [
            "type"       => "required|in:1,2,3",
            "email"      => "required|unique:members,email",
            "username"   => "required|unique:profiles,username",
            "first_name" => "required",
            "last_name"  => "required",
            "gender"     => "required",
            "password"   => "required|confirmed",
        ];
        $save = [
            'email'    => $this->request->input('email'),
            'password' => bcrypt($this->request->input('password')),
        ];
        $save_profile = [
            'username'   => $this->request->input('username'),
            'first_name' => $this->request->input('first_name'),
            'last_name'  => $this->request->input('last_name'),
            'gender'     => $this->request->input('gender'),
        ];

        if ($type == 1) {

            $save['type'] = 'professor';
            $save['rank_id'] = $this->request->input('rank');
            $save['department_id'] = $this->request->input('department');
            $save['group'] = $this->request->input('group');


            $validation["rank"] = "required|exists:ranks,id";
            $validation["department"] = "required|exists:departments,id";
            $validation["group"] = "required";
        } else if ($type == 2) {
            $save['type'] = 'student';
            $save['department_id'] = $this->request->input('department');
            $save['degree_id'] = $this->request->input('degree');
            $save['student_number'] = $this->request->input('student_number');

            $validation["department"] = "required|exists:departments,id";
            $validation["degree"] = "required|exists:degrees,id";
            $validation["student_number"] = "required";

        } else if ($type == 3) {
            $save['type'] = 'staff';
            $save['degree_id'] = $this->request->input('degree');

            $validation["degree"] = "required|exists:degrees,id";
        }


        $validator = Validator::make($this->request->all(), $validation);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        do {
            $token = Str::random(12);
        } while ($this->member->where('confirmation_token', $token)->first());

        $save["confirmation_token"] = $token;

        $member = $this->member->create($save);

        $profile = $member->profile()->create($save_profile);

        $link = route('confirmation_email_member', ['token' => $member->confirmation_token]);

//        Event::dispatch(new SendConfirmationEmailEvent($member->email, $link));

        return view('front.auth.registered');
    }


    public function do_register_user()
    {

        $type = $this->request->input('type');

        $role = Role::where('name', 'employer')->first();

        $validation = [
            "type"       => "required|in:1,2",
            "email"      => "required|unique:users,email",
            "username"   => "required|unique:profiles,username",
            "first_name" => "required",
            "password"   => "required|confirmed",
        ];
        $save = [
            'email'    => $this->request->input('email'),
            'password' => bcrypt($this->request->input('password')),
            'role_id'  => $role->id,
            'status'   => 'pending',
        ];

        $save_profile = [
            'username'   => $this->request->input('username'),
            'first_name' => $this->request->input('first_name'),
        ];

        if ($type == 1) {
            $save['type'] = 'real';
            $save_profile['gender'] = $this->request->input('gender');
            $save_profile['last_name'] = $this->request->input('last_name');


            $validation["gender"] = "required";
            $validation["last_name"] = "required";
        } else if ($type == 2) {
            $save['type'] = 'legal';
        }


        $validator = Validator::make($this->request->all(), $validation);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        do {
            $token = Str::random(12);
        } while ($this->user->where('confirmation_token', $token)->first());

        $save["confirmation_token"] = $token;

        $user = $this->user->create($save);

        $profile = $user->profile()->create($save_profile);

        $link = route('confirmation_email_user', ['token' => $user->confirmation_token]);

//        Event::dispatch(new SendConfirmationEmailEvent($user->email, $link));

        return view('front.auth.registered');

    }


    public function confirmation_email_member($toekn)
    {
        $member = $this->member->where('confirmation_token', $toekn)->first();

        if (!$member) {
            return view('front.aut.confirmation')->withErrors(['error' => trans('trs.failed_confirmation')]);
        }

        if (!$member->email_verified_at) {
            $now = date('Y-m-d H:i:s', strtotime('now'));
            $member->update(['email_verified_at' => $now]);
        }


        return view('front.auth.confirmation');
    }

    public function confirmation_email_user($toekn)
    {
        $user = $this->user->where('confirmation_token', $toekn)->first();

        if (!$user) {
            return view('front.aut.confirmation')->withErrors(['error' => trans('trs.failed_confirmation')]);
        }

        $now = date('Y-m-d H:i:s', strtotime('now'));
        $user->update(['email_verified_at' => $now]);
        return view('front.auth.confirmation');
    }

}
