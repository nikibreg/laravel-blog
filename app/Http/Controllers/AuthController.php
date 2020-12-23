<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Notifications\MailSent;

class AuthController extends Controller
{
    public function login(){
        return view('user.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->except('_token');

        if(Auth::attempt($credentials)){
            return redirect()->route('my_posts');
        } else {
            abort(403);
        }
    }

    public function register(){
        return view('user.register');
    }

    public function postRegister(Request $request){
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('users/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

   
    public function my_posts()
    {
        $user = Auth::user();

        
        return view('user.my_posts', [
            'user' => $user
        ]);
    }

    

    public function sendMail(Request $request)
    {
        $user = Auth::user();
        
        try {
            $user->notify((new MailSent()));
            $user->mailSent = true;
            $user->save();
        } catch (\Throwable $th) {
            return "fail";
        }
        return "ok";
    }
}
