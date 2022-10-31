<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enter Contact Details for') . $domain->name ?? '' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            	<div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
            	<x-jet-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('contacts.store') }}">
		            @csrf
		            <input type="hidden" name="domain_id" value="{{ $domain->id }}">
		            <div class="mt-4">
		                <x-jet-label for="first_name" value="{{ __('First Name') }}" />
		                <x-jet-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
		            </div>

		            <div class="mt-4">
		                <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
		                <x-jet-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="email" value="{{ __('Email') }}" />
		                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="mobile" value="{{ __('Mobile Number') }}" />
		                <x-jet-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="company" value="{{ __('Organization') }}" />
		                <x-jet-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="core_business" value="{{ __('Core Business') }}" />
		                <x-jet-input id="core_business" class="block mt-1 w-full" type="text" name="core_business" :value="old('core_business')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="street_address" value="{{ __('Street Address') }}" />
		                <x-jet-input id="street_address" class="block mt-1 w-full" type="text" name="street_address" :value="old('street_address')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="city" value="{{ __('City') }}" />
		                <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus />
		            </div>
		            <div class="mt-4">
		                <x-jet-label for="country" value="{{ __('Country') }}" />
		                <x-jet-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required autofocus />
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
