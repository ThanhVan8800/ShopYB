<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class LoginController extends Controller
{
    //
    
        public function index()
        {
            return view('admin.user.login',['title'=>'Đăng nhập hệ thống']);
        }
        public function store(Request $request)
        {
            //DD($request -> input());
            $this->validate($request,[
                'email'=>'required|email:filter',
                'password'=> 'required'
            ]);
            if(Auth::attempt([
                'email'=>$request->input('email'),
                'password'=>$request->input('password')
            ],$request->input('remember')))
                    {
                        return redirect()->route('admin');
                    }
                 $request  -> Session()->flash('error','email hoặc password không đúng vui lòng đăng nhập lại!');// luu y!
                    return redirect()->back();
        }
}
