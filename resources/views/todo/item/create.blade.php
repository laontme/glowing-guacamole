@extends('layout.app')

@section('main')
    <form class="flex flex-col gap-2" action="{{ route('todo.item.store', ['todoList' => $todoList]) }}"
          method="post">
        @csrf
        <h1 class="text-2xl mb-3">Creating Todo Item</h1>
        <label class="flex flex-col">
            Title:
            <input
                class="smooth border-2 rounded p-1 border-emerald-300 w-96 outline-2 outline-emerald-200 focus:outline outline-offset-2"
                type="text" name="title" value="{{ old('title') }}">
        </label>
        <label class="flex flex-col">
            Description:
            <textarea
                class="smooth border-2 rounded p-1 border-emerald-300 w-96 outline-2 outline-emerald-200 focus:outline outline-offset-2"
                type="text" name="description">{{ old('description') }}</textarea>
        </label>
        <label>
            <input class="-hue-rotate-[50deg] brightness-125" type="checkbox" name="done">
            Done
        </label>

        <input
            class="smooth cursor-pointer bg-emerald-300 p-3 rounded hover:opacity-80 w-96 active:opacity-60 outline-none"
            type="submit" value="Save">
    </form>
@endsection
