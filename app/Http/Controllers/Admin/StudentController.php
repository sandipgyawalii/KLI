<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Psy\Util\Str;

class StudentController extends DM_BaseController
{
    protected $panel = 'Student';
    protected $base_route = 'admin.student';
    protected $view_path = 'admin.components.student';
    protected $setting;
    protected $model;
    protected $table;
    protected $folder_path_image;
    protected $folder = 'student';
    protected $prefix_path_image = '/upload_file/images/student/';


    public function __construct(Student $model)
    {
        $this->model = $model;
        $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
    }

   public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->model->newQuery();
    
            $totalRecords = $query->count();
    
            $draw = intval($request->input('draw'));
            $start = intval($request->input('start'));
            $length = intval($request->input('length'));
            $search = $request->input('search.value');
    
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('icon', 'like', "%{$search}%")
                      ->orWhere('color', 'like', "%{$search}%");
                });
            }
    
            $filteredRecords = $query->count();
    
            $data = $query->with('createdBy','updatedBy')->skip($start)->take($length)->get();
            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
            ]);
            
        }
    
        return view(parent::loadView("{$this->view_path}.index"));
    }
    

    public function create()
    {
        return view(parent::loadView($this->view_path . '.create'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->model->getRules());
        $validatedData['slug'] = Str::slug($validatedData['name']);
        if ($this->model->slugExist($validatedData['name']  )) {
            return redirect()->back()
                ->withInput()
                ->with('alert-error', 'Please choose another name as it is already taken');
        }

        $validatedData['created_by']= Auth::id(); 
        $validatedData['created_at']= now(); 
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
        if ($this->model->slugExist($validatedData['name'],$id)) {
            return redirect()->back()
                ->withInput()
                ->with('alert-error', 'Please choose another name as it is already taken');
        }
        $validatedData['updated_by']= Auth::id(); 
        $validatedData['updated_at']= now(); 
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
        $isDeleted = $this->model->deleteData($id);
        if ($isDeleted) {
            session()->flash('alert-success', $this->panel . ' Successfully Deleted !');
        } else {
            session()->flash('alert-error', $this->panel . ' cannot be Deleted !');
        }
        return redirect()->route($this->base_route . '.index');
    }
    public function trash()
    {
        $data['rows'] = $this->model->trashData();
        return view(parent::loadView($this->view_path . '.trash'), compact('data'));
    }
    public function restore($id)
    {
        $isRestored = $this->model->restoreData($id);
        if ($isRestored) {
            session()->flash('alert-success', $this->panel . ' Successfully Restored !');
        } else {
            session()->flash('alert-error', $this->panel . ' cannot be restored !');
        }
        return redirect()->route($this->base_route . '.trash');
    }
    public function forcedelete($id)
    {
        $isDeleted = $this->model->forceDeleteData($id);
        if ($isDeleted) {
            session()->flash('alert-success', $this->panel . ' Successfully Deleted !');
        } else {
            session()->flash('alert-error', $this->panel . ' cannot be Deleted !');
        }
        return redirect()->route($this->base_route . '.index');
    }
}
