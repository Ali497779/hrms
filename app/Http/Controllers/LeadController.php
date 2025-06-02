<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Lead::with('createdby')->get();
        return view("lead.list", compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("lead.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'buisness' => $request->buisness,
            'website' => $request->website,
            'service' => $request->service,
            'amount' => $request->amount,
            'remark' => $request->remark,
            'status' => $request->status,
            'source' => $request->source,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('lead.list')->with('success', 'Lead created successfully!');
    }

    public function show($id)
    {
        $lead = Lead::where('id', $id)->with('createdby')->first();
        return view('lead.detail' ,compact('lead'));
    }

    public function edit($id)
    {
        $lead = Lead::where('id', $id)->first();
        return view('lead.edit', compact('lead'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        Lead::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'buisness' => $request->buisness,
            'website' => $request->website,
            'service' => $request->service,
            'amount' => $request->amount,
            'remark' => $request->remark,
            'status' => $request->status,
            'source' => $request->source,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('lead.list')->with('success', 'Lead updated successfully!');
    }


    public function delete($id)
    {
        Lead::where('id', $id)->delete();
        return redirect()->route('lead.list')->with('success', 'Lead deleted successfully.');
    }
}
