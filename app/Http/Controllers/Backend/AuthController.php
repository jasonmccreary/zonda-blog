<?php

namespace App\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;
use BaseController;
use Illuminate\Support\Facades\Request;
use Redirect;
/**
 * Class AuthController.
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
use View;

class AuthController extends Controller
{
    /**
     * Display the login page.
     * @return View
     */
    public function getLogin()
    {
        return view('backend.auth.login');
    }

    /**
     * Login action.
     * @return Redirect
     */
    public function postLogin()
    {
        $credentials = [
            'email' => Request::get('email'),
            'password' => Request::get('password'),
        ];

        try {
            if (Auth::attempt($credentials)) {
                //if successfull redirect the user
                return redirect('dashboard');
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
