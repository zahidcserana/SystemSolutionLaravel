<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;

class EditInvoice extends ModalComponent
{
    public $invoice;

    public function mount(Invoice $invoice)
    {
        // Gate::authorize('update', $customer);

        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.edit-invoice');
    }
}
