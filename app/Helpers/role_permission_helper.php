<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\UserPermission;
use App\Models\UserRole;

function hasRole($roleName)
{
    $userRoles = getUserRoles(session()->get('id'));
    return in_array($roleName, $userRoles);

}

function hasPermission($permissionName)
{
    $userPermissions = getUserPermissions(session()->get('id'));
    return in_array($permissionName, $userPermissions);
}

function getUserRoles($userId)
{
    $roleModel = new Role();
    $userRoleModel = new UserRole();

    $roles = $userRoleModel
        ->where('user_id', $userId)
        ->findAll();

    $roleNames = [];
    foreach ($roles as $role) {
        $roleNames[] = $roleModel->find($role['role_id'])['role_name'];
    }

    return $roleNames;
}

function getUserPermissions($userId)
{
    // Load the necessary models
    $roleModel = new Role();
    $permissionModel = new Permission();
    $rolePermissionModel = new RolePermission();
    $userPermissionModel = new UserPermission();
    $userRoleModel = new UserRole();

    // Retrieve the roles associated with the user
    $roles = $userPermissionModel
        ->where('user_id', $userId)
        ->findAll();

    // Retrieve the permission names associated with the user
    $permissionNames = $userRoleModel
        ->where('user_id', $userId)
        ->findAll();

    foreach ($roles as $role) {
        $permissions = $rolePermissionModel
            ->where('role_id', $role['role_id'])
            ->findAll();

        foreach ($permissions as $permission) {
            $permissionNames[] = $permissionModel->find($permission['permission_id'])['permission_name'];
        }
    }

    return $permissionNames;

}
