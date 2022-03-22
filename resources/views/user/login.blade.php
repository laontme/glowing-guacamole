@extends('layout.fullpage')

@section('main')
    <div class="flex justify-center items-center h-full">
        <form class="flex flex-col items-center gap-4 w-full" action="{{ route('user.login') }}" method="post">
            @csrf
            <h1 class="text-2xl font-bold">Login</h1>
            <div class="w-full">
                <label class="flex flex-col items-center gap-2">
                    Your API token from Jubilant Goggle
                    <input class="smooth border-2 rounded p-1 border-emerald-300 w-96 outline-2 outline-emerald-200 focus:outline outline-offset-2" type="password" name="token">
                </label>
            </div>
            <div>
                <input class="smooth cursor-pointer bg-emerald-300 p-3 rounded hover:opacity-80 active:opacity-60 outline-none" type="submit" value="Log me in with token">
            </div>
        </form>
    </div>
@endsection
