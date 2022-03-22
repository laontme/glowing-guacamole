<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoItemStoreRequest;
use App\Http\Requests\TodoListUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoListController extends Controller
{
    public function token(Request $request)
    {
        return decrypt($request->session()->get('token'));
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return view('todo.list.create');
    }

    public function store(TodoItemStoreRequest $request)
    {
        $res = Http::jg($this->token($request))->post('/todo/list', $request->safe());

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
        $res = Http::jg($this->token($request))->get('/todo/list/' . $id);

        if ($res->ok()) {
            $todoList = $res->json()['data'];
            return view('todo.list.edit', compact('todoList'));
        }

        return abort($res->status());
    }

    public function update(TodoListUpdateRequest $request, $id)
    {
        $res = Http::jg($this->token($request))->patch('/todo/list/' . $id, $request->safe());

        if ($res->ok()) {
            return redirect(route('todo.item.edit', ['todoList' => $id]));
        }

        return abort($res->status());    }

    public function destroy($id, Request $request)
    {
        $res = Http::jg($this->token($request))->delete('/todo/list/' . $id);

        if ($res->ok()) {
            return redirect(route('user.dashboard'));
        }

        return abort($res->status());
    }
}
