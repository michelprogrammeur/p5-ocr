<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if(Auth::user()->hasRole('visiteur')) {
            $request->user()->authorizeRoles(['visiteur']);

            return view('users.dashboard');
        }
        elseif (Auth::user()->hasRole('admin')) {
            $request->user()->authorizeRoles(['admin']);

            return view('users.admins.dashboard');
        }
        else {
            return view('/');
        }
    }
}
