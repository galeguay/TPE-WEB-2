<?php
require_once "model/UserModel.php";
require_once "view/LoginView.php";
require_once "helpers/AuthHelper.php";

class LoginController{
    private $model;
    private $view;
    private $authHelper;


    public function __construct(){
        $this->model = new UserModel();
        $this->view = new LoginView();
        $this->authHelper = new AuthHelper();
    }

    //VERIFICA SI EXISTE EL EMAIL EN LA BD Y LA CONTRASEÑA COINCIDE
    function verifyLogIn(){
        if(isset($_POST['email']) && isset($_POST['pass'])){
            $userEmail = $_POST['email'];
            $user = $this->model->getUser($userEmail);
            if($user && password_verify($_POST['pass'] ,($user->contraseña ))){
                session_start();
                $_SESSION ["email" ] = $userEmail;
                header("Location: ".BASE_URL."adminProducts");
            } else{
                $this->view->renderLogIn();
            }
        }
    }

    //REDIRIGE A LA PAGINA DE LOGUEO
    function showLogIn(){
        $this->view->renderLogIn();
    }

    //REDIRIGE A LA PAGINA DE LOGUEO
    function logOut(){
        $this->authHelper->logOut();
    }

    //REDIRIGE A LA PAGINA DE LOGUEO
    function showRegister(){
        $this->view->renderRegister();
    }

    function addUser(){
        if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['pass'])){
            $pass=password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $this->model->addUser($_POST['nombre'], $_POST['email'], $pass);
            header("Location: ".BASE_URL."home");
        }
    }
}