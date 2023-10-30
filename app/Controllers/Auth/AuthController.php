<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{

    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        helper(['form']);
        $rules = [

            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'label' => 'Email',
            ],
            'password' => [
                'rules' => 'required',
                'label' => 'Password',
            ],

        ];

        if ($this->validate($rules)) {
            $user = new User();
            $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $user->save($_POST);
            $info = ['messages' => ['Account created successfully'], 'type' => 'success'];
            return redirect()->to('/login')->withInput()->with('info', $info);
        } else {
            $info = ['messages' => $this->validator->getErrors(), 'type' => 'danger'];
            return redirect()
                ->back()
                ->withInput()
                ->with('info', $info);
        }
    }

    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $rules = [

            'email' => [
                'rules' => 'required',
                'label' => 'Email',
            ],
            'password' => [
                'rules' => 'required',
                'label' => 'Password',
            ],

        ];

        if (!$this->validate($rules)) {
            $info = ['messages' => $this->validator->getErrors(), 'type' => 'danger'];
            return redirect()->back()->withInput()->with('info', $info);
        } else {
            $model = new User();
            $user = $model->where('email', $_POST['email'])
                ->first();
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $this->setSession($user);
                return redirect()->to('/');
            } else {
                $info = ['messages' => ["Email or password don't match"], 'type' => 'danger'];
                return redirect()->back()->withInput()->with('info', $info);
            }

        }
    }

    public function forgotPassword()
    {
        return view('auth/forgotpassword');
    }

    public function attemptForgotPassword()
    {
        return view('auth/forgotpassword');
    }

    public function resetPassword()
    {
        return view('auth/resetpassword');
    }

    public function attemptResetPassword()
    {
        return view('auth/resetpassword');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    private function setSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'lang' => $user['lang'],
            'image' => $user['image'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

}
