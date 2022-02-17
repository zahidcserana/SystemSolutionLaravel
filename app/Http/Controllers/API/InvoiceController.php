<?php

namespace App\Http\Controllers\API;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceCollection;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Resources\InvoiceResource;
use Illuminate\Support\Arr;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query();
        $collection = Invoice::query();

        $collection->when($request->status, function ($q) use ($request) {
            return $q->where('status', $request['status']);
        });
        $collection->when($request->customer_id, function ($q) use ($request) {
            return $q->where('customer_id', $request['customer_id']);
        });
        $collection->when($request->invoice_no, function ($q) use ($request) {
            return $q->where('invoice_no', 'like', '%' . $request['invoice_no'] . '%');
        });

        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $dateS = date('Y-m-d', strtotime($daterange[0]));
            $dateE = !empty($daterange[1]) ? date('Y-m-d', strtotime($daterange[1])) : $dateS;

            $collection = $collection->whereDate('created_at', '>=', $dateS)->whereDate('created_at', '<=', $dateE);
        }

        $invoices = $collection->latest('id')->paginate(Arr::get($query, 'limit', 20));

        return new InvoiceCollection($invoices);
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
    public function store(StoreRequest $request)
    {
        $invoice = new InvoiceResource(
            app()->invoice->store($request)
        );

        return $this->sendResponse($invoice, 'Invoice saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Invoice $invoice)
    {
        $invoice = new InvoiceResource(
            app()->invoice->update($request, $invoice)
        );

        return $this->sendResponse($invoice, 'Invoice successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return $this->sendResponse($invoice, 'Invoice successfully deleted.');
    }
}
