@extends("layouts.master")
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semi-bold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                        <a href="{{ route('users') }}" class="inline-flex items-center px-6 py4 border border-gray-400 shadow-sm text-base font-medium rounded-md textgray-700 bg-white">
                            Gestion des utilisateurs
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
