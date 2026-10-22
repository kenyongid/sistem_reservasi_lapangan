@extends('layout.landing')

@section('title', 'SportSpace')

@section('content')
    @include('layout.landing.slider')
    @include('layout.landing.about')
    @include('layout.landing.counter')
    @include('layout.landing.lapangan')
    @include('layout.landing.package')
@endsection