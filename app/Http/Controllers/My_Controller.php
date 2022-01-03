<?php
namespace App\Http\Controllers;

use DB;

date_default_timezone_set("Asia/Kolkata");

class My_Controller extends Controller {	

	    public $settings;

	    public $includes;

	    public $theme;

	    public $template;


		function __construct()
		{
			parent::__construct();

			$this->settings = new stdClass();

		}
		
		//For Example

		//$js_file=array('datapicker.js','colorpicker.js');

	 	//$path=root path/externa_js

		public function add_external_js($js_files,$path=null){

			if(!is_array($this->includes)){

				$this->includes=array();

			}

			foreach ($js_files as $key => $js) {

				$js = trim($js);

				if(empty($js)) continue;

				$this->includes['js_files'][sha1($js)]=is_null($path)?$js:$path.$js;

			}

			return $this;

		}//End Function



		//For Example

		//$js_file=array('datapicker.css','colorpicker.css');

		//$path=root path/externa_css

	public function add_external_css($css_files,$path=null){

			if(!is_array($this->includes)){

				$this->includes=array();

			}

			foreach ($css_files as $key => $css) {

				$css = trim($css);

				if(empty($css)) continue;

				$this->includes['css_files'][sha1($css)]=is_null($path)?$css:$path.$css;

			}

			return $this;

		}//End Function

	public function is_login() {

			 $this->middleware(function ($request, $next){

		        $user_type = session('user_type');
		        $user_data = session('user_data');
		        $is_login = session('is_login');
		       
			        if(isset($user_data) && !empty($user_data) && !empty($user_type)) {

					$sesison_id = md5((md5($user_data->email).md5(config('constants.salt'))));

					if($is_login === TRUE && session('session_id') == $sesison_id && $user_type === 'admin' or $user_type === 1 or $user_type === 2) {

						return $next($request);

					} else {

						return redirect('admin');

					}

				} else {

					return redirect('admin');

				}
		    });

		} // End Function
		public function is_user_login() {

			 $this->middleware(function ($request, $next){

		        $user_type = session('user_type');
		        $user_data = session('user_data');
		        $is_login = session('is_login');
		       dd($user_data);
			        if(isset($user_data) && !empty($user_data) && !empty($user_type)) {

					$sesison_id = md5((md5($user_data->email).md5(config('constants.salt'))));

					if($is_login === TRUE && session('session_id') == $sesison_id && $user_type === 'admin' or $user_type === 1 or $user_type === 2) {

						return $next($request);

					} else {

						return redirect('admin');

					}

				} else {

					return redirect('admin');

				}
		    });

		} // End Function


}

?>