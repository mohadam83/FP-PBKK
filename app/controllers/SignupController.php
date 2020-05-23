<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction()
    {
        
    }

    public function registerAction()
    {
        $user = new Users();

        //assign value from the form to $user
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'username',
                'password'
            ]
        );

        // Store and check for errors
        $success = $user->save();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "Selamat, Akun anda sudah terdaftar!";
        } else {
            $message = "Maaf, ada beberapa data yang belum terisi<br>"
                     . implode('<br>', $user->getMessages());
        }

        // passing a message to the view
        $this->view->message = $message;
    }
}