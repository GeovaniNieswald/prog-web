function redirecionarPerfil(usuario) {
    if (usuario == '') {
        window.location.href = "perfil.html";
    } else {
        window.location.href = "perfil.html/" + usuario;
    }    
}