<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{

    protected $creatingRules = [

        'name' => [
            'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[user.name]',
            'label' => 'Name',
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[user.email]',
            'label' => 'Email',
        ],
        'password' => [
            'rules' => 'required|strong_password',
            'label' => 'Password',
        ],

    ];

    protected $editingRules = [

        'name' => [
            'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[user.name,id,{id}]',
            'label' => 'Name',
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[user.email,id,{id}]',
            'label' => 'Email',
        ],
        'password' => [
            'rules' => 'required|strong_password',
            'label' => 'Password',
        ],

    ];

    public function index()
    {
        return view('admin/user/index');
    }

    public function create()
    {
        return view('admin/user/create');
    }

    public function store()
    {
        helper(['form']);

        if ($this->validate($this->creatingRules)) {
            $user = new User();
            $user->save($_POST);
            return view('admin/user/index', ['message' => 'User created successfully']);
        } else {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

    }

    public function show($id)
    {
        $user = new User();
        $data = $user->find($id);
        if ($data) {

            return view('admin/user/show', ['user' => $data]);

        } else {
            return redirect()
                ->back();
        }
    }

    public function edit($id)
    {
        $user = new User();
        $data = $user->find($id);
        if ($data) {

            return view('admin/user/edit', ['user' => $data]);

        } else {
            return redirect()
                ->back();
        }
    }

    public function update($id)
    {
        helper(['form']);

        if ($this->validate($this->editingRules)) {
            $user = new User();
            $_POST['id'] = $id;
            $user->save($_POST);
            return view('admin/user/index', ['message' => 'User updated successfully']);
        } else {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
    }

    public function destroy($id)
    {
        $user = new User();
        $data = $user->find($id);
        if ($data) {
            $user->delete($id);
            return redirect()
                ->back()
                ->withInput()
                ->with('message', 'User deleted successfully');
        }
    }
}
