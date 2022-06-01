<div class="antialiased text-gray-900 px-6">
    <div class="max-w-xl mx-auto py-12 divide-y md:max-w-4xl">
        <div class="py-12">
            <h2 class="text-2xl font-bold">Update Customer</h2>
            <div class="mt-8 max-w-md">
                <div class="grid grid-cols-1 gap-6">
                    <form method="post" action="{{ route('customer.update', ['customer' => $customer->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <label class="block">
                            <span class="text-gray-700">Full name</span>
                            <input type="text"
                                class="
                                    mt-1
                                    block
                                    w-full
                                    rounded-md
                                    border-gray-300
                                    shadow-sm
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                "
                                placeholder="" value="{{ $customer->name }}" name="name">
                        </label>
                        <label class="mt-2 block">
                            <span class="text-gray-700">Email</span>
                            <input type="email"
                                class="
                                    mt-1
                                    block
                                    w-full
                                    rounded-md
                                    border-gray-300
                                    shadow-sm
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                "
                                placeholder="Email" name="email" value="{{ $customer->email }}">
                        </label>
                        <label class="mt-2 block">
                            <span class="text-gray-700">Mobile</span>
                            <input type="text"
                                class="
                                    mt-1
                                    block
                                    w-full
                                    rounded-md
                                    border-gray-300
                                    shadow-sm
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                "
                                placeholder="Mobile" name="mobile" value="{{ $customer->mobile }}">
                        </label>
                        <label class="mt-2 block">
                            <span class="text-gray-700">Billing Type</span>
                            <select
                                class="
                                        block
                                        w-full
                                        mt-1
                                        rounded-md
                                        border-gray-300
                                        shadow-sm
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                    " name="billing_type">
                                    @foreach(\App\Models\Customer::BILL_TYPES as $key => $value)
                                        <option {{ $customer->billing_type == $key ? "selected='selected'" : "" }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                            </select>
                        </label>
                        <label class="mt-2 block">
                            <span class="text-gray-700">Address</span>
                            <textarea
                                class="
                                        mt-1
                                        block
                                        w-full
                                        rounded-md
                                        border-gray-300
                                        shadow-sm
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                    "
                                rows="3" name="address" value="{{ $customer->address }}">{{ $customer->address }}</textarea>
                        </label>

                        <x-button class="mt-4 ml-3">{{ __('Submit') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
