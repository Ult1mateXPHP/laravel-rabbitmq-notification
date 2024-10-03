<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * [GET]
     * Рендер
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.admin.register', ['error' => '']);
    }

    /**
     * [POST]
     * Регистрация
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $user = Admin::query()->create($this->validate($request));
        Auth::guard('admin')->login($user);
        return redirect('/send')->with('success', "Account successfully registered.");
    }

    /**
     * Валидация
     * @param Request $request
     * @return array
     */
    private function validate(Request $request) : array {
        $credentials = [];
        $user = $request->input('name');
        $password = $request->input('password');
        if(!empty($user)) {
            $credentials['name'] = $user;
        } else {
            redirect('/admin/resgister');
        }
        if(!empty($password)) {
            $credentials['password'] = $password;
        } else {
            redirect('/admin/resgister');
        }
        return $credentials;
    }
}
