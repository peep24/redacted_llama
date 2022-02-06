@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                @if (date('H') <= 12) {
                    <h1>Good morning {{auth()->user()->name}}!</h1>
                }     
                @else
                    <h1>Good afternoon {{auth()->user()->name}}!</h1>
                @endif
            @endauth

            @guest
                Join now!!
            @endguest
        </div>
    </div>
@endsection