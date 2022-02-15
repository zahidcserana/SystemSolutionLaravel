<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $user = Customer::create($input);

        return redirect()->route('customers.index')->with('success', 'Customer successfully added.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
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
}
