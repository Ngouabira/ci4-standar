<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;

class RoleController extends BaseController
{

    public function index()
    {
        if ($this->request->isAJAX()) {
            $model = new Role();

            // Get the total number of records
            $totalRecords = $model->countAll();

            // Set the limit and offset for pagination
            $limit = $this->request->getGet('length');
            $start = $this->request->getGet('start');

            $search = $this->request->getGet('search[value]');
            // Get the filtered and paginated users
            $users = $model->select('id, name, description')
                ->where('name LIKE "%' . $search . '%" OR description LIKE "%' . $search . '%"')
                ->where('deleted_at IS NULL')
                ->orderBy('id', 'desc')
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
        return view('admin/role/index');
    }

    public function create()
    {
        $permission = new Permission();
        $permissions = $permission->findAll();
        return view('admin/role/create', ['permissions' => $permissions]);
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

        $permissions = $_POST['permissions'];
        unset($_POST['permissions']);

        if ($this->validate($rules)) {
            $role = new Role();
            $roleId = $role->insert($_POST);
            $rolePermission = new RolePermission();
            foreach ($permissions as $permission) {
                $rolePermission->save(['role_id' => $roleId, 'permission_id' => $permission]);
            }
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
            $data['permissions'] = $role->getRolePermissions($id);
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
        $permission = new Permission();
        $permissions = $permission->findAll();
        if ($data) {
            $data['permissions'] = $role->getRolePermissions($id);
            return view('admin/role/edit', ['role' => $data, 'permissions' => $permissions]);
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

        $permissions = $_POST['permissions'];
        unset($_POST['permissions']);

        if ($this->validate($rules)) {
            $role = new Role();
            $_POST['id'] = $id;
            $role->save($_POST);
            $rolePermission = new RolePermission();
            $role->deletePermissions($id);
            foreach ($permissions as $permission) {
                $rolePermission->save(['role_id' => $id, 'permission_id' => $permission]);
            }
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

    public function delete($id)
    {
        $role = new Role();
        if ($role->delete($id)) {
            $info = ['messages' => ['Role deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }

        $info = ['messages' => ['Role not found'], 'type' => 'danger'];
        return redirect()
            ->back()
            ->withInput()
            ->with('info', $info);
    }
}
