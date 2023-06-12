<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use function App\Helpers\hasPermission;

class Permission implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('role_permission_helper');
        if (!hasPermission($arguments[0])) {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
