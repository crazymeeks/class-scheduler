<?php

namespace Scheduler\App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Scheduler\App\Http\Controllers\PermissionTrait;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, PermissionTrait;

    protected $admin_view = 'scheduler.admin.';
}
