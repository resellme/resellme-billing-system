<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Hosting') }}
        </h2>
    </x-slot>

    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <form method="POST" action="{{ route('hostings.store') }}">
                @csrf
            <div>
                <h3>Hosting</h3>
                <h4>Free Hosting Package</h4>
            </div>
            <div>
                <x-jet-label for="domain" value="{{ __('Enter Domain to Use') }}" />
                <x-jet-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
        </form>
            </div>

        </div>
    </div>
</x-app-layout>