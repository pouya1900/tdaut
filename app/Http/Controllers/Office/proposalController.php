<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposalRequest;
use App\Models\Document;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class proposalController extends Controller
{
    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    public function index(Office $office)
    {

        $data = [];
        $rfps = $office->documents()->where('type', 'rfp')->get();
        foreach ($rfps as $rfp) {
            $data[] = [
                'user'        => $rfp->user->profile->fullName,
                'title'       => $rfp->title,
                'description' => view('office.includes.action', ['modal' => 'description' . $rfp->id, 'modal_title' => trans('trs.show')])->render(),
                'proposal'    => $rfp->proposal ? view('office.includes.action', ['modal' => 'proposal' . $rfp->proposal->id, 'modal_title' => trans('trs.show')])->render() : "",
                'created_at'  => date('Y-m-d H:i', strtotime($rfp->created_at)),
                'file'        => view('office.includes.action', ['download' => $rfp->file])->render(),
                'action'      => view('office.includes.action', ['send_proposal' => route('mg.create_proposal', ['office' => $office->id, 'document' => $rfp->id])])->render(),
            ];
        }

        $proposals = $office->documents()->where('type', 'proposal')->where('parent_id', '>', '0')->get();

        return view('office.rfps.index', compact('office', 'data', 'rfps', 'proposals'));
    }

    public function create(Office $office, Document $document)
    {
        return view('office.rfps.create_proposal', compact('office', 'document'));
    }

    public function store(StoreProposalRequest $request, Office $office, Document $document)
    {
        $proposal = $office->documents()->create([
            "title"       => $request->input('title'),
            "description" => $request->input('description'),
            'user_id'     => $document->user_id,
            'type'        => 'proposal',
            'parent_id'   => $document->id,
        ]);

        if ($request->hasFile('proposal')) {
            $file = $request->file('proposal');
            Storage::disk("privateStorage")->put('rfp', $file);

            $proposal->media()->create([
                "title"      => $file->hashName(),
                "model_type" => "rfp",
                "ext"        => $file->extension(),
                "size"       => $file->getSize() / 1024,
            ]);
        }

        return redirect(route('mg.rfps', $office->id));
    }
}
