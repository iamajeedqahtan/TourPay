<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white p-6 rounded-lg shadow w-full max-w-md text-center">
            <h2 class="text-lg font-semibold mb-4">Create Mada Digital Card</h2>
            <p class="text-sm text-gray-600 mb-6">This will generate a simulated Mada card</p>

            <form method="POST" action="{{ route('mada.store') }}">
                @csrf
                <button type="submit"
                        class="w-full py-3 bg-blue-100 text-blue-800 rounded-lg border border-blue-300 hover:bg-blue-200">
                    💳 Confirm & Create Card
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
