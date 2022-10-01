<?php

namespace App\Components;

use App\Models\Invoice;
use App\Models\Payment;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Requests\Payment\UpdateRequest;
use App\Http\Requests\Payment\DestroyRequest;


class PaymentComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $payment = Payment::create($input);
        $payment->setStatus();
        $payment->refresh();

        return $payment;
    }

    public function update(UpdateRequest $request, Payment $payment)
    {
        $input = $request->validated();

        $payment->update($input);
        $payment->setStatus();
        $payment->refresh();

        return $payment;
    }

    public function destroy(DestroyRequest $request = null, Payment $payment = null)
    {
        $payment->delete();

        return ['id' => $payment->id, 'amount' => $payment->amount];
    }

    public function adjust(Payment $payment)
    {
        $invoices = $payment->customer->dueInvoices;
        if ($payment->dues > 0) {
            $amount = $payment->dues;
            foreach ($invoices as $invoice) {
                $paidAmount = 0;
                $dueAmount = $invoice->amount - $invoice->paid;

                if ($amount >= $dueAmount) {
                    $paidAmount = $dueAmount;
                    $status = Invoice::STATUS_PAID;
                } else {
                    $paidAmount = $amount;
                    $status = Invoice::STATUS_DUE;
                }

                $amount -= $paidAmount;

                $invoice->paid += $paidAmount;
                $invoice->status = $status;
                $invoice->update();

                $payment->dues -= $paidAmount;
                $payment->adjust += $paidAmount;

                app()->logData->logData($invoice, $dueAmount, $paidAmount, $status);

                if ($amount == 0) {
                    break;
                }
            }

            // $payment->status = $payment->dues > 0 ? Payment::STATUS_ADVANCED : Payment::STATUS_ADJUST;
            $log = app()->logData->getLog();

            if (empty($payment->logs)) {
                $payment->logs = $log;
            } else {
                $payment->logs = array_merge($log, $payment->log);
            }

            $payment->update();
            $payment->setStatus();
            $payment->refresh();
        }

        $payment->customer->balanceUpdate();
        return $payment;
    }
}
