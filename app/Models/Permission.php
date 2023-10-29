<?php

namespace App\Models;

use CodeIgniter\Model;

class Permission extends Model
{
    protected $table = 'permission';
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
    const VIEW_PATH = '/admin/permission';
    const REDIRECTION_URL = '/admin/permission';

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

}
