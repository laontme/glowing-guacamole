<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoItemStoreRequest;
use App\Http\Requests\TodoItemUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoItemController extends Controller
{
    public function token(Request $request)
    {
        return decrypt($request->session()->get('token'));
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $todoList = $request->query('todoList');
        return view('todo.item.create', compact('todoList'));
    }

    public function store(TodoItemStoreRequest $request)
    {
        $todoList = $request->query('todoList');
        $validated = $request->safe();

        $validated->done = $request->boolean('done');

        $res = Http::jg($this->token($request))->post('/todo/item/?todoList=' . $todoList, $validated);

        if ($res->status() == 204) {
            return redirect(route('user.dashboard'));
        }

        return abort($res->status());
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Request $request)
    {
        $res = Http::jg($this->token($request))->get('/todo/item/' . $id);

        if ($res->ok()) {
            $todoItem = $res->json()['data'];
            return view('todo.item.edit', compact('todoItem'));
        }

        return abort($res->status());
    }

    public function update(TodoItemUpdateRequest $request, $id)
    {
        $validated = $request->safe();

        $validated->done = $request->boolean('done');

        $res = Http::jg($this->token($request))->patch('/todo/item/' . $id, $validated);

        if ($res->ok()) {
            return redirect(route('todo.item.edit', ['todoItem' => $id]));
        }

        return abort($res->status());
    }

    public function destroy($id, Request $request)
    {
        $res = Http::jg($this->token($request))->delete('/todo/item/' . $id);

        if ($res->ok()) {
            return redirect(route('user.dashboard'));
        }

        return abort($res->status());
    }
}
