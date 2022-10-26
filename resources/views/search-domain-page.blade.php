<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Get Your Perfect Domain') }}
        </h2>
    </x-slot>
     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
    </div>
</x-app-layout>