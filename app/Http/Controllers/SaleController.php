<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Sale;
use Stripe\InvoiceItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\SendStripeInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Invoice as StripeInvoice;


class SaleController extends Controller
{
    public function index()
    {
        $invoices = Sale::with('customer.user', 'createdby')->get();
        return view("sale.list", compact("invoices"));
    }

    public function InvoiceList() {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $invoices = \Stripe\Invoice::all(['limit' => 10]);

            return view("sale.index", ['invoices' => $invoices->data]);

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve invoices: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $customers = Customer::with('user')->get();
        return view("sale.create", compact("customers"));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'product' => 'required|array|min:1',
                'product.*' => 'required|string',
                'qty' => 'required|array|min:1',
                'qty.*' => 'required|numeric|min:1',
                'price' => 'required|array|min:1',
                'price.*' => 'required|numeric|min:0',
                'total' => 'required|array|min:1',
                'total.*' => 'required|numeric|min:0',
            ]);

            $customer = Customer::findOrFail($request->customer_id);
            if (!$customer->stripe_customer_id) {
                throw new \Exception("Customer is not linked with a Stripe customer.");
            }

            Stripe::setApiKey(config('services.stripe.secret'));

            $invoice = \Stripe\Invoice::create([
                'customer' => $customer->stripe_customer_id,
                'collection_method' => 'send_invoice',
                'days_until_due' => 30,
            ]);

            foreach ($request->product as $index => $productName) {
                $qty = $request->qty[$index];
                $unitPrice = $request->price[$index];
                $amountInCents = (int) ($unitPrice * $qty * 100); // Stripe requires cents

                  $invoiceItem = \Stripe\InvoiceItem::create([
                    'customer' =>  $customer->stripe_customer_id,
                    'amount' => $amountInCents,
                    'invoice' => $invoice->id,
                    'description' => "{$productName}"
                ]);
            }
            
            Sale::create([
                'customer_id' => $request->customer_id,
                'createdby' => Auth::id(),
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
                'invoice_stripe_id' => $invoice->id,
                'invoice_payment_link' => $invoice->invoice_pdf,
            ]);

            return redirect()->route('sale.list')->with('success', 'Sale created successfully!');


        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create Sales: ' . $e->getMessage());
        }
    }

    public function SendInvoice(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Use invoice ID from form (you need to add it to the form)
            $invoiceId = $request->invoice_id;

            $invoice = \Stripe\Invoice::retrieve($invoiceId);

            $customerEmail = $invoice->customer_email;
            $hostedInvoiceUrl = $invoice->hosted_invoice_url;
            $invoicePdf = $invoice->invoice_pdf;

            if ($customerEmail) {
                Mail::to($customerEmail)->send(new SendStripeInvoice($hostedInvoiceUrl, $invoicePdf));
                return back()->with('success', 'Invoice sent successfully to ' . $customerEmail);
            } else {
                return back()->with('error', 'Customer email not found.');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send invoice: ' . $e->getMessage());
        }
    }

}
