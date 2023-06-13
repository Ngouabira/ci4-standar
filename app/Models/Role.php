<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getRolePermissions($roleId)
    {
        $permissionModel = new Permission();
        $rolePermissionModel = new RolePermission();
        $permissions = $rolePermissionModel
            ->where('role_id', $roleId)
            ->findAll();
        $tabPermission = [];
        foreach ($permissions as $permission) {
            $tabPermission[] = $permissionModel->find($permission['permission_id']);
        }
        return $tabPermission;
    }

    public function deletePermissions($userId)
    {
        $rolePermissionModel = new RolePermission();
        $rolePermissionModel->where('role_id', $userId)->delete();
    }

}
