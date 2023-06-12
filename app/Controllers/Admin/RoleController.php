<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Role;

class RoleController extends BaseController
{

    public function index()
    {
        return view('admin/role/index');
    }

    public function create()
    {
        return view('admin/role/create');
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
            $role = new Role();
            $role->save($_POST);
            $info = ['messages' => ['Role created successfully'], 'type' => 'success'];
            return redirect()->to('admin/role')->withInput()->with('info', $info);
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
        $role = new Role();
        $data = $role->find($id);
        if ($data) {

            return view('admin/role/show', ['role' => $data]);
        } else {
            return redirect()
                ->back();
        }
    }

    public function edit($id)
    {
        $role = new Role();
        $data = $role->find($id);
        if ($data) {

            return view('admin/role/edit', ['role' => $data]);
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
                'rules' => 'required|min_length[3]|max_length[30]|is_unique[role.name,id,' . $id . ']',
                'label' => 'Name',
            ],

            'description' => [
                'rules' => 'required|min_length[3]|max_length[500]',
                'label' => 'Description',
            ],

        ];

        if ($this->validate($rules)) {
            $role = new Role();
            $_POST['id'] = $id;
            $role->save($_POST);
            $info = ['messages' => ['Role updated successfully'], 'type' => 'success'];
            return redirect()->to('admin/role')->withInput()->with('info', $info);
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
        $role = new Role();
        $data = $role->find($id);
        if ($data) {
            $role->delete($id);
            $info = ['messages' => ['Role deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }
    }
}
