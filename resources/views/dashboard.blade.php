<x-app-layout>
    <x-slot name="header" >
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-whitee overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-0 bg-whitee border-b border-gray-200">
                    {{-- You're logged in! --}}
                    <div id="app">
                        <connect></connect>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="auth_id" value="{{ auth()->user()->id }}">
    </div>
</x-app-layout>
