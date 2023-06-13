<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;

class PermissionController extends BaseController
{

    public function index()
    {
        if ($this->request->isAJAX()) {
            $model = new Permission();

            // Get the total number of records
            $totalRecords = $model->countAll();

            // Set the limit and offset for pagination
            $limit = $this->request->getGet('length');
            $start = $this->request->getGet('start');

            $search = $this->request->getGet('search[value]');
            $order = $this->request->getGet('order[0][column]');
            $dir = $this->request->getGet('order[0][dir]');
            // Get the filtered and paginated users
            $users = $model->select('id, name, description')
                ->where('name LIKE "%' . $search . '%" OR description LIKE "%' . $search . '%"')
                ->where('deleted_at IS NULL')
                ->orderBy($order, $dir)
                ->limit($limit, $start)
                ->get()->getResultObject();

            // Prepare the response data
            $data = [
                'draw' => $this->request->getGet('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $users,
            ];

            return json_encode($data);
        }
        return view('admin/permission/index');
    }

    public function select()
    {
        if ($this->request->isAJAX()) {
            $model = new Permission();

            // Get the total number of records
            $totalRecords = $model->countAll();

            // Set the limit and offset for pagination
            $limit = $this->request->getGet('length');
            $start = $this->request->getGet('start');

            $search = $this->request->getGet('search[value]');
            $order = $this->request->getGet('order[0][column]');
            $dir = $this->request->getGet('order[0][dir]');
            // Get the filtered and paginated users
            $users = $model->select('id, name, description')
                ->where('name LIKE "%' . $search . '%" OR description LIKE "%' . $search . '%"')
                ->where('deleted_at IS NULL')
                ->orderBy($order, $dir)
                ->limit($limit, $start)
                ->get()->getResultObject();

            // Prepare the response data
            $data = [
                'draw' => $this->request->getGet('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $users,
            ];

            return json_encode($data);
        }
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

    public function delete($id)
    {
        $permission = new Permission();

        if ($permission->delete($id)) {
            $info = ['messages' => ['Permission deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }

        $info = ['messages' => ['Permission not found'], 'type' => 'danger'];
        return redirect()
            ->back()
            ->withInput()
            ->with('info', $info);
    }
}
