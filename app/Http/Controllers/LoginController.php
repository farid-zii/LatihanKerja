<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }



    public function Auth(Request $r){

        $validate = $r->validate([
            'usr'=>'required',
            'pwd'=>'required',
        ]);

        $login = Http::post('http://minierp.hpy.co.id/api/method/login', [
            'usr' => 'test@hpy.co.id',
            'pwd' => 'pthpy1926',
        ]);

    $sid = $login->cookies()->getCookieByName('sid')->getValue();

    // // Use the 'sid' cookie in the second request
    $data = Http::withHeaders([
        'Cookie' => $login->cookies()
    ])
        ->get('http://minierp.hpy.co.id/api/resource/POS%20Invoice');

    // Handle the response
    dd($data);





        if($login->message=='Logged In'){

            // return 'Login Sukses';
            return view('index');
        }

        return back()->with('error','Email or Password Wrong');

    }

    private function createToken($user)
    {
        $token = $user->createToken('APIToken');
        return $token;
    }
}
