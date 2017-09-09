<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rules\CurrrentPassword;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('deleteAccount');
    }

    public function index()
    {
        return view('home');
    }

    public function adminCreate()
    {
        return view('add_admin');
    }

    public function addAdmin(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);
        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_admin' => true
        ]);
        session()->flash('msg','Admin Created');
        return back();
    }

    public function deleteAccount()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        return redirect('/');
    }

    public function reset()
    {
        auth()->logout();
        DB::table('users')->delete();
        DB::table('question')->delete();
        DB::table('quizes')->delete();
        User::create([
            'username' => 'admin',
            'email' =>'admin@example.com',
            'password' => bcrypt('12345'),
            'is_admin' => true
        ]);
        return redirect('/');
    }


    public function editPassword()
    {
        return view('change_password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => [
                'required',
                new CurrrentPassword
            ],
            'password' => 'required|string|min:5|confirmed',
        ]);
        Auth::user()->update([
            'password' => bcrypt($data['password'])
        ]);
        session()->flash('msg','Password Updated');
        return back();
    }

}
