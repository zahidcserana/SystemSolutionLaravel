<?php

namespace App\Components;

use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Requests\Invoice\DestroyRequest;
use App\Models\Invoice;


class InvoiceComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $invoice = Invoice::create($input);
        $invoice->setStatus();
        $invoice->refresh();
        $invoice->customer->balanceUpdate();

        return $invoice;
    }

    public function update(UpdateRequest $request, Invoice $invoice)
    {
        $input = $request->validated();

        $invoice->update($input);
        $invoice->setStatus();
        $invoice->refresh();
        $invoice->customer->balanceUpdate();

        return $invoice;
    }

    public function destroy(DestroyRequest $request = null, Invoice $invoice = null)
    {
        $invoice->delete();

        return ['id' => $invoice->id, 'amount' => $invoice->amount];
    }
}
