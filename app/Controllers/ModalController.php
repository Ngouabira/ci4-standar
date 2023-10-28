<?php

namespace App\Controllers;

class ModalController extends BaseController
{

    public function index()
    {
        $values = $this->request->getGet('data');
        $values = json_decode("$values", true);
        $url = '/Components/modal_content3';
        $columns = [$values['column1'], $values['column2']];

        if (isset($values['input'])) {
            $columns[] = $values['input'];
            $url = '/Components/modal_content2';
        }

        $data = [
            'field' => $values['field'],
            'modalId' => $values['modalId'],
            'route' => $values['route'],
            'model' => $values['model'],
            'columns' => $columns,

        ];
        return view($url, compact('data'));
    }

}
