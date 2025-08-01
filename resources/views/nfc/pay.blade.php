<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <form method="POST" action="{{ route('nfc.pay.process') }}"
            class="bg-white shadow p-6 rounded-xl w-full max-w-md text-center">
            @csrf
            <h2 class="text-xl font-bold mb-4">💳 Simulate NFC Payment</h2>

            <input type="number" name="amount" step="0.01" min="0.01"placeholder="Enter amount (SAR)" required
                class="border border-gray-300 rounded w-full p-2 mb-4" />

            @error('amount')
                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
            @enderror

            @if (session('error'))
                <div class="text-red-600 text-sm mb-4">{{ session('error') }}</div>
            @endif

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">
                Tap to Pay 🚀
            </button>
        </form>
    </div>
</x-app-layout>
