<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;

class EditCustomer extends ModalComponent
{
    public $customer;

    public function mount(Customer $customer)
    {
        // Gate::authorize('update', $customer);

        $this->customer = $customer;
    }

    public function render()
    {
        return view('livewire.edit-customer');
    }
}
