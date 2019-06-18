function publicar(idUsuario) {
    
}

function compartilhar(id, idPublicacao) {
    var img = document.getElementById('img-share-publi-' + id);
    var p = document.getElementById('p-share-publi-' + id);

    if (p.classList.contains('compartilhou')) {
        p.classList.add('cor-cinza');
        p.classList.remove('cor-verde');
        img.src = 'recursos/icones/compartilhar-off.svg';

        //deseja mesmo descompartilhar, se sim apagar

        var numComps = 0; // buscar o numero de compartilhamentos da publi

        p.innerHTML = numComps;

        p.classList.remove('compartilhou');
    } else {
        p.classList.add('cor-verde');
        p.classList.remove('cor-cinza');
        img.src = 'recursos/icones/compartilhar.svg';

        //compartilhar

        var numComps = 1; // buscar o numero de compartilhamentos da publi

        p.innerHTML = numComps;

        p.classList.add('compartilhou');
    }
}

function curtir(id, idPublicacao, idUsuario) {
    var img = document.getElementById('img-like-publi-' + id);
    var p = document.getElementById('p-like-publi-' + id);

    if (p.classList.contains('curtiu')) {
        var dados = {};
        dados.tipo = 'descurtir';
        dados.idPublicacao = idPublicacao;
        dados.idUsuario = idUsuario;

        $.ajax({
            url: getRoot()+'controller/controllerFeed',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    p.classList.add('cor-cinza');
                    p.classList.remove('cor-vermelha');
                    img.src = 'recursos/icones/curtir-off.svg';
            
                    p.innerHTML = response.numCurtidas;
            
                    p.classList.remove('curtiu');
                }
            }
        });
    } else {
        var dados = {};
        dados.tipo = 'curtir';
        dados.idPublicacao = idPublicacao;
        dados.idUsuario = idUsuario;

        $.ajax({
            url: getRoot()+'controller/controllerFeed',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    p.classList.add('cor-vermelha');
                    p.classList.remove('cor-cinza');
                    img.src = 'recursos/icones/curtir.svg';

                    p.innerHTML = response.numCurtidas;

                    p.classList.add('curtiu');
                }
            }
        });
    }
}

function posicionarBotaoFixo() {
    var divFixa = document.getElementById('botao-fixo');
    var divFeed = document.getElementById('feed-container');
    
    var style = window.getComputedStyle(divFeed);
    
    var marRight = style.getPropertyValue('margin-right'); 
    
    if (marRight == '0px') {
        marRight = '20px';
    }

    divFixa.style.right = marRight;
}

function hover(tipo, id) {
    if (tipo == 'perfil' || tipo == 'sair') {
        var icon = document.getElementById('icon-' + tipo);
        var icon_p = document.getElementById('icon-p-' + tipo);

        icon.src = 'recursos/icones/' + tipo + '-on.svg';
        icon_p.src = 'recursos/icones/' + tipo + '-on.svg';
    } else {
        var img = document.getElementById('img-' + tipo + '-publi-' + id);
        var p = document.getElementById('p-' + tipo + '-publi-' + id);
    
        if (tipo == 'like') {
            if (!p.classList.contains('curtiu')) {
                p.classList.add('cor-vermelha');
                p.classList.remove('cor-cinza');
    
                img.src = 'recursos/icones/curtir-hover.svg';
            }
        } else if (tipo == 'share') {
            if (!p.classList.contains('compartilhou')) {
                p.classList.add('cor-verde');
                p.classList.remove('cor-cinza');
    
                img.src = 'recursos/icones/compartilhar.svg';
            }
        }
    }
}

function hoverOut(tipo, id) {
    if (tipo == 'perfil' || tipo == 'sair') {
        var icon = document.getElementById('icon-' + tipo);
        var icon_p = document.getElementById('icon-p-' + tipo);

        icon.src = 'recursos/icones/' + tipo + '-off.svg';
        icon_p.src = 'recursos/icones/' + tipo + '-off.svg';
    } else {
        var img = document.getElementById('img-' + tipo + '-publi-' + id);
        var p = document.getElementById('p-' + tipo + '-publi-' + id);

        if (tipo == 'like') {
            if (!p.classList.contains('curtiu')) {
                p.classList.add('cor-cinza');
                p.classList.remove('cor-vermelha');
    
                img.src = 'recursos/icones/curtir-off.svg';
            }
        } else if (tipo == 'share') {
            if (!p.classList.contains('compartilhou')) {
                p.classList.add('cor-cinza');
                p.classList.remove('cor-verde');
    
                img.src = 'recursos/icones/compartilhar-off.svg';
            }
        }
    }
}

var subMenu = document.getElementById("subMenu");
var subMenuP = document.getElementById("subMenuP");

// Detect all clicks on the document
document.addEventListener("click", function(event) {
    if (event.target.closest('#abrirSubMenu') != null || event.target.closest('#abrirSubMenuP') != null) {
        if (!subMenu.classList.contains('subMenuVisible') || !subMenuP.classList.contains('subMenuVisible')) {
            subMenu.classList.add('subMenuVisible');
            subMenuP.classList.add('subMenuVisible');
        } else {
            subMenu.classList.remove('subMenuVisible');
            subMenuP.classList.remove('subMenuVisible');            
        }
    } else {
        subMenu.classList.remove('subMenuVisible');
        subMenuP.classList.remove('subMenuVisible');            
    }   
});

//Retorno do root
function getRoot() {
    var root = "http://"+document.location.hostname+"/prog-web/";
    return root;
}

//https://youtu.be/qTDVv3Ddu7s?t=648 máscaras

//Ajax do formulário de cadastro
$("#formCadastro").on("submit", function(event) {
    event.preventDefault();

    var dados = $(this).serialize();

    $.ajax({
        url: getRoot()+'controller/controllerCadastro',
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: function (response) {
            if (response.retorno == 'erro') {
                var msg = "";

                $.each(response.erros, function(key, value) {
                    msg += value + '\n';
                });

                msg = msg.substr(0, (msg.length - 1));

                alert(msg);
            } else {
                alert("Cadastro realizado com sucesso!");
            }
        }
    });
});

//Ajax do formulário de login
$("#formLogin").on("submit", function(event) {
    event.preventDefault();

    var dados = $(this).serialize();

    $.ajax({
        url: getRoot()+'controller/controllerLogin',
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: function (response) {
            if (response.retorno == 'success') {
                window.location.href = response.page;
            } else {
                if (response.tentativas == true) {
                    $('#formLogin').hide();
                }

                var msg = "";

                $.each(response.erros, function(key, value) {
                    msg += value + '\n';
                });

                msg = msg.substr(0, (msg.length - 1));

                alert(msg);
            }
        }
    });
});

//Ajax do formulário de solicitação de nova senha
$("#formSenha").on("submit", function(event) {
    event.preventDefault();

    var dados = $(this).serialize();

    $.ajax({
        url: getRoot()+'controller/controllerSenha',
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: function (response) {
            if (response.retorno == 'erro') {
                var msg = "";

                $.each(response.erros, function(key, value) {
                    msg += value + '\n';
                });

                msg = msg.substr(0, (msg.length - 1));

                alert(msg);
            } else {
                alert("Redefinição de senha enviada com sucesso!");
            }
        }
    });
});

//Ajax do formulário de Redefinição de nova senha
$("#formRedSenha").on("submit", function(event) {
    event.preventDefault();

    var dados = $(this).serialize();

    $.ajax({
        url: getRoot()+'controller/controllerConfirmacaoSenha',
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: function (response) {
            if (response.retorno == 'erro') {
                alert(response.erro);
                if (response.fatal == true) {
                    window.location.href = getRoot()+'esqueci-senha';
                }
            } else {
                alert("Senha redefinida com sucesso!");
                window.location.href = getRoot()+'index';
            }
        }
    });
});