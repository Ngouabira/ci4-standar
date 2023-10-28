<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'password'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];
    protected $beforeDelete = ['setDeletedBy'];

    const DATA_QUERY = '*';
    const VIEW_PATH = '/admin/user';
    const REDIRECTION_URL = '/user';

    /**
     * @param $search
     * @return array
     */
    public function filter($search): array
    {
        return ['isdeleted' => 0, 'name LIKE "%' . $search . '%"
        OR description LIKE "%' . $search . '%" OR email LIKE "%' . $search . '%"
         ', ];
    }

    public function hashPassword(array $data)
    {
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }

    public function getUserRoles($userId)
    {
        $roleModel = new Role();
        $userRoleModel = new UserRole();
        $roles = $userRoleModel
            ->where('user_id', $userId)
            ->findAll();
        $tabRole = [];
        foreach ($roles as $role) {
            $tabRole[] = $roleModel->find($role['role_id']);
        }

        return $tabRole;
    }

    public function getUserPermissions($userId)
    {
        $permissionModel = new Permission();
        $userPermissionModel = new UserPermission();
        $permissions = $userPermissionModel
            ->where('user_id', $userId)
            ->findAll();
        $tabPermission = [];
        foreach ($permissions as $permission) {
            $tabPermission[] = $permissionModel->find($permission['permission_id']);
        }

        return $tabPermission;
    }

    public function deletePermissions($userId)
    {
        $userPermissionModel = new UserPermission();
        $userPermissionModel->where('user_id', $userId)->delete();
    }

    public function deleteRoles($userId)
    {
        $roleModel = new UserRole();
        $roleModel->where('user_id', $userId)->delete();
    }

}
