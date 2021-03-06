<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getSignup()
    {
        return view('users.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        $users=new User;
        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->password = bcrypt($request->input('password'));
        $users->save();

        Auth::login($users);

        if(Session::has('oldUrl')) {
            $oldUrl=Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }

        return redirect()->route('order.eatin')->with('message','註冊成功，已登入...');

    }

    public function getSignin()
    {
        return view('users.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password]))
        {
            if(Session::has('oldUrl')){
                $oldUrl=Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('order.eatin')->with('message','登入成功!!');
        }
        return redirect()->back()->with('error','電話or密碼錯誤!!');

    }

    public function getProfile()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('users.profile', ['orders' => $orders]);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('pages.index');
    }
}
