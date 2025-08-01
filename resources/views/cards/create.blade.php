<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white p-6 rounded-xl shadow w-full max-w-md">
            <h2 class="text-lg font-semibold text-center mb-4">Add Credit Card</h2>

            <form method="POST" action="{{ route('cards.store') }}">
                @csrf

                <!-- Card Number -->
                <div class="mb-4">
                    <x-input-label for="card_number" value="Card Number (16 digits)" />
                    <x-text-input id="card_number" name="card_number" type="text" class="mt-1 block w-full"
                        maxlength="16" required />
                    <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
                </div>

                <!-- Expiry Date -->
                <div class="mb-4">
                    <x-input-label for="expiry_date" value="Expiry Date (MM/YY)" />
                    <x-text-input id="expiry_date" name="expiry_date" type="text" class="mt-1 block w-full"
                        placeholder="MM/YY" required />
                    <x-input-error :messages="$errors->get('expiry_date')" class="mt-2" />
                </div>

                <!-- Cardholder Name -->
                <div class="mb-6">
                    <x-input-label for="cardholder_name" value="Cardholder Name" />
                    <x-text-input id="cardholder_name" name="cardholder_name" type="text" class="mt-1 block w-full"
                        required />
                    <x-input-error :messages="$errors->get('cardholder_name')" class="mt-2" />
                </div>

                <!-- CVV (Optional) -->
                <div class="mb-6">
                    <x-input-label for="cvv" value="CVV (3 digits)" />
                    <x-text-input id="cvv" name="cvv" type="text" class="mt-1 block w-full"
                        maxlength="3" />
                    <x-input-error :messages="$errors->get('cvv')" class="mt-2" />
                </div>

                <x-primary-button class="w-full justify-center">
                    Save Card
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
