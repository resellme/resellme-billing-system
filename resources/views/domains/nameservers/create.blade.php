<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enter Namerservers for') . $domain->name ?? '' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            	<div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <form method="POST" action="{{ route('create_nameservers') }}">
		            @csrf
		            <input type="hidden" name="domain_id" value="{{ $domain->id }}">
		            <div class="mt-4">
		                <x-jet-label for="domain" value="{{ __('Namerserver 1') }}" />
		                <x-jet-input id="ns1" class="block mt-1 w-full" type="text" name="ns1" :value="old('email')" required autofocus />
		            </div>

		            <div class="mt-4">
		                <x-jet-label for="domain" value="{{ __('Namerserver 2') }}" />
		                <x-jet-input id="ns2" class="block mt-1 w-full" type="text" name="ns2" :value="old('email')" required autofocus />
		            </div>

		            <div class="flex items-center justify-end mt-4">
		                <x-jet-button class="ml-4">
		                    {{ __('Continue') }}
		                </x-jet-button>
		            </div>
        		</form>
        	</div>
            </div>
        </div>
    </div>
</x-app-layout>
