<?php

namespace App\Http\Controllers;

use App\Events\SendConfirmationEmailEvent;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\MemberLoginRequest;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Email;
use App\Models\Member;
use App\Models\Profile;
use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use App\Services\hampa;
use App\Traits\UploadUtilsTrait;
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

    use UploadUtilsTrait;

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
            if ($type == 'user') {
                return redirect(route('profile_show', $this->auth::guard('member')->user()->id))->with('account_alert', trans('trs.you_are_logged_in_as_member_please_logout_first'));
            }
            return redirect(route('profile_show', $this->auth::guard('member')->user()->id));
        }

        if ($this->auth::guard('user')->check()) {
            if ($type == 'member') {
                return redirect(route('user.show', $this->auth::guard('user')->user()->id))->with('account_alert', trans('trs.you_are_logged_in_as_user_please_logout_first'));
            }
            return redirect(route('user.show', $this->auth::guard('user')->user()->id));
        }

        return view('front.auth.login', compact('type'));
    }


    public function do_member_login(MemberLoginRequest $request)
    {
        $username = $request->input('username');

        $profile = Profile::where('username', $username)->first();

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

        if ($profile) {
            $credentials = ['email' => $profile->profileable->email, 'password' => $request->input('password')];

            if ($this->auth::guard('member')->attempt($credentials, $request->has('remember'))) {

                if (!$this->auth::guard('member')->user()->email_verified_at) {
                    $this->auth::guard('member')->logout();
                    return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors(['error' => trans('trs.account_not_confirmed_text')]);
                }

                $hampa = new hampa();

                $hampa->login($this->auth::guard('member')->user(), $request->input('password'));

                return redirect(route('profile_show', $this->auth::guard('member')->user()->id));
            }
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

            if (!$this->auth::guard('user')->user()->email_verified_at) {
                $this->auth::guard('user')->logout();
                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['error' => trans('trs.account_not_confirmed_text')]);
            }

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
        if ($this->auth::guard('member')->check()) {
            return redirect(route('profile_show', $this->auth::guard('member')->user()->id));
        }
        if ($this->auth::guard('user')->check()) {
            return redirect(route('user.show', $this->auth::guard('user')->user()->id));
        }

        $ranks = Rank::all();
        $departments = Department::all();
        $degrees = Degree::all();

        $link = route('check_professor');

        $data = [
            'ranks'       => $ranks,
            'departments' => $departments,
            'degrees'     => $degrees,
            'trans'       => trans('trs'),
        ];

        return view('front.auth.register_member', compact('data', 'link'));
    }

    public function register_user()
    {
        if ($this->auth::guard('member')->check()) {
            return redirect(route('profile_show', $this->auth::guard('member')->user()->id));
        }
        if ($this->auth::guard('user')->check()) {
            return redirect(route('user.show', $this->auth::guard('user')->user()->id));
        }

        $data = [
            'trans' => trans('trs'),
        ];

        return view('front.auth.register_user', compact('data'));
    }

    public function do_register_member()
    {
        $type = $this->request->input('type');

        $validation = [
            "type"       => "required|in:1,2,3",
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
            $validation["email"] = "required";
            $validation["username"] = "required|exists:profiles,username";

        } else if ($type == 2) {
            $save['type'] = 'student';
            $save['department_id'] = $this->request->input('department');
            $save['degree_id'] = $this->request->input('degree');
            $save['student_number'] = $this->request->input('student_number');

            $validation["department"] = "required|exists:departments,id";
            $validation["degree"] = "required|exists:degrees,id";
            $validation["student_number"] = "required";
            $validation["email"] = "required|unique:members,email";
            $validation["username"] = "required|unique:profiles,username";

        } else if ($type == 3) {
            $save['type'] = 'staff';
            $save['degree_id'] = $this->request->input('degree');

            $validation["degree"] = "required|exists:degrees,id";
            $validation["email"] = "required|unique:members,email";
            $validation["username"] = "required|unique:profiles,username";

        }


        $validator = Validator::make($this->request->all(), $validation);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        do {
            $token = Str::random(12);
        } while ($this->member->where('confirmation_token', $token)->first());

        $save["confirmation_token"] = $token;

        if ($type == 1) {
            $username = $this->request->input('username');
            $member = Profile::where('username', $username)->first()->profileable;
            $member->update($save);
            $profile = $member->profile()->update($save_profile);
        } else {
            $member = $this->member->create($save);
            $profile = $member->profile()->create($save_profile);
        }


        $link = route('confirmation_email_member', ['token' => $member->confirmation_token]);

//        Event::dispatch(new SendConfirmationEmailEvent($member->email, $link));

        return redirect(route('registered', 'member') . "?link=" . $link);

    }


    public function do_register_user()
    {

        $type = $this->request->input('type');

        $role = Role::where('name', 'employer')->first();

        $validation = [
            "type"     => "required|in:1,2",
            "email"    => "required|unique:users,email",
            "password" => "required|confirmed",
        ];
        $save = [
            'email'    => $this->request->input('email'),
            'password' => bcrypt($this->request->input('password')),
            'role_id'  => $role->id,
            'status'   => 'pending',
        ];

        $save_profile = [
        ];

        if ($type == 1) {
            $save['type'] = 'real';
            $save_profile['first_name'] = $this->request->input('first_name');
            $save_profile['last_name'] = $this->request->input('last_name');
            $save_profile['gender'] = $this->request->input('gender');

            $validation["first_name"] = "required";
            $validation["last_name"] = "required";
            $validation["gender"] = "required";
        } else if ($type == 2) {
            $save['type'] = 'legal';
            $save_profile['first_name'] = $this->request->input('agent_first_name');
            $save_profile['last_name'] = $this->request->input('agent_last_name');
            $save['company_name'] = $this->request->input('name');
            $save['phone'] = $this->request->input('phone');

            $validation["agent_first_name"] = "required";
            $validation["agent_last_name"] = "required";
            $validation["name"] = "required";

            if (!$this->request->hasFile('card') && !$this->request->input('phone')) {
                return redirect()->back()->withInput()->withErrors(['error' => trans('trs.you_should_provide_visit_card_or_phone')]);
            }

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

        if ($this->request->hasFile('card')) {
            $card = $this->request->file('card');

            $this->imageUpload($card, 'visitCard', 'privateStorage', $profile);
        }

        $link = route('confirmation_email_user', ['token' => $user->confirmation_token]);

//        Event::dispatch(new SendConfirmationEmailEvent($user->email, $link));

        return redirect(route('registered', 'user') . "?link=" . $link);

    }

    public function registered($type)
    {
        $link = $this->request->link;
        return view('front.auth.registered', compact('type', 'link'));

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

        $type = 'member';
        return view('front.auth.confirmation', compact('type'));
    }

    public function confirmation_email_user($toekn)
    {
        $user = $this->user->where('confirmation_token', $toekn)->first();

        if (!$user) {
            return view('front.aut.confirmation')->withErrors(['error' => trans('trs.failed_confirmation')]);
        }

        $now = date('Y-m-d H:i:s', strtotime('now'));
        $user->update(['email_verified_at' => $now]);

        $type = 'user';
        return view('front.auth.confirmation', compact('type'));
    }

    public function check_professor()
    {
        $username = $this->request->national_id;

        if ($profile = Profile::where('username', $username)->first()) {
            if ($profile->profileable->type != 'professor') {
                return false;
            }
            return ['profile' => $profile, 'member' => $profile->profileable];
        }
        return false;
    }

}
