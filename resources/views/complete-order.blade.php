<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            	<div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <table class="table">
                	<tr>
                		<td>Item</td>
                		<td>Amount (RTGS)</td>
                	</tr>
                	<tr>
                		<td>1 x Domain ( {{ $domain->name }} ) </td>
                		<td>{{ $price }} </td>
                	</tr>
                	<tr>
                		<td>Total</td>
                		<td> {{ $price }} </td>
                	</tr>
                	<tr>
                		<td>&nbsp; </td>
                		<td> 
                			<form method="POST" action="{{ route('create_order') }}">
                				 @csrf
                				<input type="hidden" name="domain" value="{{ $domain }}">
                			<x-jet-button class="ml-4">
		                    	{{ __('Complete Order') }}
		                	</x-jet-button>
                		</form>
                		</td>
                	</tr>
                </table>
        	</div>
            </div>
        </div>
    </div>
</x-app-layout>
