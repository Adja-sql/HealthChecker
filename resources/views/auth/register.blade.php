<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="width: 100px; height: auto;">
        </x-slot>
        <x-validation-errors class="mb-4" />
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Champ caché pour le rôle avec la valeur par défaut 'U' -->
            <input type="hidden" name="role" value="U">

            <div>
                <x-label for="prenom" value="{{ __('Prenom') }}" />
                <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
            </div>

            <div>
                <x-label for="nom" value="{{ __('Nom') }}" />
                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="dateDeNaissance" value="{{ __('Date de Naissance') }}" />
                <x-input id="dateDeNaissance" class="block mt-1 w-full" type="date" name="dateDeNaissance" :value="old('dateDeNaissance')" required />
            </div>
           
            <div>
                <x-label for="numero" value="{{ __('Numéro') }}" />
                <input id="phone" class="block mt-1 w-full" type="tel" name="numero" required autofocus autocomplete="tel">
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
        
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
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

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
            <script>
                var input = document.querySelector("#phone");
                window.intlTelInput(input, {
                    initialCountry: "SN",
                    geoIpLookup: function(success, failure) {
                        fetch('https://ipinfo.io/json?token=<YOUR_TOKEN>', { method: 'GET' })
                            .then(response => response.json())
                            .then(data => success(data.country))
                            .catch(failure);
                    },
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                });
            </script>
        </form>
    </x-authentication-card>
</x-guest-layout>
