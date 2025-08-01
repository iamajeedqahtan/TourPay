<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Full Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Nationality (Dropdown) -->
        <div class="mt-4">
            <x-input-label for="nationality" :value="__('Nationality')" />
            <select id="nationality" name="nationality" onchange="autoFillCountryCode()"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                required>
                <option value="">-- Select Nationality --</option>
                <option value="American" {{ old('nationality') == 'American' ? 'selected' : '' }}>American</option>
                <option value="British" {{ old('nationality') == 'British' ? 'selected' : '' }}>British</option>
                <option value="French" {{ old('nationality') == 'French' ? 'selected' : '' }}>French</option>
                <option value="German" {{ old('nationality') == 'German' ? 'selected' : '' }}>German</option>
                <option value="Italian" {{ old('nationality') == 'Italian' ? 'selected' : '' }}>Italian</option>
                <option value="Spanish" {{ old('nationality') == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                <option value="Egyptian" {{ old('nationality') == 'Egyptian' ? 'selected' : '' }}>Egyptian</option>
                <option value="Indian" {{ old('nationality') == 'Indian' ? 'selected' : '' }}>Indian</option>
                <option value="Indonesian" {{ old('nationality') == 'Indonesian' ? 'selected' : '' }}>Indonesian
                </option>
            </select>
            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
        </div>

        <!-- Auto-filled Passport Country Code (readonly) -->
        <div class="mt-4">
            <x-text-input id="passport_country_code" class="block mt-1 w-full bg-gray-100 hidden" type="text"
                name="passport_country_code" :value="old('passport_country_code')" readonly required />
            <x-input-error :messages="$errors->get('passport_country_code')" class="mt-2" />
        </div>

        <!-- Passport Number -->
        <div class="mt-4">
            <x-input-label for="passport_number" :value="__('Passport Number')" />
            <x-text-input id="passport_number" class="block mt-1 w-full" type="text" name="passport_number"
                :value="old('passport_number')" required />
            <x-input-error :messages="$errors->get('passport_number')" class="mt-2" />
        </div>

        <!-- Phone: country code + number -->
        <div class="mt-4 flex gap-4">
            <div class="w-1/3">
                <x-input-label for="phone_country_code" :value="__('Country Code')" />
                <select id="phone_country_code" name="phone_country_code" class="block mt-1 w-full rounded-md" required>
                    <option value="">-- Code --</option>
                    <option value="+1" {{ old('phone_country_code') == '+1' ? 'selected' : '' }}>+1 (USA)</option>
                    <option value="+44" {{ old('phone_country_code') == '+44' ? 'selected' : '' }}>+44 (UK)</option>
                    <option value="+33" {{ old('phone_country_code') == '+33' ? 'selected' : '' }}>+33 (France)
                    </option>
                    <option value="+49" {{ old('phone_country_code') == '+49' ? 'selected' : '' }}>+49 (Germany)
                    </option>
                    <option value="+39" {{ old('phone_country_code') == '+39' ? 'selected' : '' }}>+39 (Italy)
                    </option>
                    <option value="+34" {{ old('phone_country_code') == '+34' ? 'selected' : '' }}>+34 (Spain)
                    </option>
                    <option value="+20" {{ old('phone_country_code') == '+20' ? 'selected' : '' }}>+20 (Egypt)
                    </option>
                    <option value="+91" {{ old('phone_country_code') == '+91' ? 'selected' : '' }}>+91 (India)
                    </option>
                    <option value="+62" {{ old('phone_country_code') == '+62' ? 'selected' : '' }}>+62 (Indonesia)
                    </option>
                </select>
                <x-input-error :messages="$errors->get('phone_country_code')" class="mt-2" />
            </div>

            <div class="w-2/3">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function autoFillCountryCode() {
            const nationality = document.getElementById('nationality').value;

            const mapping = {
                "American": {
                    passportCode: "US",
                    phoneCode: "+1"
                },
                "British": {
                    passportCode: "GB",
                    phoneCode: "+44"
                },
                "French": {
                    passportCode: "FR",
                    phoneCode: "+33"
                },
                "German": {
                    passportCode: "DE",
                    phoneCode: "+49"
                },
                "Italian": {
                    passportCode: "IT",
                    phoneCode: "+39"
                },
                "Spanish": {
                    passportCode: "ES",
                    phoneCode: "+34"
                },
                "Egyptian": {
                    passportCode: "EG",
                    phoneCode: "+20"
                },
                "Indian": {
                    passportCode: "IN",
                    phoneCode: "+91"
                },
                "Indonesian": {
                    passportCode: "ID",
                    phoneCode: "+62"
                },
            };

            if (mapping[nationality]) {
                document.getElementById('passport_country_code').value = mapping[nationality].passportCode;
                document.getElementById('phone_country_code').value = mapping[nationality].phoneCode;
            } else {
                document.getElementById('passport_country_code').value = '';
                document.getElementById('phone_country_code').value = '';
            }
        }
    </script>

</x-guest-layout>
