<div>
    <div>
        <x-label for="name" :value="__('Name')" />
        <x-myinput id="name" class="block mt-1 w-full" type="text" wire:model="customer.name" />
        @error('customer.name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mt-4">
        <x-label for="company_name" :value="__('Company Name')" />
    
        <x-myinput id="company_name" class="block mt-1 w-full" type="text" wire:model="customer.company_name" />
    </div>
    <!-- Password -->
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
    
    <div class="mt-4">
        <x-label for="company_type" :value="__('Company Type')" />
    
        <x-myinput id="company_type" class="block mt-1 w-full" type="text" wire:model="customer.company_type" />
    </div>
    <div class="mt-4">
        <x-label for="billing_type" :value="__('Billing Type')" />
    
        <x-myinput id="billing_type" class="block mt-1 w-full" type="text" wire:model="customer.billing_type" />
    </div>
    <div class="mt-4">
        <x-label for="bill_start_date" :value="__('Bill Start Date')" />
    
        <x-myinput id="bill_start_date" class="block mt-1 w-full" type="text" wire:model="customer.bill_start_date" />
        @error('customer.bill_start_date') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mt-4">
        <x-label for="address" :value="__('Address')" />
    
        <x-myinput id="address" class="block mt-1 w-full" type="text" wire:model="customer.address" />
    </div>

    <div class="flex items-center justify-end mt-4">
        @if ($update)
            <x-mybutton class="ml-3">{{ __('Update') }}</x-mybutton>
        @else
            <x-mybutton class="ml-3">{{ __('Save') }}</x-mybutton>
        @endif
    </div>
</div>
