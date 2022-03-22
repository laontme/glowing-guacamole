@extends('layout.app')

@section('main')
    <h1 class="text-5xl mb-5">
        <p>{{auth()->user()['data']['name']}}</p>
    </h1>
    <p>{{auth()->user()['data']['email']}}</p>
    <p>{{auth()->user()['data']['token']}}</p>
@endsection
