<?php

namespace Scheduler\App\Http\Controllers\Admin\Institution;

use Illuminate\Http\Request;
use Scheduler\App\Models\Institution;
use Scheduler\App\Http\Controllers\Controller;
use DB;
class InstitutionController extends Controller
{
    
    public function indexView(Request $request)
    {
    	
    	return admin_view('pages.institution.index');
    }
}
