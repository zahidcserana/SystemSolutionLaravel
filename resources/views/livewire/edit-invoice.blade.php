<div class="antialiased text-gray-900 px-6">
    <div class="max-w-xl mx-auto py-12 divide-y md:max-w-4xl">
        <div class="py-12">
            <h2 class="text-2xl font-bold">Update Invoice</h2>
            <div class="mt-8 max-w-md">
                <div class="grid grid-cols-1 gap-6">
                    <form method="post" action="{{ route('invoice.update', ['invoice' => $invoice->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                        <label class="block">
                            <span class="text-gray-700">Amount</span>
                            <input type="number"
                                class="
                                    mt-1
                                    block
                                    w-full
                                    rounded-md
                                    border-gray-300
                                    shadow-sm
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                "
                                placeholder="Amount" value="{{ $invoice->amount }}" name="amount">
                        </label>
                        <label class="mt-2 block">
                            <span class="text-gray-700">Paid</span>
                            <input type="number"
                                class="
                                    mt-1
                                    block
                                    w-full
                                    rounded-md
                                    border-gray-300
                                    shadow-sm
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                "
                                placeholder="Paid" name="paid" value="{{ $invoice->paid }}">
                        </label>
                        <label class="mt-2 block">
                            <span class="text-gray-700">Billing Type: </span>
                            {{ __(\Illuminate\Support\Arr::get(\App\Models\Invoice::$billTypeValues, $invoice->type, 'N/A')) }}
                        </label>

                        <x-button class="mt-4 ml-3">{{ __('Submit') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
