<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen text-center px-4">
        <div class="text-2xl font-bold mb-4" id="message">Authenticating your identity...</div>
        <div class="animate-spin h-8 w-8 border-4 border-blue-500 border-t-transparent rounded-full"></div>

        <script>
            const messages = [
                "Authenticating your identity...",
                "Setting up your wallet...",
                "Redirecting to your dashboard..."
            ];

            let index = 0;
            const messageElement = document.getElementById("message");

            const interval = setInterval(() => {
                index++;
                if (index < messages.length) {
                    messageElement.textContent = messages[index];
                }
            }, 2000); // change message every 1.5 seconds

            setTimeout(() => {
                window.location.href = "{{ route('dashboard') }}";
            }, 6000); // total 4.5s delay
        </script>
    </div>
</x-guest-layout>
