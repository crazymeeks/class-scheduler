<?php

namespace Scheduler\App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use Scheduler\App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
	/**
	 * Display admin dashboard home
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function indexView(Request $request)
    {

    	return admin_view('pages.dashboard.index');
    }
}
