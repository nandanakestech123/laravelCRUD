<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty($request->header('token')) or empty($request->header('user_id'))){
            return response()->json(['status'=>'error','message'=>'user unauthenticated !']);
        }
        $data = CustomerModel::where('id',$request->header('user_id'))->first('auth_token');
        if ($request->header('token') !== $data->auth_token or is_null($data->auth_token)) {
            //return redirect('home');
            return response()->json(['status'=>'error','message'=>'user unauthenticated !']);
        }
        return $next($request);
    }
}
