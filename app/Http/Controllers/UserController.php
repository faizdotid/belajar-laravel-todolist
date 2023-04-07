<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login()
    {
        return view('user.login', [
            'title' => 'Login'
        ]);
    }
    public function doLogin(Request $request)
    {
        // return $request->all();
        // $username = $request->input('username');
        // $password = $request->input('password');
        // if (empty($username) || empty($password)) {
        //     return back()->with('error', 'Username atau password tidak boleh kosong');
        // }
        // if ($this->userService->login($username, $password)){
        //     $request->session()->put('user', $username);
        //     return view('user.home');
        // }
        // return back()->with('error', 'Wrong username or password');
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if($this->userService->login($validate['username'], $validate['password'])) {
            session()->put('islogin', true);
            return redirect('/todolist');
        }
        
        return back()->with('error', 'Gagal masuk')->withErrors($validate);        
    }

    public function home()
    {
        return view('user.home', [
            'title' => 'Home Dashboard',
        ]);
    }

    public function doLogout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Silakan login kembali');
    }
}
