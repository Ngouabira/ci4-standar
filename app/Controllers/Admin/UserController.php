<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{

    public function index()
    {

        if ($this->request->isAJAX()) {
            $model = new User();

            // Get the total number of records
            $totalRecords = $model->countAll();

            // Set the limit and offset for pagination
            $limit = $this->request->getPost('length');
            $offset = $this->request->getPost('start');

            // Get the filtered and paginated users
            $users = $model->select('id, name, email')
                ->orderBy('id', 'desc')
                ->limit($limit, $offset)
                ->findAll();

            // Prepare the response data
            $data = [
                'draw' => $this->request->getPost('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $users,
            ];

            return json_encode($data);
        }

        return view('admin/user/index');
    }

    public function create()
    {
        return view('admin/user/create');
    }

    public function store()
    {
        helper(['form']);
        $rules = [

            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'label' => 'Name',
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'label' => 'Email',
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]',
                'label' => 'Password',
            ],

        ];
        unset($_POST['role']);
        if ($this->validate($rules)) {
            $user = new User();
            $user->save($_POST);
            $info = ['messages' => ['User created successfully'], 'type' => 'success'];
            return redirect()->to('admin/user')->withInput()->with('info', $info);
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
        $rules = [

            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'label' => 'Name',
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email,id,' . $id . ']',
                'label' => 'Email',
            ],
        ];

        if ($this->validate($rules)) {
            $user = new User();
            $_POST['id'] = $id;
            $user->save($_POST);
            $info = ['messages' => ['User updated successfully'], 'type' => 'success'];
            return redirect()->to('admin/user')->withInput()->with('info', $info);
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
        $user = new User();
        $data = $user->find($id);
        if ($data) {
            $user->delete($id);
            $info = ['messages' => ['User deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }
    }
}
