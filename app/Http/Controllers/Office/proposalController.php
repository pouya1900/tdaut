<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposalRequest;
use App\Models\Document;
use App\Models\Office;
use App\Models\Rfp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

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
        $rfps = $office->rfps;
        foreach ($rfps as $rfp) {
            $data[] = [
                'user'       => $rfp->user->profile->fullName,
                'title'      => $rfp->title,
                'created_at' => date('Y-m-d H:i', strtotime($rfp->created_at)),
                'action'     => view('front.partials.action', ['show' => route('mg.rfp.show', ['office' => $office->id, 'rfp' => $rfp->id])])->render(),
            ];
        }

        return view('office.rfps.index', compact('office', 'data', 'rfps'));
    }

    public function show(Office $office, Rfp $rfp)
    {
        return view('office.rfps.show', compact('office', 'rfp'));
    }

    public function create(Office $office, Rfp $rfp)
    {
        return view('office.rfps.create_proposal', compact('office', 'rfp'));
    }

    public function store(StoreProposalRequest $request, Office $office, Rfp $rfp)
    {
        try {
            if ($rfp->office->id != $office->id) {
                abort(403);
            }

            $current_member = $this->request->current_member;

            $proposal = $rfp->documents()->create([
                "text"   => $request->input('description'),
                'type'   => 'proposal',
                'status' => $current_member->id == $office->head->id ? 'sent' : 'pending',
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

            return redirect(route('mg.rfp.show', ['office' => $office->id, 'rfp' => $rfp->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function send(Office $office, Document $document)
    {
        try {
            if ($document->rfp->office->id != $office->id) {
                abort(403);
            }
            if ($this->request->current_member->id != $office->head->id) {
                abort(403);
            }

            $document->update([
                'status' => 'sent',
            ]);

            return redirect(route('mg.rfp.show', ['office' => $office->id, 'rfp' => $document->rfp->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function delete(Office $office, Document $document)
    {
        try {
            if ($document->rfp->office->id != $office->id) {
                abort(403);
            }
            if ($this->request->current_member->id != $office->head->id) {
                abort(403);
            }

            $document->delete();

            return redirect(route('mg.rfp.show', ['office' => $office->id, 'rfp' => $document->rfp->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }


}
