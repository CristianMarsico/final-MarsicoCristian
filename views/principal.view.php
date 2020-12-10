<?php
require_once 'libs/smarty/Smarty.class.php';
class PrincipalView
{
    public $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('baseURL', BASE_URL);
    }
}
