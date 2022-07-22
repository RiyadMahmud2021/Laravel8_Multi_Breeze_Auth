<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class AdminController extends Controller
{
    public function Index(){
        return view('admin.admin_login');
    }

    public function Dashboard(){
        return view('admin.index');
    } 

    public function Login(Request $request){
        // dd($request->all());
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully');
        }else{
            return back()->with('error','Invalid Email Or Password'); 
        }

    } 

    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error','Admin Logout Successfully');
    } 

    public function AdminRegister(){
        return view('admin.register');
    } 

    public function AdminRegisterCreate(Request $request){
        // dd($request->all());
        if($request){
            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->name),
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('login_form')->with('error','Admin Created Successfully');
        }
        else{
            return redirect()->route('login_form')->with('error','Admin Not Created Successfully,Try Again PLease!');
        }

    }
}