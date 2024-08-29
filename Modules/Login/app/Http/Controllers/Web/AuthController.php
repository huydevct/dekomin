<?php

namespace Modules\Login\app\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Login\app\Http\Requests\AuthRequest;

class AuthController extends Controller
{

    public function login()
    {
        return view('login::pages.index');
    }

    public function loginPost(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.categories.get')->with('success', 'Login Success');
        }

        return back()->with('error', 'Error Email or Password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}
