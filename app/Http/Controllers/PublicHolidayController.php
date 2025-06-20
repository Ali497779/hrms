<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PublicHoliday;

class PublicHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = PublicHoliday::all();
        return view("holiday.list", compact("holidays"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holiday.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
        if($request->type == 'emergencyholiday'){
             $request->validate([
                'date_single' => 'required|date',
            ]);

            PublicHoliday::create([
                'name' => $request->name,
                'date' => $request->date_single,
            ]);

            return redirect()->route('holiday.list')->with('success', 'Holiday Created Successfully!');

        }else {
            $request->validate([
                'date_from' => 'required|date',
                'date_to' => 'required|date|after_or_equal:date_from',
            ]);

            $start = Carbon::parse($request->date_from);
            $end = Carbon::parse($request->date_to);

            while ($start->lte($end)) {
                PublicHoliday::create([
                    'name' => $request->name,
                    'date' => $start->toDateString(),
                ]);

                $start->addDay(); // move to next day
            }

            return redirect()->route('holiday.list')->with('success', 'Holiday Created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function show(PublicHoliday $publicHoliday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $holiday = PublicHoliday::where('id', $id)->first();
        return view('holiday.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        PublicHoliday::where('id', $id)->update([
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return redirect()->route('holiday.list')->with('success', 'Holiday Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        PublicHoliday::findOrFail($id)->delete();
        return redirect()->route('holiday.list')->with('success','Holiday Deleted Successfully !');
    }
}
