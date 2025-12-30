@extends('layouts.app')

@section('title', 'Главная страница лендинга')
@section('description', 'Лучший лендинг для вашего бизнеса')

@section('content')
    <div class="flex flex-col md:flex-row min-h-screen" x-data="productsComponent()">

        <aside class="hidden md:block w-64 lg:w-72 shrink-0 bg-[#111111]">
            <div class="sticky top-0 h-screen">
                @include('sections.sidebar')
            </div>
        </aside>

        <main class="flex-1 bg-white overflow-x-hidden">
            @include('sections.hero')

            @include('sections.mobile-tabs')

            @include('sections.products')
            @include('sections.branding')
            @include('sections.contacts')
        </main>

    </div>
@endsection