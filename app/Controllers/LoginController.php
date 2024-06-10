<?php

namespace App\Controllers;

use App\Models\CustomSession;
use App\Models\User;
use App\Models\Admin;
use Google\Service\Oauth2 as Google_Service_Oauth2;
use Facebook\Facebook as Facebook;
 
class LoginController extends BaseController
{
    private $userModel = null;
    private $facebook = null;
    private $fb_helper = null;
    private $googleClient = null;
    function __construct()
    {
        if ($this->facebook === null) {
            require APPPATH.'Libraries\vendor\autoload.php';
            // require 'C:\xampp\htdocs\pepicase\app\Libraries\vendor\autoload.php';
            $this->facebook = new \Facebook\Facebook([
                'app_id' => '774527684780044', //for example, 774527684780044
                'app_secret' => '5653abdd091dd9ca04afa8a7dbb16f0d', //for example, 85b5b8bc72a01831f09e35984826a215
                'default_graph_version' => 'v5.1'
            ]);
            $this->fb_helper = $this->facebook->getRedirectLoginHelper();
        }

        $this->userModel = new User();
        if ($this->googleClient === null) {
            require APPPATH.'Libraries\vendor\autoload.php';
            // require 'C:\xampp\htdocs\pepicase\app\Libraries\vendor\autoload.php';
            $this->googleClient = new \Google_Client();
            $this->googleClient->setClientId('940988695510-20vnmeqjd2hrqg717q0clbpmsd0nsq8l.apps.googleusercontent.com'); //for example, 940988695510-20vnmeqjd2hrqg717q0clbpmsd0nsq8l.apps.googleusercontent.com
            $this->googleClient->setClientSecret('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'); //for example, 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
            $this->googleClient->setRedirectUri('http://localhost/pepicase/public/loginWithGoogle'); //for example, https://localhost/pepicase/loginWithGoogle
            $this->googleClient->addScope("email");
            $this->googleClient->addScope("profile");
        }
    }
    public function login()
    {
        $fb_permission = ['email'];
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");


        $rules = [
            'email' => 'valid_email',
        ];

        $data = [
            'validation' => '',
        ];

        if ($this->validate($rules)) {
            $user = new User($email, $password);
            if ($user->id != null) {
                $new_session = new CustomSession($user->id);
                if($user->isAdmin == '1')
                {
                    return redirect() -> to ('/redirect');
                }
                $result = $new_session->get_previous_url();
                if($result == null) return redirect() -> to('/');
                else return redirect() -> to ($result);
            } else {
                $message = [
                    'msg' => 'Wrong email or password!',
                    'fb_btn' => $this->fb_helper->getLoginUrl('http://localhost/pepicase/public/loginWithFacebook?', $fb_permission),
                    'googleButton' => $this->googleClient->createAuthUrl(),
                ];
                return view('login', $message);
            }
        } else {
            $data['validation'] = $this->validator;
            $data['fb_btn'] = $this->fb_helper->getLoginUrl('http://localhost/pepicase/public/loginWithFacebook?', $fb_permission);
            $data['googleButton'] = $this->googleClient->createAuthUrl();    
            return view('login', $data);
        }
    }

    public function logout()
    {
        $currentSession = new CustomSession(null);
        $currentSession->delete_session_cookie();
        return redirect()->to('/');
    }  


    public function index()
    {
        $curr_session = new CustomSession(null);
        if ($curr_session->isSessionSet()) return redirect() -> to('/');

        $previousUrl = $this->request->getServer('HTTP_REFERER');
        if (strpos($previousUrl, 'http://localhost/pepicase/public/product/') === 0 || strpos($previousUrl, 'http://localhost/pepicase/public/user/cart') === 0) 
            $curr_session->set_previous_url((string)$previousUrl);

        $fb_permission = ['email'];
        $data['fb_btn'] = $this->fb_helper->getLoginUrl('http://localhost/pepicase/public/loginWithFacebook?', $fb_permission);
        $data['googleButton'] = $this->googleClient->createAuthUrl();
        return view('login', $data);
    }

/*
    public function loginWithFB()
    {
        if ($this->request->getVar('state')) {
            $this->fb_helper->getPersistentDataHandler()->set('state', $this->request->getVar('state'));
        }

        if ($this->request->getVar('code')) {
            if (session()->get("access_token")) {
                $access_token = session()->get("access_token");
            } else {
                $access_token = $this->fb_helper->getAccessToken();
                session()->set("access_token", $access_token);
                $this->facebook->setDefaultAccessToken(session()->get('access_token'));
            }
            $graph_response = $this->facebook->get('/me?fields=name,email', $access_token);
            $fb_user_info = $graph_response->getGraphUser();
            if (!empty($fb_user_info)) {
                $userData = array(
                    'user_name' => $fb_user_info['name'],
                    'user_email' => $fb_user_info['email'],
                    'authid' => $fb_user_info['id'],
                );
                session()->set('LoggedUser', $userData);
            }
            return redirect()->to('/');
        }
    } */

    public function loginWithFB()
	{
		if($this->request->getVar('state')){
			$this->fb_helper->getPersistentDataHandler()->set('state', $this->request->getVar('state'));
		}
		if($this->request->getVar('code')){
			if(session()->get("access_token")){
				$access_token = session()->get('access_token');
			}else{
                $access_token = $this->fb_helper->getAccessToken();
				session()->set("access_token", $access_token);
				$this->facebook->setDefaultAccessToken(session()->get('access_token'));
			}
			$graph_response = $this->facebook->get('/me?fields=name,email', 'EAALAbceFIAwBOx6DlP5P45ykxQZArletHnPbM9h2BcTvH8i1DgyMFukdXS9BZAuF5XIZAMUjDujE8BNNkTMQy5GTMtmi33Tb3YU2CIOuHhTIXSzbbaw0nQQ0I1ek27zPuDzbtRT19szFVD8M5fgCkmyOc16ZCqDup28R8gELUga2h7G5kXJ3MBKWNemPeGyZA6uzLNDyWZAH6CW2kivv8ajcMtPe3qiBTqAhRdmxXg9CuKQx1rRLDR9CqL8ejPsgZDZD');
			$fb_user_info = $graph_response->getGraphUser();
			if(!empty($fb_user_info)){
				$fbdata = array(
					'authid'=>$fb_user_info['id'],
					'profile_pic' => 'http://graph.facebook.com/'.$fb_user_info['id'].'/picture',
					'user_name' => $fb_user_info['name']
				);

				//here you can insert user data in database
				
				session()->set('LoggedUser', $fbdata);
			}
		}else{
			session()->setFlashData('error', 'Something Wrong');
			return redirect()->to(base_url());
		}
		return redirect()->to(base_url().'/');
	}
    /*

    public function logout()
	{
		if(session()->has('LoggedUser')){
			session()->remove('LoggedUser');
			session()->setFlashData('success', 'Logout Successful');
			return redirect()->to(base_url());
		}else{
			session()->setFlashData('error', 'Failed to Logout, Please Try again...');
			return redirect()->to(base_url());
		}
	} */

    public function loginWithGoogle()
{
    $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
    if (!isset($token['error'])) {
        $this->googleClient->setAccessToken($token['access_token']);
        
        // Sử dụng CustomSession để lưu AccessToken
        //$customSession = new CustomSession(null);
        //$customSession->set_field("AccessToken", $token['access_token']);
        
        $googleService = new \Google\Service\Oauth2($this->googleClient);
        $data = $googleService->userinfo->get();
        //print_r($data); die;
        $userdata = array();
        $userModel = new User($data['email'], null, $data['id']);
        $userId = $userModel->id;
        
        //$userModel = new User($data['id']);
        //print_r($userId); die; //vượt qua

        if ($userModel->check_if_authorized()) {
            $userdata = [
                'userid' => $userModel->id,
                'First_Name' => $data['givenName'],
                'Last_Name' => $data['familyName'],
                'email' => $data['email'],
            ];
            $userModel->updateUserData($userdata);
            $customSession = new CustomSession($userId);

            //print_r($customSession->isSessionSet()); die;
            $customSession->set_field("LoggedUserData", $userdata);

            $result = $customSession->get_previous_url();
            if($result == null) return redirect() -> to('/');
            else return redirect() -> to ($result);
        } 
    } else {
        session()->setFlashData("Error", "Something went wrong");
        return redirect()->to('/login');
    }
}


}
