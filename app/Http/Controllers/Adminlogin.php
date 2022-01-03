<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Adminlogin extends Controller
{
    public function index(){
        
        return view('admin/login');

    }
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',           
        ]);
     
        if($validator->passes()) {
            $username = $request->post('username');
            $password = $request->password;
            $data = Auth::attempt(['email'=>$username,'password'=>$password]); 
            if(!$data){
                return response()->json(['status'=>3]);               
            }else{
                $user_data = User::where(['email'=>$username])->first(['id','email','name','image']);
                session([
                            'is_login' => TRUE,
                            'profile' => $user_data->image,
                            'session_id'=>  md5((md5($user_data->email).md5(config('constants.salt')))),
                            'user_type' => 'admin',
                            'user_data' => $user_data
                        ]);
                return response()->json(['status'=>1]);
            }
        }    
        return response()->json(['error'=>$validator->errors()->all(),'status'=>2]);      
       
    }
    // logout
    public function logout(){
        session()->flush();
        return redirect("/");
    }
}
