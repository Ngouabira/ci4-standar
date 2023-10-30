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

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];
    protected $beforeDelete = ['setDeletedBy'];

    const DATA_QUERY = '*';
    const VIEW_PATH = '/admin/role';
    const REDIRECTION_URL = '/admin/role';

    /**
     * @param $search
     * @return array
     */
    public function filter($search): array
    {
        return ['isdeleted' => 0, 'name LIKE "%' . $search . '%"
        OR description LIKE "%' . $search . '%"
         '];
    }

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

    public function getRolePermissionsId($roleId)
    {
        $permissionModel = new Permission();
        $rolePermissionModel = new RolePermission();
        $permissions = $rolePermissionModel
            ->where('role_id', $roleId)
            ->findAll();
        $tabPermission = [];
        foreach ($permissions as $permission) {
            $tabPermission[] = $permissionModel->find($permission['permission_id'])['id'];
        }
        return $tabPermission;
    }

    public function deletePermissions($roleId)
    {

        $builder = $this->db->table('role_permission')
            ->where('role_id', $roleId);
        $builder->delete();
    }

}
