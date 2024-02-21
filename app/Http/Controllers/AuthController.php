<?php

namespace App\Http\Controllers;

use App\Helpers\Curl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (Session::get('login')) {
            return view('dashboard.admin');
        }

        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri . '/' . 'user/login';

        $param = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $res = Curl::postRequest($url, $param);
        if ($res->status == '200') {
            $request->session()->regenerate();
            $users = $res->data->targetUser;

            $access = $res->data->access_token;
            Session::put('access', $access);
            Session::put('login', true);

            if ($users->username == "jakarta") {
                Session::put('user_id', $users->id);
                Session::put('user_account', $users->username);
                return view('dashboard.index');
            } elseif ($users->username == "kasir") {
                Session::put('user_id', $users->id);
                Session::put('user_account', $users->username);
                return view('dashboard.kasir');
            } elseif ($users->username == "invoice") {
                Session::put('user_id', $users->id);
                Session::put('user_account', $users->username);
                return view('dashboard.invoice');
            } elseif ($users->username == "cservice") {
                Session::put('user_id', $users->id);
                Session::put('user_account', $users->username);
                return view('dashboard.cservice');
            }
        } else {
            return redirect('login')->with('alert', $res->message);
        }
    }

    public function logout()
    {
        $uri = Curl::endpoint();
        $url = $uri . '/' . 'auth/logout';

        $param = [
            'ip' => Curl::getClientIps(),
            'user_id' => Session::get('user_id'),
        ];

        $res = Curl::requestPost($url, $param);
        if ($res->status == true) {
            Session::flush();

            return redirect('login');
        } else {
            Session::flush();

            return redirect('login')->with('alert', $res->message);
        }
    }
}
