@extends('layouts.app')

@section('title', 'Главная страница лендинга')
@section('description', 'Лучший лендинг для вашего бизнеса')

@section('content')
        @include('sections.hero')
        @include('sections.products')
        @include('sections.branding')
        @include('sections.contacts')
@endsection
