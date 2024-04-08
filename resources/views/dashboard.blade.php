<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
        @if($error)
            <h1 class="bg-red-300 border-red-500 rounded text-red-900 px-2 py-2 shadow-md">Your connection to Xero failed</h1>
            <p>{{ $error }}</p>
            <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4">
                Reconnect to Xero
            </a>
            @elseif($connected)
                <div class="flex justify-between">
                    <h1 class="bg-green-300 border-green-500 rounded text-green-900 px-2 py-2 shadow-md mr-1" role="alert">Connected</h1>
{{--                    <p>{{ $organisationName }} via {{ $username }}</p>--}}

                    <div class="bg-blue-300 border-blue-500 rounded text-blue-900 px-2 py-2 shadow-md" role="alert">
                        <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4">
                            Reconnect to Xero
                        </a>
                    </div>
                </div>

            @else
                <div class="flex justify-between">
                    <h1 class="bg-red-300 border-red-500 rounded text-red-900 px-2 py-2 shadow-md">Not Connected</h1>
                    <div class="bg-blue-300 border-blue-500 rounded text-blue-900 px-2 py-2 shadow-md" role="alert">
                        <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4">
                            Connect to Xero
                        </a>
                    </div>
                </div>
            @endif
    </x-slot>

    <div class="pt-10 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($connected)
                        <p><strong>Current Connection:</strong> {{ $organisationName }} via {{ $username }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold border-b-4 border-gray-500 text-l text-gray-800 dark:text-gray-200 py-2 px-4 sm:px-6 lg:px-8">
                    Reports
                </h2>
                <p>Some text</p>
            </div>
        </div>
    </div>
</x-app-layout>
