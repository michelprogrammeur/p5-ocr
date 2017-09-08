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

        if($user->hasAnyRole(['visiteur', 'colaborateur', 'admin'])) {
            $request->user()->authorizeRoles(['visiteur', 'colaborateur', 'admin']);

            return view('users.dashboard', compact('user'));
        }
        else {

            return view('/');
        }
    }
}
