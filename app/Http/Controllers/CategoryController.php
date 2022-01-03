<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends My_Controller
{

     function __construct(){

        $this->add_external_css(array(
                                      'plugins\datatables\dataTables.bootstrap4.min.css',

                                      'plugins\datatables\buttons.bootstrap4.min.css',

                                      'plugins\datatables\responsive.bootstrap4.min.css'
                                    ));

        $this->add_external_js(array(
                                     'plugins\datatables\jquery.dataTables.min.js',

                                     'plugins\datatables\dataTables.bootstrap4.min.js',

                                     'plugins\datatables\dataTables.responsive.min.js',

                                     'plugins\datatables\responsive.bootstrap4.min.js',

                                     'plugins\datatables\dataTables.buttons.min.js',

                                     'plugins\datatables\buttons.bootstrap4.min.js',

                                     'customejs/category.js'

                                  ));
        $this->is_login();
        
    }
 
    public function index(){

        $data = $this->includes;

        $page_data['title'] = "Manage Category";
        
        $data['content'] = view('admin.category',$page_data)->render();
      
        return view('template',$data);

    }

    public function save_category(Request $request){ 

        $formdata = array();

        $id = $request->id;

        $validator = Validator::make($request->all(), [
                'title'      => 'required',
                'description'    => 'required',
            ]);

        if($validator->passes()){
            if(!empty($request->file('image'))){
                $filename = uniqid().'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('uploads'), $filename);
                $formdata['image']     = $filename;
            }else{
                if(empty($id)){
                 return response()->json(['msg'=>'Please Select Image First !','status'=>2]);
                }
            }
            $formdata['title']   = $request->title;

            $slug = strtolower(Str::slug($request->title, '-'));
            $resp = $this->checkSlug($slug);
            if($resp != false){
                $formdata['slug']   = strtolower($resp);
            }else{
                $formdata['slug']   = strtolower(Str::slug($request->title, '-'));
            }

            $formdata['slug']   = Str::slug($request->title, '-');
            $formdata['description']  = $request->description;
            $formdata['is_active']  = 1;
            $formdata['is_deleted'] = 1;
            if(!empty($id) and !is_null($id)){

                $formdata['updated_by'] = session('user_data')->id;

                $res = Category::where('id',$id)->update($formdata);

                if(!empty($res)){

                        return response()->json(['msg'=>'Category Updated Successfully !','status'=>1]);
                }else{

                        return response()->json(['msg'=>"Can't Updated Category !",'status'=>2]);
                }

            }else{

                $formdata['created_by'] = session('user_data')->id;

                $res = Category::insertGetId($formdata);

                if(!empty($res)){

                        return response()->json(['msg'=>'Category Added Successfully !','status' => 1]);
                }else{

                        return response()->json(['msg'=>"Can't Added Category !",'status' => 2]);
                }
            }

        }else{

            return response()->json(['error'=>$validator->errors()->all(),'status'=>9]);

        }

    }//End Of Function

    public function show_category(Request $request){

        $postData = $request->post();

        $draw = $postData['draw'];

        $datatable['start'] = $postData['start'];

        $datatable['rowperpage'] = $postData['length']; // Rows display per page

        $datatable['columnIndex'] = $postData['order'][0]['column']; // Column index

        $datatable['columnName'] = $postData['columns'][$datatable['columnIndex']]['data']; // Column name

        $datatable['columnSortOrder'] = $postData['order'][0]['dir']; // asc or desc

        $datatable['searchValue'] = $postData['search']['value']; // Search value

        $response = Category::get_category_data($datatable);

        $data = array();

        if(!empty($response['recordData']) && $response['recordData'] != false) {

            $i = 1;

            foreach($response['recordData'] as $key=> $record ){
                
               if($record->is_active == 1){
                    $state="btn bg-opacity-success  color-success rounded-pill userDatatable-content-status active";
                    $msg="Active";

                }else{
                    $state="btn bg-opacity-warning  color-warning rounded-pill userDatatable-content-status active";
                    $msg="Deactive";
                }

                $list['id']= $i;
                
                $list['title'] = $record->title;

                $url = url('/uploads').'/'.$record->image;

                $list['image'] = '<span class="profile-image rounded-circle d-block m-0 wh-38" style="background-image:url('.$url.'); background-size: 100% 100%;"></span>';

                $list['created_at'] = date("d M Y " ,strtotime($record->created_at));

                $list['status'] = '<div class="userDatatable-content d-inline-block" onclick="category_status('.$record->id.','.$record->is_active.')"> <span class="'.$state.'" id="status'.$record->id.'">'.$msg.'</span> </div>';
                
                $list['action'] = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap" style="min-width:90px;justify-content:unset;"> <li onclick="edit_category('.$record->id.')"> <a href="#" class="edit"> <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> </li> <li onclick="delete_category('.$record->id.')"> <a href="#" class="remove"> <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a> </li> </ul>';


               $dataarrray[] = $list;

               $i++;
            }

            if(!empty($dataarrray)){

                $data = $dataarrray;

            }

        }

        $final_response = array(

                "draw" => intval($draw),

                "iTotalRecords" => $response['totalRecords'],

                "iTotalDisplayRecords" => $response['totalRecordwithFilter'],

                "aaData" => $data);

        echo json_encode($final_response);

    }//End of Function 

    public function delete_category(Request $request){

        $id = $request->id;

        if(!empty($id))

        {
            $data['is_deleted'] = 2;
        }

        $row = Category::where('id',$id)->update($data);

        if(empty($row)){

            return response()->json(['msg'=>"Can't Deleted Category !",'status'=>2]);

        }else{

          return response()->json(['msg'=>"Category Deleted Successfully !",'status'=>1]);
        }

    }//End if Function



    //Update Function

    public function edit_category(Request $request){

        $id = $request->id;

        $data = Category::where('id',$id)->first();

        return response()->json($data);

    }//End of Function



    //Update Status Function

    public function category_status(Request $request){

        $id = $request->id;

        $status = $request->status;

        if($status == 1){

            $data['is_active'] = 2;

            $data['updated_by'] = session('user_data')->id;

        }
        else if($status == 2){

            $data['is_active'] = 1;

            $data['updated_by'] = session('user_data')->id;

        }

        $row = Category::where('id',$id)->update($data);

        if(empty($row)){

            return response()->json(['msg'=>"Can't Status Updated !",'status'=>2]);

        }else{

            return response()->json(['msg'=>'Status Updated !','status'=>1]);
        }

    }//End of function

    public function checkSlug($slug=''){
        if(!empty($slug)){
            $resp = Category::where('slug',$slug)->first(['slug']);
            if(!empty($resp) && is_object($resp)){
                $token = openssl_random_pseudo_bytes(5);
                $token = bin2hex($token);
                return $resp->slug.'-'.$token;
            }else{
                return false;    
            }
        }else{
            return false;
        }
    }// End of Function


}//End of Class
