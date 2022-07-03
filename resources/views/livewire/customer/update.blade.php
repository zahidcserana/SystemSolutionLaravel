<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="update">
                        <input type="hidden" wire:model="customer_id">

                        @include('livewire.customer.form', ['update' => $update])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
