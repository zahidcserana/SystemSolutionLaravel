<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreRequest;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function create()
    {
        return view('customers.form');
    }

    public function edit(Customer $customer)
    {
        return view('customers.form', ['customer' => $customer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        dd($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $input = $request->except('_token');

        $customer->update($input);

        return back()->with('success', 'Customer successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return back()->with('success', 'Customer successfully deleted.');
    }

    public function invoices(Customer $customer)
    {
        if ($customer->dueInvoices->count()) {
            return view('customers.invoices', ['customer' => $customer, 'invoices' => $customer->dueInvoices, 'invoice' => $customer->dueInvoices->first()]);
        }

        return back()->with('error', 'Customer has no unpaid invoice.');
    }
}
