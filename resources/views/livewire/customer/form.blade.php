<div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Personal Details:</h5>
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-myinput id="name" class="block mt-1 w-full" type="text" wire:model="customer.name" />
                @error('customer.name') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
            
                <x-myinput id="email" class="block mt-1 w-full" type="email" wire:model="customer.email" />
                @error('customer.email') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            
            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile')" />
            
                <x-myinput id="mobile" class="block mt-1 w-full" type="text" wire:model="customer.mobile" />
                @error('customer.mobile') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />
            
                <x-myinput id="phone" class="block mt-1 w-full" type="text" wire:model="customer.phone" />
                @error('customer.phone') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Company Details:</h5>
            <div>
                <x-label for="company_name" :value="__('Company Name')" />
            
                <x-myinput id="company_name" class="block mt-1 w-full" type="text" wire:model="customer.company_name" />
            </div>
            
            <div class="mt-4">
                <x-label for="company_type" :value="__('Company Type')" />
            
                <x-myinput id="company_type" class="block mt-1 w-full" type="text" wire:model="customer.company_type" />
            </div>
            <div class="mt-4">
                <x-label for="billing_type" :value="__('Billing Type')" />
                <x-myddl id="billing_type" class="block mt-1 w-full" wire:model="customer.billing_type" :options="$billTypes" />
            </div>
            <div class="mt-4">
                <x-label for="bill_start_date" :value="__('Bill Start Date')" />
            
                <x-myinput id="bill_start_date" class="block mt-1 w-full" type="text" wire:model="customer.bill_start_date" />
                @error('customer.bill_start_date') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
      </div>
    </div>
  </div>
<div>
    <div class="mt-4">
        <x-label for="address" :value="__('Address')" />
    
        <x-myinput id="address" class="block mt-1 w-full" type="text" wire:model="customer.address" />
    </div>

    <div class="flex items-center justify-end mt-4">
        @if ($update)
            <x-nav-link :href="route('customer.create')"
                class="btn btn-secondary float-left items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                + {{ __('New') }}
            </x-nav-link>
            <x-mybutton class="ml-3 btn btn-success">{{ __('Update') }}</x-mybutton>
        @else
            <x-nav-link :href="route('customer.index')"
                class="btn btn-secondary float-left items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('List') }}
            </x-nav-link>
            <x-mybutton class="ml-3 btn btn-success">{{ __('Save') }}</x-mybutton>
        @endif
    </div>
</div>
