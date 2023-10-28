<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;

class RoleController extends BaseController
{
    private Role $model;

    public function __construct()
    {
        $this->model = new Role();

    }

    public function index()
    {
        if ($this->request->isAJAX()) {

            // Get the total number of records
            $totalRecords = $this->model->countAll();

            // Get the pagination parameters
            $limit = intval($this->request->getGet('$top'));
            $start = intval($this->request->getGet('$skip'));

            $search = $this->request->getGet('search[value]');

            // Get the sorting parameters
            $orderby = $this->request->getGet('$orderby') ?? '';
            $orderbyParts = explode(' ', $orderby);

            // Set default sorting if not provided
            $order = $orderbyParts[0] ? $orderbyParts[0] : 'id';
            $dir = count($orderbyParts) > 1 ? 'desc' : ($orderbyParts[0] ? 'asc' : 'asc');

            // Get the filtered roles
            $this->model->select($this->model::DATA_QUERY)
                ->where($this->model->filter($search))
                ->orderBy($order, $dir)
                ->limit($limit, $start);

            $values = $this->model->get()->getResultObject();

            // Prepare the response data
            $data = [
                'data' => $values,
                'totalCount' => $totalRecords,
            ];

            return $this->response->setJSON($data);
        }
        return view($this->model::VIEW_PATH . '/index');
    }

    public function new ()
    {
        $permission = new Permission();
        $permissions = $permission->findAll();
        return view($this->model::VIEW_PATH . '/create', ['permissions' => $permissions]);
    }

    public function create()
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
            return redirect()->to($this->model::REDIRECTION_URL)->withInput()->with('info', $info);
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
            return view($this->model::VIEW_PATH . '/show', ['role' => $data]);
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
            return view($this->model::VIEW_PATH . '/edit', ['role' => $data, 'permissions' => $permissions]);
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
            return redirect()->to($this->model::REDIRECTION_URL)->withInput()->with('info', $info);
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
