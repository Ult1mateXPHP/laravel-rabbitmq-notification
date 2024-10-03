<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * [GET]
     * Рендер
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.user.login', ['route' => 'Login', 'error' => '']);
    }

    /**
     * [POST]
     * Войти
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'name' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if(!Auth::validate($credentials)) {
            return redirect()->to('/user/login');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::guard('web')->login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Вошел
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect('/recieve');
    }
}
