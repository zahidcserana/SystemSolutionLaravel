<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentCollection;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Payment\UpdateRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Support\Arr;

class PaymentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query();
        $collection = Payment::query();

        $collection->when($request->status, function ($q) use ($request) {
            return $q->where('status', $request['status']);
        });
        $collection->when($request->customer_id, function ($q) use ($request) {
            return $q->where('customer_id', $request['customer_id']);
        });
        $collection->when($request->method, function ($q) use ($request) {
            return $q->where('method', 'like', '%' . $request['method'] . '%');
        });

        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $dateS = date('Y-m-d', strtotime($daterange[0]));
            $dateE = !empty($daterange[1]) ? date('Y-m-d', strtotime($daterange[1])) : $dateS;

            $collection = $collection->whereDate('created_at', '>=', $dateS)->whereDate('created_at', '<=', $dateE);
        }

        $payments = $collection->latest('id')->paginate(Arr::get($query, 'limit', 20));

        return new PaymentCollection($payments);
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
        $payment = new PaymentResource(
            app()->payment->store($request)
        );

        return $this->sendResponse($payment, 'Payment saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    public function adjust(Payment $payment)
    {
        $payment = new PaymentResource(
            app()->payment->adjust($payment)
        );

        return $this->sendResponse($payment, 'Payment successfully adjusted.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Payment $payment)
    {
        $payment = new PaymentResource(
            app()->payment->update($request, $payment)
        );

        return $this->sendResponse($payment, 'Payment successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return $this->sendResponse($payment, 'Payment successfully deleted.');
    }
}
