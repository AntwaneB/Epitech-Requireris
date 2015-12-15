<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return (view('layouts.default', ['content' => view('auth.login')]));
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
        {
            $request->session()->put(['hash_key' => sha1(sha1($request->get('password')) . md5($request->get('password')))]);

            return (redirect()->route('app.index'));
        }
        else
        {
            return (redirect()->back()->with('error', 'Identifiants invalides'));
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('hash_key');

        Auth::logout();

        return (redirect()->route('app.index'));
    }
}
