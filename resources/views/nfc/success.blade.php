<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-50">
        <div class="text-center animate-pulse">
            <div class="text-4xl mb-4">✅</div>
            <h2 class="text-lg font-semibold">Payment Successful!</h2>
            <p class="text-sm text-gray-600">Thank you for using TourPay.</p>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('dashboard') }}";
            }, 4000);
        </script>
    </div>
</x-app-layout>
