<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;

class UserController extends BaseController
{

    public function index()
    {

        if ($this->request->isAJAX()) {
            $model = new User();

            // Get the total number of records
            $totalRecords = $model->countAll();

            // Set the limit and offset for pagination
            $limit = $this->request->getGet('length');
            $start = $this->request->getGet('start');

            $search = $this->request->getGet('search[value]');
            // Get the filtered and paginated users
            $users = $model->select('id, name, email')
                ->where('name LIKE "%' . $search . '%" OR email LIKE "%' . $search . '%"')
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

        return view('admin/user/index');
    }

    public function create()
    {
        $role = new Role();
        $roles = $role->findAll();
        $permission = new Permission();
        $permissions = $permission->findAll();
        return view('admin/user/create', ['roles' => $roles, 'permissions' => $permissions]);
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
        $roles = $_POST['roles'];
        $permissions = $_POST['permissions'];
        unset($_POST['roles']);
        unset($_POST['permissions']);
        if ($this->validate($rules)) {
            $user = new User();
            $userId = $user->insert($_POST);
            $userPermission = new UserPermission();
            $userRole = new UserRole();
            foreach ($roles as $role) {
                $userRole->save(['user_id' => $userId, 'role_id' => $role]);
            }
            foreach ($permissions as $permission) {
                $userPermission->save(['user_id' => $userId, 'permission_id' => $permission]);
            }
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
            $data['roles'] = $user->getUserRoles($id);
            $data['permissions'] = $user->getUserPermissions($id);
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
        $role = new Role();
        $roles = $role->findAll();
        $permission = new Permission();
        $permissions = $permission->findAll();
        if ($data) {
            $data['roles'] = $user->getUserRoles($id);
            $data['permissions'] = $user->getUserPermissions($id);
            return view('admin/user/edit', ['user' => $data, 'roles' => $roles, 'permissions' => $permissions]);

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

        $roles = $_POST['roles'];
        $permissions = $_POST['permissions'];
        unset($_POST['roles']);
        unset($_POST['permissions']);

        if ($this->validate($rules)) {
            $user = new User();
            $_POST['id'] = $id;
            $user->save($_POST);
            $userPermission = new UserPermission();
            $userRole = new UserRole();
            $user->deleteRoles($id);
            $user->deletePermissions($id);
            foreach ($roles as $role) {
                $userRole->save(['user_id' => $id, 'role_id' => $role]);
            }
            foreach ($permissions as $permission) {
                $userPermission->save(['user_id' => $id, 'permission_id' => $permission]);
            }
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

    public function delete($id)
    {
        $user = new User();
        if ($user->delete($id)) {
            ;
            $info = ['messages' => ['User deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }
        $info = ['messages' => ['User not found'], 'type' => 'danger'];
        return redirect()
            ->back()
            ->withInput()
            ->with('info', $info);
    }
}
