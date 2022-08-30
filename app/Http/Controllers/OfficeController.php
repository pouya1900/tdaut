<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{

    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    /**
     *main page of offices
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $offices = $this->office->active()->get();

        $departments = Department::all();

        return view('front.offices.index', compact('offices', 'departments'));
    }

    /**
     * show office
     *
     * @param Office $office
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Office $office)
    {
        return view('front.offices.show', compact('office'));
    }

}
