<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     //Registration
     public function registerPost(Request $req){
        $req->validate([
            'name'=>'required | min:4 | max:15 ',
            'email'=>'required |email ',
            'password'=>'required  | min:6 | max:15 |confirmed ',
            // 'password_1'=>'required |min:6 | max:15'
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        if($req->password === Hash::make($user->password_1) ){
            $user->save();
        }
        return redirect('/login');        
    }
    //Login Post
    public function loginPost(Request $req)
    {
        $req->validate([
            'email'=>'required | email',
            'password'=>'required |min:6 | max:15 ',
            
        ]);
        $user= User::where(['email'=>$req->email])->first();
        if($user && Hash::check($req->password,$user->password)){
            $req->session()->put('user',$user);
            return redirect('/adminPanel');
        }

        return "Username or password is not matched";
    }
    public function loginGet(Request $req){
        //  Poxenq  
        return $req->session()->has('user') ? redirect('/adminPanel') : view('login');
        
    }
    
    public function logOut(Request $req){
        $req->session()->forget('user');
        return redirect('/login');
    }

    public function registerGet(){
        return view('registrator');
    }
}






//  //Registration
//  public function registerPost(Request $req){
//     $req->validate([
//         'name'=>'required | min:4 | max:15 ',
//         'email'=>'required |email ',
//         'password'=>'required  | min:6 | max:15 |confirmed ',
//         // 'password_1'=>'required |min:6 | max:15'
//     ]);

//     $user = new User();
//     $user->name = $req->name;
//     $user->email = $req->email;
//     $user->password = Hash::make($req->password);
//     if($req->password === Hash::make($user->password_1) ){
//         $user->save();
//     }
//     return redirect('/login');        
// }
// //Login Post
// public function loginPost(Request $req)
// {
//     $req->validate([
//         'email'=>'required | email',
//         'password'=>'required |min:6 | max:15 ',
        
//     ]);
//     $user= User::where(['email'=>$req->email])->first();
//     if($user && Hash::check($req->password,$user->password)){
//         $req->session()->put('user',$user);
//         return redirect('/adminPanel');
//     }

//     return "Username or password is not matched";
// }
// public function loginGet(Request $req){
//     //  Poxenq  
//     return $req->session()->has('user') ? redirect('/adminPanel') : view('login');
    
// }

// public function logOut(Request $req){
//     $req->session()->forget('user');
//     return redirect('/login');
// }

// public function registerGet(){
//     return view('registrator');
// }
