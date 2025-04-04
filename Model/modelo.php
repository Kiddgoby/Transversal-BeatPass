<?php

class Usuario {
    private $correo;
    private $password;
    
    // Credenciales específicas para comparar
    private $correoValido = "abcd@gmail.com";
    private $passwordValida = "1234";
    
    public function __construct($correo, $password) {
        $this->correo = $correo;
        $this->password = $password;
    }
    
    public function validarCredenciales() {
        // Verifica si el correo y contraseña coinciden con los valores específicos
        if ($this->correo === $this->correoValido && $this->password === $this->passwordValida) {
            return true;
        } else {
            return false;
        }
    }
}
?>
?>