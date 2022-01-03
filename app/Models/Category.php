<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public static function get_category_data($data = array()){

        if(!empty($data) && count($data) > 0) {

            $searchQuery = "";

            if($data['searchValue'] != ''){

                $searchQuery = " categories.title like '%".$data['searchValue']."%' or categories.id  like '%".$data['searchValue']."%'";
            }

            $records = DB::select('Select count(*) as allcount from categories where is_deleted=1');
          
            $response['totalRecords'] = $records[0]->allcount;

            $sql="SELECT * FROM categories";

            $where =' WHERE ';

            if(!empty($data['searchValue'])){

               $where .= '('.$searchQuery .') And '; 

            }

            $where .=" (categories.is_deleted=1) order by categories.".$data['columnName']." ".$data['columnSortOrder']." LIMIT ".$data['start'].", ".$data['rowperpage']." ";

            $sql .=$where;

            $response['totalRecordwithFilter'] = $records[0]->allcount; 

            if($searchQuery != ''){

                $recordsarray = DB::select($sql);

                if(!empty($recordsarray)){

                    $response['totalRecordwithFilter'] = count($recordsarray); 

                }else{

                    $response['totalRecordwithFilter'] = 0;
                }
            }


            $recordData =  DB::select($sql);;

            if(!empty($recordData) && count($recordData) > 0){

                $response['recordData'] = $recordData;

            } else {

                $response['recordData'] = false;

            }

            return $response;

       }

    }//End of Function



}
