<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function token(Request $request)
    {
        return decrypt($request->session()->get('token'));
    }

    public function login (LoginRequest $request)
    {
        $token = encrypt($request->validated('token'));
        $request->session()->put('token', $token);
        return redirect(route('user.dashboard'));
    }

    public function dashboard (Request $request)
    {
        $res = Http::jg($this->token($request))->get('/todo/list');

        if ($res->ok()) {
            $latest = $res->json()['data'];
            return view('user.dashboard', compact('latest'));
        }

        return abort($res->status());
    }
}
