@extends('layout.app')

@section('main')
    <div class="grid grid-cols-3 gap-5">
        @foreach($latest as $list)
            <div class="bg-emerald-400 rounded-lg p-4 text-white">
                <h3 class="font-black text-2xl">{{ $list['title'] }}</h3>
                <div class="bg-emerald-500 opacity-50 mt-3 p-3 rounded flex gap-5 flex-col">
                    @foreach($list['items'] as $item)
                        <div class="flex gap-4">
                            <input class="scale-150" type="checkbox" disabled @checked($item['done'])>
                            <div>
                                <p class="opacity-100 font-bold">{{ $item['title'] }}</p>
                                <p class="opacity-80">{{ $item['description'] }}</p>
                                <div class="flex gap-2"><a class="opacity-60 outline-none underline"
                                      href="{{ route('todo.item.edit', ['todoItem' => $item['id']]) }}">Edit</a>
                                    <form method="post" action="{{ route('todo.item.destroy', ['todoItem' => $item['id']]) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="opacity-60 outline-none underline" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="flex gap-2">
                    <a class="opacity-60 outline-none underline" href="{{ route('todo.item.create', ['todoList' => $list['id']]) }}">
                        Add
                    </a>
                    <a class="opacity-60 outline-none underline" href="{{ route('todo.list.edit', ['todoList' => $list['id']]) }}">
                        Edit
                    </a>
                    <form method="post" action="{{ route('todo.list.destroy', ['todoList' => $list['id']]) }}">
                        @method('delete')
                        @csrf
                        <button class="opacity-60 outline-none underline" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        <div class="hover:brightness-95 bg-emerald-400 rounded-lg p-4 text-white smooth cursor-pointer">
            <a class="block flex justify-center items-center h-full w-full text-9xl" href="{{ route('todo.list.create') }}">+</a>
        </div>
    </div>
@endsection
