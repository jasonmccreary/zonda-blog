<?php

namespace App\Controllers\Backend;

use Auth;
use BaseController;
use Input;
use Redirect;
use View;

/**
 * Class AuthController.
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class AuthController extends BaseController
{
    /**
     * Display the login page.
     * @return View
     */
    public function getLogin()
    {
        return View::make('backend.auth.login');
    }

    /**
     * Login action.
     * @return Redirect
     */
    public function postLogin()
    {
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        ];

        try {
            if (Auth::attempt($credentials)) {
                //if successfull redirect the user
                return Redirect::to('dashboard');
            }
            //else send back the login failure message.
            return Redirect::back()->withInput()->withErrors(['login' => 'Username or password is invalid!']);
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->withErrors(['login' => $e->getMessage()]);
        }
    }

    /**
     * Logout action.
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();

        return Redirect::route('login');
    }
}
