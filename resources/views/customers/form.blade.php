<x-app-layout>
    <!-- Page Heading -->
    {{-- <x-header>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Customer') }}
                <x-nav-link :href="route('customer.index')"
                    class="float-right items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('List') }}
                </x-nav-link>
            </h2>
        </x-slot>
    </x-header> --}}
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (empty($customer))
                        @livewire('customers')
                    @else
                        @livewire('customers', ['customer' => $customer])
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
