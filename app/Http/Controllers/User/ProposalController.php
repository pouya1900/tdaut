<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposalRequest;
use App\Models\Document;
use App\Models\Office;
use App\Models\User;
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
        $rfps = $user->documents()->where('type', 'rfp')->orderBy('created_at', 'desc')->get();
        foreach ($rfps as $rfp) {
            $data[] = [
                'office'      => $rfp->office->name,
                'title'       => $rfp->title,
                'description' => view('front.partials.action', ['modal' => 'description' . $rfp->id, 'modal_title' => trans('trs.show')])->render(),
                'proposal'    => $rfp->proposal ? view('front.partials.action', ['modal' => 'proposal' . $rfp->proposal->id, 'modal_title' => trans('trs.show')])->render() : "",
                'created_at'  => date('Y-m-d H:i', strtotime($rfp->created_at)),
                'file'        => view('front.partials.action', ['download' => $rfp->file])->render(),
            ];
        }

        $proposals = $user->documents()->where('type', 'proposal')->where('parent_id', '>', '0')->get();

        return view('front.users.rfps.index', compact('user', 'data', 'rfps', 'proposals'));
    }

}
