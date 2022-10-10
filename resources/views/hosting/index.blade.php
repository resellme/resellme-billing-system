<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hosting Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                    <h2>My Hosting</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Domain Name</th>
                            <th>Status</th>
                            <th>Registration Date</th>
                            <th>Billing Cycle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hosting as $h)
                            <tr>
                                <td>
                                    {{ $h->domain }}
                                </td>
                                <td>
                                    {{ $h->status }}
                                </td>
                                <td>
                                    {{ $h->next_due_date ?? '--' }}
                                </td>
                                <td>
                                    {{ $h->billing_cycle }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
