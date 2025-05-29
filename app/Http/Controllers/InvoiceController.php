<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('customer.user', 'createdby')->get();
        return view("invoice.list", compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::with('user')->get();
        return view("invoice.create", compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id'       => 'required|exists:customers,id',
                'createdby'         => 'required|exists:users,id',
                'product'           => 'required|array|min:1',
                'product.*'         => 'required|string',
                'qty'               => 'required|array|min:1',
                'qty.*'             => 'required|numeric|min:1',
                'price'             => 'required|array|min:1',
                'price.*'           => 'required|numeric|min:0',
                'total'             => 'required|array|min:1',
                'total.*'           => 'required|numeric|min:0',
                'invoice_description' => 'nullable|string',
                'sub_total'         => 'nullable|numeric',
                'tax_percent'       => 'nullable|numeric',
                'tax_amount'        => 'nullable|numeric',
                'total_amount'      => 'nullable|numeric',
                'issue_date'        => 'nullable|date',
            ], [
                'customer_id.required' => 'Select Customer Please.',
                'customer_id.exists'   => 'Selected customer does not exist.',
            ]);

            Invoice::create([
                'customer_id' => $request->customer_id,
                'createdby' => Auth::user()->id,
                'product' => json_encode($request->product),
                'qty' => json_encode($request->qty),
                'price' => json_encode($request->price),
                'total' => json_encode($request->total),
                'invoice_description' => $request->invoice_description,
                'sub_total' => $request->sub_total,
                'tax_percent' => $request->tax_percent,
                'tax_amount' => $request->tax_amount,
                'total_amount' => $request->total_amount,
                'issue_date' => now(),
            ]);

            return redirect()->route('invoice.list')->with('success', 'Invoice created successfully!');
            
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('validation_errors', 'Please fix the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the Invoice: ' . $e->getMessage());
        }
    }


    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
