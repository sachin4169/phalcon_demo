<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{

    public function indexAction()
    {
    }
    public function welcomeAction()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = Users::findFirstByemail($email);
        if ($user != null) {
            if ($user->password == $password) {
                $message = 'user authenticated';
                $success = $user->save();
                $this->response->redirect('/product');
                $this->view->success = $success;
                $this->view->message = $message;
            } else {
                $message = "you are not approved yet";
                $this->response->redirect('/login');
            }
        } else {
            $message = 'your are not authenticated ';
            $this->view->message = $message;
            $this->response->redirect('/login');
        }
    }
}
