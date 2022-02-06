@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if (date('H') <= 12) {
                <h1>Good morning {{auth()->user()->name}}!</h1>
            }     
            @else
                <h1>Good afternoon {{auth()->user()->name}}!</h1>
            @endif
        </div>
    </div>
    @empty($balance)
        <div class="flex justify-center mt-6">
            <div class="w-4/12 bg-white p-6 rounded-lg">
                <h1 class="mb-3">You have not yet created an account</h1>
                <h2 class="mb-3">Please enter a password to authenticate this account</h2>
                <form action="{{route('create')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" placeholder="Your Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="sr-only">Password again</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Create Account</button>
                </form>
            </div>
        </div>
    @endempty
    
    @isset($balance)
        <div class="flex justify-center mt-6">
            <div class="w-4/12 bg-white p-6 rounded-lg">
                <form action="{{route('fund')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="amount">Amount to fund account: </label>
                        <input class="bg-gray-100 border-2 w-half p-4 rounded-lg " name="amount" type="number">
                    </div>
                    @error('account')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Fund Account</button>
                </form>
            </div>
        </div>
        <div class="flex justify-center mt-6">
            <div class="w-4/12 bg-white p-6 rounded-lg">
                <form action="{{route('fund')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="amount">Transfer to another member: </label>
                        <input class="bg-gray-100 border-2 w-half p-4 rounded-lg " name="amount" type="number">
                        <select name="" id="">
                            {{-- @foreach ($collection as $item)
                                In here i will go through users. In "llama" person will select email address to send funds to.
                            @endforeach --}}
                        </select>
                    </div>
                    @error('account')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Fund Account</button>
                </form>
            </div>
        </div> 
    @endisset

@endsection