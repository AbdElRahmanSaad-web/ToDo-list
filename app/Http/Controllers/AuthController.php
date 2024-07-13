<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register_form()
    {
        return view('Auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email:users',
            'password'=>'required|min:8|max:12'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();
        if($result){
            return redirect(route('get_login'))->with('success','You have registered successfully.');
        } else {
            return back()->with('fail','Something wrong!');
        }
    }
    public function login_form()
    {
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([            
            'email'=>'required|email:users',
            'password'=>'required|min:8|max:12'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                Auth::login($user);
                return redirect('/');
            } else {
                return back()->with('fail','Password not match!');
            }
        } else {
            return back()->with('fail','This email is not register.');
        }        
    }
    public function dashboard()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        $tasks = $data->tasks->where('status', 'pending');
        return view('dashboard',compact('tasks'));
    }
    ///Logout
    public function logout()
    {
        $data = array();
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
