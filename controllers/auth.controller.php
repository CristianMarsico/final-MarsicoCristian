<?php

class AuthController {

    public function verify(){

        /**
         * SUPONGO QUE SON DATOS TOMADOS DEL FORMULARIO
         */
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $username = $this->model->getUser($user);
        if($user && password_verify($pass, $username->pass)){

            session_start();
            $_SESSION ['ID'] = $username->id;
            $_SESSION ['NOMBRE'] = $username->name;

            header('Location.' . 'algo');
        }else {
            $this->view->showError ("datos invalidos");
        }
    }
}