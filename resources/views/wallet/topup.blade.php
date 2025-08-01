<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4 text-center">💳 Top Up Wallet</h2>

            <form method="POST" action="{{ route('wallet.topup.store') }}">
                @csrf

                <!-- Amount -->
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium">Amount</label>
                    <input type="number" name="amount" id="amount" required step="0.01" min="1"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Currency -->
                <div class="mb-4">
                    <label for="currency_id" class="block text-sm font-medium">Currency</label>
                    <select name="currency_id" id="currency_id" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                        <option value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->code }} (1 {{ $currency->code }} =
                                {{ $currency->rate_to_sar }} SAR)</option>
                        @endforeach
                    </select>
                </div>

                <!-- Card -->
                <div class="mb-4">
                    <label for="card_id" class="block text-sm font-medium">Select Card</label>
                    @if ($cards->isEmpty())
                        <p class="text-sm text-red-600 mt-1">⚠️ You have no saved cards.</p>
                        <a href="{{ route('cards.create') }}" class="text-sm text-blue-600 underline">Add Card</a>
                    @else
                        <select name="card_id" id="card_id" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded">
                            <option value="">Select Card</option>
                            @foreach ($cards as $card)
                                <option value="{{ $card->id }}">
                                    **** **** **** {{ substr($card->card_number, -4) }} ({{ $card->expiry_date }})
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <!-- Trigger Modal -->
                <button type="button" onclick="document.getElementById('feeModal').classList.remove('hidden')"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Add Money
                </button>

                <!-- Fee Confirmation Modal -->
                <div id="feeModal"
                    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 text-center">
                        <h2 class="text-xl font-semibold mb-2">Confirm Top-Up</h2>
                        <p class="text-sm text-gray-600 mb-4">
                            Currency conversion and transfer fees will be applied to this transaction. Do you want to
                            continue?
                        </p>

                        <div class="flex justify-between space-x-4 mt-4">
                            <button onclick="document.getElementById('feeModal').classList.add('hidden')"
                                class="w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                                Cancel
                            </button>

                            <!-- Submit Actual Form -->
                            <button onclick="document.getElementById('topupForm').submit()"
                                class="w-1/2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                Confirm & Add
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
