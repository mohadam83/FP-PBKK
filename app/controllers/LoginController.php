<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        
    }

    public function loginAction()
    {
        
        if ($this->session->has('auth')) {
            $this->response->redirect('/home');
        }
        
        if ($this->request->isPost()) {
            // Checking if the form is valid

            $username = $this->request->get('username');
            $password = $this->request->get('password');

            $user = Users::findFirst([
                'username = :username:',
                'bind' => [
                    'username' => $username,
                ]
            ]);
            if ($user) {
                $this->registerSession($user);
                $this->flash->success('Welcome ' . $user->name);

                $this->dispatcher->forward([
                    'controller' => 'home',
                    'action'     => 'index',
                ]);

                return;
            }


        }
    }
    private function registerSession(Users $user): void
    {
        $this->session->set('auth', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }
}