<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerTableResource;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CustomerResource;

class CustomerController extends BaseController
{
    public function index(Request $request)
    {
        $query = $request->query();
        $collection = Customer::query();

        $collection->when($request->term, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request['term'] . '%')
                ->orWhere('email', 'like', '%' . $request['term'] . '%')
                ->orWhere('mobile', 'like', '%' . $request['term'] . '%');
        });

        $customers = $collection->latest('id')->paginate(Arr::get($query, 'limit', 20));

        return new CustomerCollection($customers);
    }

    public function list()
    {
        $customers = Customer::get();

        return CustomerTableResource::collection($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
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
}
