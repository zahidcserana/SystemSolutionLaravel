<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class Customers extends Component
{
    public $customer_id;
    public Customer $customer;
    public $update = false;
    public $billTypes;

    protected $rules = [
        'customer.name' => ['sometimes'],
        'customer.email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
        'customer.mobile' => ['required', 'string', 'max:20', 'unique:customers,mobile'],
        'customer.phone' => ['required', 'string', 'max:20', 'unique:customers,phone'],
        'customer.address' => ['sometimes'],
        'customer.company_name' => ['sometimes'],
        'customer.company_type' => ['sometimes'],
        'customer.billing_type' => ['sometimes'],
        'customer.bill_start_date' => ['sometimes', 'date_format:Y-m-d']
    ];

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function render()
    {
        $this->billTypes = Customer::BILL_TYPES;
        if (empty($this->customer->id)) {
            return view('livewire.customer.create');
        } else {
            $this->update = true;
            return view('livewire.customer.update');
        }
    }

    public function updateRequest()
    {
        return [
            'customer.name' => ['sometimes'],
            'customer.email' => ['required', 'string', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($this->customer->id)],
            'customer.mobile' => ['required', 'string', 'max:20', Rule::unique('customers', 'mobile')->ignore($this->customer->id)],
            'customer.phone' => ['required', 'string', 'max:20', Rule::unique('customers', 'phone')->ignore($this->customer->id)],
            'customer.address' => ['sometimes'],
            'customer.company_name' => ['sometimes'],
            'customer.company_type' => ['sometimes'],
            'customer.billing_type' => ['sometimes'],
            'customer.bill_start_date' => ['sometimes', 'date_format:Y-m-d']
        ];
    }

    public function store()
    {
        $this->validate();
        $this->customer->save();
        session()->flash('message', 'Customer Created Successfully.');
    }

    public function update()
    {
        $this->validate($this->updateRequest());
        $this->customer->update();
        session()->flash('message', 'Customer Updated Successfully.');
    }
}
