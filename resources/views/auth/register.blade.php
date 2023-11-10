<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="vocational_id" value="{{ __('Jurusan') }}" />
                <select id="vocational" name="vocational_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="">Pilih Jurusan</option>
                    <option disabled>----------</option>
                    @foreach ($vocationals as $vocational)
                    <option value="{{ $vocational->id }}">{{ $vocational->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="classroom_id" value="{{ __('Kelas') }}" />
                <select id="kelas" disabled name="classroom_id" class="form-control @error('classroom_id') is-invalid @enderror">
                    <option value="">Pilih Jurusan Terlebih Dahulu</option>
                </select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    <script>
        document.getElementById('vocational').addEventListener('change', function () {
        var vocationalId = this.value;
        var kelasSelect = document.getElementById('kelas');

        // Clear existing options
        kelasSelect.innerHTML = '';

        // If vocational is selected, fetch kelas
        if (vocationalId) {
            fetch('/get-classroom-by-vocational/' + vocationalId)
                .then(response => response.json())
                .then(data => {
                    // Enable the kelas select
                    kelasSelect.removeAttribute('disabled');

                    // Populate kelas options
                    data.forEach(kelas => {
                        var option = document.createElement('option');
                        option.value = kelas.id;
                        option.text = kelas.name;
                        kelasSelect.add(option);
                    });
                });
        } else {
            // If no vocational is selected, disable and clear kelas select
            kelasSelect.setAttribute('disabled', true);
        }
    });
    </script>
</x-guest-layout>
