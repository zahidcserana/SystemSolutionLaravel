<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Invoice;
use Livewire\Component;

class Dashboard extends Component
{
    public $customer;
    public $invoice;

    public function mount()
    {
        // Gate::authorize('update', $customer);

        $this->customer = Customer::count();
        $this->invoice = Invoice::count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
