<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class Dashboard extends My_Controller
{
     function __construct(){

        $this->is_login();
        
        $this->add_external_css(array(

                                        'plugins\chartist-js\chartist.min.css',

                                        'plugins\morris\morris.css',

                                        'plugins\datatables\dataTables.bootstrap4.min.css',

                                        'plugins\datatables\buttons.bootstrap4.min.css',

                                        'plugins\datatables\responsive.bootstrap4.min.css'

                                        ));

            $this->add_external_js(array(

                                    'plugins\chartist-js\chartist.min.js',

                                    'plugins\chartist-js\chartist-plugin-tooltip.min.js',

                                    'plugins\raphael\raphael-min.js',

                                    'plugins\datatables\jquery.dataTables.min.js',

                                    'plugins\datatables\dataTables.bootstrap4.min.js',

                                    'plugins\datatables\dataTables.responsive.min.js',

                                    'plugins\datatables\responsive.bootstrap4.min.js',

                                    'plugins\datatables\dataTables.buttons.min.js',

                                    'plugins\datatables\buttons.bootstrap4.min.js'
                                ));
    }
    public function index(){
    
        $data = $this->includes;

        $data['title'] = "Dashboard";
        
        $data['content'] = view('admin/dashboard')->render();
      
        return view('template',$data);
        
    }

     public function adminprofile($id = ''){

        $data = $this->includes;

        $page_data['title'] = "Profile";

        $page_data['country'] = DB::table('tbl_country')->get();

        $result = DB::table('tbl_staff')
                    ->join('tbl_city','tbl_staff.city_id','=','tbl_city.id')
                    ->join('tbl_state','tbl_staff.state_id','=','tbl_state.id')
                    ->join('tbl_country','tbl_staff.country_id','=','tbl_country.id')
                    ->where('tbl_staff.id',$id)
                    ->first(['tbl_staff.id','tbl_staff.image','tbl_staff.name','tbl_staff.email','tbl_staff.mobile','tbl_staff.zip_code','tbl_staff.country_id','tbl_staff.state_id','tbl_staff.city_id','tbl_state.state_name as state','tbl_city.city_name as city','tbl_country.country_name as country']); 

        $page_data['data'] = @$result;
        $data['content'] = view('admin.adminprofile',$page_data)->render();
        $data['footer'] = view('admin.profile_footer',$page_data)->render();
      
        return view('template',$data);
    }

    public function change_password(Request $request){

        $validator = Validator::make($request->all(), [
                'current_password' => 'required',           
                'new_password' => 'required',
            ]);
     
            if($validator->passes()) {

                $data = DB::table('tbl_staff')->where(['password' => md5($request->current_password.config('constants.salt')) , 'id' => $request->id])->get();

                if(!empty($data) and count($data) > 0){

                    $formdata['password'] =  md5($request->new_password.config('constants.salt')) ;

                    $formdata['updated_by'] = session('user_data')->id;

                    $where['id'] = $request->id;

                    $response = DB::table('tbl_staff')->where($where)->update($formdata);

                    if(!empty($response)){
                        
                        return response()->json(['status' => 1]);
                    }else{
                        
                        return response()->json(['status' => 3]);
                    }
                }else{
                        return response()->json(['status' => 4]);

                }

            }else{
                return response()->json(['error'=>$validator->errors()->all(),'status'=>2]); 
            }
    }

    public function updateProfile(Request $request){ 

        $formdata = array();

        $id = $request->id;

        $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'mobile'    => 'required',
                'country'   => 'required',
                'city'      => 'required',
                'state'     => 'required',
                'zipcode'   => 'required',
            ]);

        if($validator->passes()){
            if(!empty($request->file('image'))){
                $filename = time().'-'.$request->file('image')->getClientOriginalName(); 
                $request->file('image')->move(public_path('uploads'), $filename);
                $formdata['image']     = $filename;
                session()->put('profile',$filename);
            }
            $formdata['name']   = $request->name;
            $formdata['mobile']  = $request->mobile;
            $formdata['country_id']  = $request->country;
            $formdata['state_id']  = $request->state;
            $formdata['city_id']  = $request->city;
            $formdata['zip_code']  = $request->zipcode;
            $formdata['is_active']  = 1;
            $formdata['is_deleted'] = 1;
            $formdata['updated_by'] = session('user_data')->id;
            $res = DB::table('tbl_staff')->where('id',$id)->update($formdata);
            if(!empty($res)){

                    return response()->json(['msg'=>'Record Updated Successfully !','status'=>1]);
            }else{

                    return response()->json(['msg'=>"Can't Updated !",'status'=>2]);
            }
            
        }else{

            return response()->json(['error'=>$validator->errors()->all(),'status'=>9]);

        }

    }//End Of Function
}
