@extends('layouts.app')

@section('title', 'Belian Ku')

@section('content')

    <section class="py-8 md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <h2 class="text-xl font-bold text-gray-900 ">Belian Ku</h2>
            @livewire('customer.belian.belian-table')
        </div>
    </section>

@endsection
