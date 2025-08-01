<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Wallet') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if (session('add-credit-success'))
                <div class="fixed inset-0 flex items-center justify-center bg-white z-50">
                    <div class="text-center animate-pulse">
                        <div class="text-blue-600 text-3xl font-bold mb-2">🎉 Credit Card Added!</div>
                        <p class="text-gray-700">Your credit card is ready to use.</p>
                    </div>
                    <script>
                        setTimeout(() => {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 3000);
                    </script>
                </div>
            @elseif (session('add-mada-success'))
                <div class="fixed inset-0 flex items-center justify-center bg-white z-50">
                    <div class="text-center animate-pulse">
                        <div class="text-blue-600 text-3xl font-bold mb-2">🎉 Mada Card Created!</div>
                        <p class="text-gray-700">Your Mada digital card is ready to use.</p>
                    </div>
                    <script>
                        setTimeout(() => {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 3000);
                    </script>
                </div>
            @elseif (session('add-money-success'))
                <div class="fixed inset-0 flex items-center justify-center bg-white z-50">
                    <div class="text-center animate-pulse">
                        <div class="text-blue-600 text-3xl font-bold mb-2">💰 Money Added!</div>
                        <p class="text-gray-700">Your wallet has been topped up successfully.</p>
                    </div>
                    <script>
                        setTimeout(() => {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 3000);
                    </script>
                </div>
            @endif

            <!-- Optional Sections -->
            @if (auth()->user()->madaCard)
                <div
                    class="relative bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-xl shadow p-6 mt-6 overflow-hidden">
                    <div class="text-sm mb-1 uppercase tracking-wide">Mada Digital Card</div>
                    <div class="text-lg font-bold mb-3">**** **** ****
                        {{ substr(auth()->user()->madaCard->card_number, -4) }}</div>
                    <div class="flex justify-between text-xs">
                        <span>EXP: {{ auth()->user()->madaCard->expiry_date }}</span>
                        <span>Status: {{ ucfirst(auth()->user()->madaCard->status) }}</span>
                    </div>

                    <!-- Mada SVG Logo Bottom Right -->
                    <img src="{{ asset('images/mada-logo.svg') }}" alt="Mada Logo"
                        class="absolute bottom-5 right-4 w-16 opacity-90">
                </div>
            @endif

            <!-- Wallet Balance Card -->
            <div class="bg-white rounded-xl shadow p-4 my-6 text-center">
                <p class="text-gray-500 text-sm">Your Wallet Balance</p>
                <p class="text-3xl font-bold text-blue-600">SAR
                    {{ number_format(auth()->user()->wallet->balance ?? 0, 2) }}</p>
            </div>

            <!-- Add Money Button -->
            <div class="mb-4">
                @if (auth()->user()->cards->isEmpty())
                    <a href="{{ route('cards.create') }}"
                        class="block w-full text-center bg-blue-100 text-blue-800 py-3 rounded-lg border border-blue-300">
                        ➕ Add Credit Card
                    </a>
                @else
                    <a href="{{ route('wallet.topup') }}"
                        class="block w-full text-center bg-blue-100 text-blue-800 py-3 rounded-lg border border-blue-300">
                        ➕ Add Money
                    </a>
                @endif
            </div>

            <!-- if wallet balance is greater than zero show tap to pay button -->
            @if (auth()->user()->wallet->balance > 0)
                <div class="mb-4">
                    <a href="{{ route('nfc.pay') }}"
                        class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg shadow transition duration-200 mt-4">
                        💳 Tap to Pay
                    </a>
                </div>
            @endif



            <!-- Create Mada Card Button -->
            @if (!auth()->user()->madaCard)
                <div class="mb-6">
                    <a href="{{ route('mada.create') }}"
                        class="block w-full text-center bg-blue-100 text-blue-800 py-3 rounded-lg border border-blue-300">
                        💳 Create Mada Digital Card
                    </a>
                </div>
            @endif

            <!-- Transactions Section -->
            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Recent Transactions</h2>
                @forelse(auth()->user()->transactions->sortByDesc('created_at')->take(5) as $txn)
                    <div class="border-b py-2 text-sm">
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-700">
                                [{{ ucfirst($txn->type) }}]
                                @if ($txn->type === 'credit')
                                    {{ $txn->currency }} {{ number_format($txn->amount_original, 2) }} → SAR
                                    {{ number_format($txn->amount_sar, 2) }}
                                @else
                                    SAR {{ number_format($txn->amount_sar, 2) }} - NFC
                                @endif
                            </span>
                            <span class="text-gray-500 text-xs">{{ $txn->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="text-xs text-gray-400">Status: {{ ucfirst($txn->status) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No transactions yet.</p>
                @endforelse
            </div>

            @if (!auth()->user()->cards->isEmpty())
                <div class="bg-white rounded-xl shadow p-4 mt-6">
                    <h3 class="text-sm text-gray-700 font-semibold mb-2">Saved Credit Cards</h3>
                    @foreach (auth()->user()->cards as $card)
                        <div class="border border-gray-200 rounded-lg p-3 mb-3 shadow-sm bg-white">
                            <div class="flex justify-between items-center text-sm text-gray-800">
                                <div>
                                    <p class="font-semibold">**** **** **** {{ substr($card->card_number, -4) }}
                                    </p>
                                    <p class="text-xs text-gray-500">Exp: {{ $card->expiry_date }}</p>
                                    <p class="text-xs text-gray-400">{{ $card->cardholder_name }}</p>
                                </div>

                                <img src="{{ asset('images/visa-logo.svg') }}" alt="">
                                <form action="{{ route('cards.destroy', $card) }}" method="POST"
                                    onsubmit="return confirm('Delete this card?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-xs underline">Delete</button>
                                </form>

                            </div>

                        </div>
                    @endforeach
                    <a href="{{ route('cards.create') }}" class="block mt-3 text-blue-600 text-sm underline">➕ Add
                        another
                        card</a>
                </div>
            @endif

            <!-- Optional: Support Section -->
            <div class="text-center text-sm text-gray-500 mt-8">
                Need help? <a href="#" class="text-blue-600 underline">Contact Support</a>
            </div>
        </div>
    </div>

</x-app-layout>
