<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DevExpressModel;
use ReflectionException;

class DevExpressController extends BaseController
{
    private DevExpressModel $model;

    public function __construct()
    {
        $this->model = new DevExpressModel();
    }

    /**
     * @throws /ReflectionException
     */
    public function create()
    {
        $_POST['user_id'] = user()->id;
        // var_dump($_POST); exit;
        $existingState = $this->model->where('user_id', $_POST['user_id'])->where('table', $_POST['table'])->first();
        if ($existingState) {
            if ($this->model->update($existingState['id'], $_POST)) {
                $info = ['message' => translate("base.App_save-state"), 'type' => 'success'];
                return $this->response->setJSON($info);
            } else {
                $info = ['message' => "Something wrong happened", 'type' => 'error'];
                return $this->response->setJSON($info);
            }
        } else {
            if ($this->model->insert($_POST)) {
                $info = ['message' => [lang("base.App_save-state", [], session()->get('lang'))], 'type' => 'success'];
                return $this->response->setJSON($info);
            } else {
                $info = ['message' => "Something wrong happened", 'type' => 'error'];
                return $this->response->setJSON($info);
            }
        }
    }

    public function getState($table)
    {
        $useId = user()->id;
        $existingState = $this->model->where('user_id', $useId)->where('table', $table)->first();
        if ($existingState) {
            return $this->response->setJSON($existingState['state']);
        } else {
            return null;
        }
    }
}
