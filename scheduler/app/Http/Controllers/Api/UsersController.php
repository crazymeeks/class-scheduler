<?php

namespace Scheduler\App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use Scheduler\App\Http\Controllers\Controller;

class UsersController extends Controller
{
    

	/**
	 * Verify password if matched
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function verifyPassword(Request $request)
    {

    	$current = Auth::guard('admin')->user()->password;

    	if (password_verify($request->password, $current)) {
    		return response()->json(['message' => 'Password matched'], 200);
    	}

    	return response()->json(['message' => 'Sorry, you are not allowed do this action'], 403);
    }
}
