<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Permission;

class PermissionController extends BaseController
{

    private Permission $model;

    public function __construct()
    {
        $this->model = new Permission();

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
        return view($this->model::VIEW_PATH . '/create');
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

        if ($this->validate($rules)) {
            $permission = new Permission();
            $permission->save($_POST);
            $info = ['messages' => ['Permission created successfully'], 'type' => 'success'];
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
        $permission = new Permission();
        $data = $permission->find($id);
        if ($data) {

            return view($this->model::VIEW_PATH . '/show', ['permission' => $data]);

        } else {
            return redirect()
                ->back();
        }
    }

    public function edit($id)
    {
        $permission = new Permission();
        $data = $permission->find($id);
        if ($data) {

            return view($this->model::VIEW_PATH . '/edit', ['permission' => $data]);

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
                'rules' => 'required|min_length[3]|max_length[30]|is_unique[permission.name,id,' . $id . ']',
                'label' => 'Name',
            ],

            'description' => [
                'rules' => 'required|min_length[3]|max_length[500]',
                'label' => 'Description',
            ],

        ];

        if ($this->validate($rules)) {
            $permission = new Permission();
            $_POST['id'] = $id;
            $permission->save($_POST);
            $info = ['messages' => ['Permission updated successfully'], 'type' => 'success'];
            return redirect()->to($this->model::REDIRECTION_URL . '')->withInput()->with('info', $info);
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
        $permission = new Permission();

        if ($permission->delete($id)) {
            $info = ['messages' => ['Permission deleted successfully'], 'type' => 'success'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }

        $info = ['messages' => ['Permission not found'], 'type' => 'danger'];
        return redirect()
            ->back()
            ->withInput()
            ->with('info', $info);
    }
}
