<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (Auth::user()->isAdmin()){
            return route('home');
        }else{
            return route('person.order.index');
        }

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
