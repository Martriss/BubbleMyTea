@extends('layouts.template')

<link rel="stylesheet" href="{{ URL::asset('css/user_template.css'); }}">

@section('main')
    <div class="block">
        <div class="flex_nav">
            <ul class="unoderlist2">
                <li class="list"><a class="list-anchor" href="{{ route('profile') }}">Profil</a></li>
                <li class="list"><a class="list-anchor" href="{{ route('history') }}">Mes commandes</a></li>
            </ul>
        </div>
        <div class="flex_page">
            <main class="main_user">
                @yield('page')
            </main>
        </div>
    </div>    
@endsection