function cuentaBtn() {
    const emailUsuario = localStorage.getItem("email");
    const emailAdmin = "administrador1234@gmail.com";
    
    console.log("Email del usuario:", emailUsuario);

    if (emailUsuario === emailAdmin) {
        window.location.href = "../Cuenta/cuenta_Admin.php?email=" + emailAdmin;
    } else {
        window.location.href = "../Cuenta/cuenta.php?email=" + emailUsuario;
    }
}
