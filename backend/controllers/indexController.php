<?php

class indexController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->_view->assign('titulo', 'Login');
        $this->redireccionar('login');
    }
}

?>