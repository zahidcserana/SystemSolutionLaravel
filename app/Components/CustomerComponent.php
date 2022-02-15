<?php

namespace App\Components;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Requests\Customer\DestroyRequest;
use App\Models\Customer;


class CustomerComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $customer = Customer::create($input);
        $customer->refresh();

        return $customer;
    }

    public function update(UpdateRequest $request, Customer $customer)
    {
        $input = $request->validated();

        $customer->update($input);
        $customer->refresh();

        return $customer;
    }

    public function destroy(DestroyRequest $request = null, Customer $customer = null)
    {
        $customer->delete();

        return ['id' => $customer->id, 'amount' => $customer->amount];
    }
}
