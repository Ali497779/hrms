<?php

namespace App\Http\Controllers;

use App\Models\Dollar;
use Illuminate\Http\Request;

class DollarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dollar = Dollar::latest()->first();
        return view("dollar.create", compact("dollar"));
    }


    public function store(Request $request)
    {
        Dollar::latest()->first()->update([
            'rate' => $request->rate
        ]);
        return redirect()->route('setting.dollar')->with('success','Dollar Rate has been Updated !');
    }
}
