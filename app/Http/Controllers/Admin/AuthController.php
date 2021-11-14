<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function auth()
    {
        $this->data['title'] = 'Login';
        return view('login', $this->data);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:5',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt(['email' => trim($request->email), 'password' => trim($request->password)])){
            return redirect('companies');
        }
        else {
            return redirect()->back()->withErrors(['Unable to verify your credentials.'])->withInput($request->only('email'));
        }
    }


    public function authLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
