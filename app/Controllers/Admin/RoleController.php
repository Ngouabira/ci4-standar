<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Role;

class RoleController extends BaseController
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
        return view('admin/role/index');
    }

    public function create()
    {
        return view('admin/role/create');
    }

    public function store()
    {
        helper(['form']);

        if ($this->validate($this->creatingRules)) {
            $role = new Role();
            $role->save($_POST);
            return view('admin/role/index', ['message' => 'Role created successfully']);
        } else {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
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

        if ($this->validate($this->editingRules)) {
            $role = new Role();
            $_POST['id'] = $id;
            $role->save($_POST);
            return view('admin/role/index', ['message' => 'Role updated successfully']);
        } else {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
    }

    public function destroy($id)
    {
        $role = new Role();
        $data = $role->find($id);
        if ($data) {
            $role->delete($id);
            return redirect()
                ->back()
                ->withInput()
                ->with('message', 'Role deleted successfully');
        }
    }
}
