<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <form method="GET" action="{{ route('search_domain') }}">
            <div>
                <x-jet-label for="domain" value="{{ __('Search Your Domain Here') }}" />
                <x-jet-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Search Domain') }}
                </x-jet-button>
            </div>
        </form>
            </div>
             @if (isset($domain))
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <form method="POST" action="{{ route('domains.store') }}">
                    @csrf
                    <input type="hidden" name="name" value="{{ $domain }}">
                    <p>
                        {{ $domain ?? '' }} is {{ $status }}. 
                        @if ($status == 'available' ) 
                        <x-jet-button class="ml-4">
                        {{ __('Register Domain') }}
                        </x-jet-button>
                        @endif
                    </p>
                </form>
            </div>
            @endif
        </div>
        
    </div>
</x-guest-layout>s