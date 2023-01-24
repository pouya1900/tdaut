<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\StoreRfpByIdRequest;
use App\Models\Document;
use App\Models\Office;
use App\Models\Rfp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->request->current_user;

        $data = [];
        $rfps = $user->rfps()->orderBy('created_at', 'desc')->get();
        foreach ($rfps as $rfp) {
            $data[] = [
                'office'     => $rfp->office->name,
                'title'      => $rfp->title,
                'created_at' => date('Y-m-d H:i', strtotime($rfp->created_at)),
                'action'     => view('front.partials.action', ['show' => route('user_rfp_show', ['rfp' => $rfp->id])])->render(),
            ];
        }

        return view('front.users.rfps.index', compact('user', 'data', 'rfps'));
    }

    public function show(Rfp $rfp)
    {
        $user = $this->request->current_user;

        if ($rfp->user->id != $user->id) {
            abort(403);
        }

        foreach ($rfp->documents as $document) {
            if (!$document->seen_at && $document->type == "proposal") {
                $document->update([
                    'seen_at' => date('Y-m-d H:i', strtotime('now')),
                ]);
            }
        }

        return view('front.users.rfps.show', compact('rfp', 'user'));
    }

    public function create(Rfp $rfp)
    {
        $user = $this->request->current_user;

        if ($rfp->user->id != $user->id) {
            abort(403);
        }

        return view('front.users.rfps.create_rfp', compact('rfp', 'user'));
    }

    public function store(StoreProposalRequest $request, Rfp $rfp)
    {
        $user = $this->request->current_user;

        if ($rfp->user->id != $user->id) {
            abort(403);
        }

        $document = $rfp->documents()->create([
            "text" => $request->input('description'),
            'type' => 'rfp',
        ]);

        if ($request->hasFile('proposal')) {
            $file = $request->file('proposal');
            Storage::disk("privateStorage")->put('rfp', $file);

            $document->media()->create([
                "title"      => $file->hashName(),
                "model_type" => "rfp",
                "ext"        => $file->extension(),
                "size"       => $file->getSize() / 1024,
            ]);
        }

        return redirect(route('user_rfp_show', ['rfp' => $rfp->id]));
    }

    public function create_rfp()
    {
        $user = $this->request->current_user;

        return view('front.users.rfps.new_rfp', compact('user'));
    }

    public function store_rfp(StoreRfpByIdRequest $request)
    {
        $rfp = Rfp::create([
            "title"        => $request->input('title'),
            "description"  => $request->input('description'),
            "short_title"  => $request->input('short_title'),
            "goals"        => $request->input('goals'),
            "achievements" => $request->input('achievements'),
            'office_id'    => $request->input('office_id'),
            'user_id'      => $this->request->current_user->id,
        ]);

        if ($request->hasFile('rfp')) {
            $file = $request->file('rfp');
            Storage::disk("privateStorage")->put('rfp', $file);

            $rfp->media()->create([
                "title"      => $file->hashName(),
                "model_type" => "rfp",
                "ext"        => $file->extension(),
                "size"       => $file->getSize() / 1024,
            ]);
        }

        return redirect(route('user_rfps'));
    }

}
