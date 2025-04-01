<?php
 
 session_start();
 
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        $user = new UserController();

        if (isset($_POST["Login"])) {
            $gmail = $_POST["gmail"];
            $password = $_POST["password"];
    
            if ($user->login($gmail, $password)) {
                echo "<p>Inicio de sesión exitoso.</p>";
            } else {
                echo "<p>Correo o contraseña incorrectos.</p>";
            }

        if (isset($_Post["Logout"])){
            echo "<p> Logout Button is clicked.</p>";
            $user->logout();
        }

        if (isset($_Post["Register"])){
            echo "<p> Regiter Button is clicked.</p>";
            $user->register();
        }

    }

    Class UserController
    {
        private $conn;
        public function login($gmail, $password)
        {
            // Datos de acceso simulados
            $userGmail = "abcd@gmail.com";
            $userPassword = "1234";
    
            if ($gmail == $userGmail && $password == $userPassword) {
                return true;
            } else {
                return false;
            }

    }

    public function logout(){


    }

    public function register(){

    }
}
    }

    