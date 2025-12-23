<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DM_BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends DM_BaseController
{
      protected $panel = 'Dashboard';
    protected $base_route = 'admin.dashboard';
    protected $view_path = 'admin.includes';
    protected $setting;
    protected $model;
    protected $table;
    protected $folder_path_image;
    protected $folder = 'dashboard';
    protected $prefix_path_image = '/upload_file/images/dashboard/';
    public function dashboard()
    {
        return view(parent::loadView($this->view_path . '.dashboard'));
    }
}
