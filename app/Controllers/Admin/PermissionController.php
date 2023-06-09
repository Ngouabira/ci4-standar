<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;

class PermissionController extends BaseController
{
    protected $creatingRules = [

        'name' => [
            'rules' => 'required|min_length[3]|max_length[30]|is_unique[user.name]',
            'label' => 'Name',
        ],

        'description' => [
            'rules' => 'required|min_length[3]|max_length[500]',
            'label' => 'Description',
        ],

    ];

    protected $editingRules = [

        'name' => [
            'rules' => 'required|min_length[3]|max_length[30]|is_unique[user.name,id,{id}]',
            'label' => 'Name',
        ],

        'description' => [
            'rules' => 'required|min_length[3]|max_length[500]',
            'label' => 'Description',
        ],

    ];

    public function index()
    {
        return view('admin/permission/index');
    }

    public function create()
    {
        return view('admin/permission/create');
    }

    public function store()
    {
        helper(['form']);

        if ($this->validate($this->creatingRules)) {
            $permission = new Permission();
            $permission->save($_POST);
            return view('admin/permission/index', ['message' => 'Permission created successfully']);
        } else {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

    }

    public function show($id)
    {
        $permission = new Permission();
        $data = $permission->find($id);
        if ($data) {

            return view('admin/permission/show', ['permission' => $data]);

        } else {
            return redirect()
                ->back();
        }
    }

    public function edit($id)
    {
        $permission = new Permission();
        $data = $permission->find($id);
        if ($data) {

            return view('admin/permission/edit', ['permission' => $data]);

        } else {
            return redirect()
                ->back();
        }
    }

    public function update($id)
    {
        helper(['form']);

        if ($this->validate($this->editingRules)) {
            $permission = new Permission();
            $_POST['id'] = $id;
            $permission->save($_POST);
            return view('admin/permission/index', ['message' => 'Permission updated successfully']);
        } else {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
    }

    public function destroy($id)
    {
        $permission = new Permission();
        $data = $permission->find($id);
        if ($data) {
            $permission->delete($id);
            return redirect()
                ->back()
                ->withInput()
                ->with('message', 'Permission deleted successfully');
        }
    }
}
