@extends('layouts.app')

@section('title', 'Pustaka Tak Berapa Hikmah')

@section('content')
    <section class="py-8 bg-slate-50 antialiased md:py-8">
        <div class="mx-auto  max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-bold text-gray-900 ">{{ ucfirst($type) }}</h2>
            <h2 class="text-sm text-gray-900 pb-8">{{ ucfirst($count) }} rekod kesuluruhan</h2>

            <div class="bg-white shadow-lg grid grid-cols-4 gap-10">
                @foreach ($books as $book)
                    <div class="relative px-4 py-4">
                        <x-book-card :book="$book" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
