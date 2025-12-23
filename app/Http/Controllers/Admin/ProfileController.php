<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DM_BaseController;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends DM_BaseController
{
    protected $panel = 'Profile';
    protected $base_route = 'admin.profile';
    protected $view_path = 'admin.components.profile';
    protected $setting;
    protected $model;
    protected $table;
    protected $folder_path_image;
    protected $folder = 'profile';
    protected $prefix_path_image = '/upload_file/images/profile/';

    public function __construct(Profile $model)
    {
        $this->model = $model;
        $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data['rows'] = $this->model->index();
        return view(parent::loadView($this->view_path . '.index'), compact('data'));
    }

    public function create()
    {
        return view(parent::loadView($this->view_path . '.create'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->model->getRules());
        if ($request->hasFile('banner')) {
            $validatedData['banner'] = parent::uploadImage($request, $this->folder_path_image, $this->prefix_path_image, 'banner');
        }
        $data = $this->model->storeData($validatedData);
        if ($data) {
            session()->flash('alert-success', $this->panel . ' Successfully Store');
        } else {
            session()->flash('alert-error', $this->panel . ' cannot be Updated');
        }
        return redirect()->route($this->base_route . '.index');
    }

    public function edit($id)
    {
        $data['row'] = $this->model->edit($id);
        return view(parent::loadView($this->view_path . '.edit'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate($this->model->getRules($id));
        $row = $this->model->findorfail($id);
        $image_fields = ['logo','favicon','about_image','banner'];
        foreach($image_fields as $image){
        if ($request->hasFile($image)) {
            parent::deleteimage($row->$image);
            $validatedData[$image] = parent::uploadImage($request, $this->folder_path_image, $this->prefix_path_image, $image);
        }}

        $data = $this->model->updateData($id, $validatedData);
        if ($data) {
            session()->flash('alert-success', $this->panel . ' Successfully Updated');
        } else {
            session()->flash('alert-error', $this->panel . ' cannot be Updated');
        }
        return redirect()->route($this->base_route . '.index');
    }

    public function destroy(Request $request, $id)
    {
        $row = $this->model->findorfail($id);
        parent::deleteimage($row->banner);

        $isDeleted = $this->model->deleteData($id);
        if ($isDeleted) {
            session()->flash('alert-success', $this->panel . ' Successfully Deleted !');
        } else {
            session()->flash('alert-error', $this->panel . ' cannot be Deleted !');
        }
        return redirect()->route($this->base_route . '.index');
    }
}
