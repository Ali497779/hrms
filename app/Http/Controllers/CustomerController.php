<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe;
use Stripe\Customer as StripeCustomer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with(['user:id,name,email'])->get();
        return view('customer.list', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        return view('customer.create');
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_customer' => true,
        ]);

        // Create Stripe customer
        Stripe::setApiKey(config('services.stripe.secret'));

        $stripeCustomer = StripeCustomer::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Create local customer and save Stripe customer ID
        Customer::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'stripe_customer_id' => $stripeCustomer->id,
        ]);

        return redirect()->route('customer.list')->with('success', 'Customer Created Successfully!');
    }


    public function detail($id)
    {
        $customerId = $id;
        $customer = Customer::with('user')->findOrFail($customerId);

        // Return a view or JSON as needed, e.g.:
        return view('customer.detail', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::where('id', $id)->with(['user'])->first();
        return view('customer.edit', compact('customer'));
    }


    public function update(Request $request, $id){
        $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email',
            ]);
        $customer =  Customer::where('id', $id)->first(); 
           
        Customer::where('id', $id)->update([
                'name' => $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone ?? $customer->phone,
            ]);
        $user = User::where('id', $customer->user_id)->first();
        User::where('id', $customer->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) ?? $user->password,
            'is_customer' => true,
        ]);

        return redirect()->route('customer.list')->with('success','Customer Updated Successfully!');

    }

    public function delete($id)
    {
        $customer = customer::findOrFail($id);

        // Delete user associated with customer
        User::where('id', $customer->user_id)->delete();

        // Delete customer
        $customer->delete();

        return redirect()->route('customer.list')->with('success', 'customer deleted successfully.');
    }
}
