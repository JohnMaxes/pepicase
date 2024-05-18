<?php

namespace App\Controllers;
use App\Models\CustomSession;
use App\Models\User;
use App\Models\Session;
use CodeIgniter\Services;

class LoginController extends BaseController
{
    public function login()
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        $rules = [
            'email' => 'valid_email',
        ];

        $data = [
            'validation' => '',
        ];

        $user = new User($email, $password);
        if($this->validate($rules))
        {
            if ($user->id != null) {
                new CustomSession($user->id);
                return redirect() -> to('/');
            }
            else
            {
                $message = [
                    'msg' => 'Wrong email or password!',
                ];
                return view('login', $message);
            } 
        }
        else 
        {
            $data['validation'] = $this->validator;
            return view('login', $data);
        }
    }

    public function logout()
    {
        $current_session = new CustomSession(null);
        $current_session->delete_session_cookie();
        return redirect() -> to('/');
    }


    public function index()
    {
        $curr_session = new CustomSession(null);
        if ($curr_session->isSessionSet()) return redirect() -> to('/');
        else return view('login');
    }
}