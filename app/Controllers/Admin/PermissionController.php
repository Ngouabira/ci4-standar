<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;

class PermissionController extends BaseController
{

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
        $rules = [

            'name' => [
                'rules' => 'required|min_length[3]|max_length[30]|is_unique[role.name]',
                'label' => 'Name',
            ],

            'description' => [
                'rules' => 'required|min_length[3]|max_length[500]',
                'label' => 'Description',
            ],

        ];

        if ($this->validate($rules)) {
            $permission = new Permission();
            $permission->save($_POST);
            $info = ['messages' => ['Permission created successfully'], 'type' => 'success'];
            return redirect()->to('admin/permission')->withInput()->with('info', $info);
        } else {
            $info = ['messages' => $this->validator->getErrors(), 'type' => 'danger'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
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
        $rules = [

            'name' => [
                'rules' => 'required|min_length[3]|max_length[30]|is_unique[permission.name,id,' . $id . ']',
                'label' => 'Name',
            ],

            'description' => [
                'rules' => 'required|min_length[3]|max_length[500]',
                'label' => 'Description',
            ],

        ];

        if ($this->validate($rules)) {
            $permission = new Permission();
            $_POST['id'] = $id;
            $permission->save($_POST);
            $info = ['messages' => ['Permission updated successfully'], 'type' => 'success'];
            return redirect()->to('admin/permission')->withInput()->with('info', $info);
        } else {
            $info = ['messages' => $this->validator->getErrors(), 'type' => 'danger'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }
    }

    public function destroy($id)
    {
        $permission = new Permission();
        $data = $permission->find($id);
        if ($data) {
            $permission->delete($id);
            $info = ['messages' => ['Permission deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }
    }
}
