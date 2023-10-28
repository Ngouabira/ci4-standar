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

    private User $model;

    public function __construct()
    {
        $this->model = new User();

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
        $role = new Role();
        $roles = $role->findAll();
        $permission = new Permission();
        $permissions = $permission->findAll();
        return view($this->model::VIEW_PATH . '/create', ['roles' => $roles, 'permissions' => $permissions]);
    }

    public function create()
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
        $user = new User();
        $data = $user->find($id);
        if ($data) {
            $data['roles'] = $user->getUserRoles($id);
            $data['permissions'] = $user->getUserPermissions($id);
            return view($this->model::VIEW_PATH . '/show', ['user' => $data]);

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
            return view($this->model::VIEW_PATH . '/edit', ['user' => $data, 'roles' => $roles, 'permissions' => $permissions]);

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

    public function profile()
    {
        return view($this->model::VIEW_PATH . '/profile');
    }

    public function updateProfile()
    {
        return view($this->model::VIEW_PATH . '/profile');
    }

    public function updatePhoto()
    {
        return view($this->model::VIEW_PATH . '/profile');
    }
}
