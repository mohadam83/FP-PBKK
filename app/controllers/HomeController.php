<?php
declare(strict_types=1);

class HomeController extends ControllerBase
{

    public function indexAction()
    {
        
    }

    public function index2Action()
    {
        // $this->view->disable();
        // return var_dump($_POST);
        $input_count = $_POST["input_count"];
        $this->view->input_count =  (int) $input_count;
        // $this->view->pick('index2');
    }

    public function index1Action()
    {
        
    }

    public function rekapAction()
    {
        
        
    }

    public function rekaphasilAction()
    {
        $input_kategori = $_POST["input_kategori"];
        // return $input_kategori; 
        $this->view->donasis = Donasi::find('kategori ="'.(string) $input_kategori.'"');       
    }

    public function donasiAction()
    {
        $this->view->disable();

        $input_count = (int) $_POST['input_count'];
        
        // echo $auth = $this->session->get('auth', ['name'=> $user->name]);

        for ($i = 1; $i <= $input_count; $i = $i + 1){
            $donasi = new Donasi();

            //assign value from the form to $user
            $donasi->donatur = $_POST["donatur"];
            $donasi->kategori = $_POST["kategori".$i];
            $donasi->detail = $_POST["detail".$i];
            
            $success = $donasi->save();       
        }
        $this->response->redirect('/home');
    }
    public function logoutAction()
    {
        // Destroy the whole session
        $this->session->destroy();
        $this->response->redirect('/');
    }
}