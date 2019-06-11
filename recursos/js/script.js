function publicar() {

}

function compartilhar() {

}

function curtir() {
    
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
    var img = document.getElementById('img-' + tipo + '-publi-' + id);
    var p = document.getElementById('p-' + tipo + '-publi-' + id);

    if (tipo == 'like') {
        p.style.color = '#E81919';
        img.src = 'recursos/icones/curtir-hover.svg';
    } else if (tipo == 'share') {
        p.style.color = '#17bf63';
        img.src = 'recursos/icones/compartilhar.svg';
    }
}

function hoverOut(tipo, id) {
    var img = document.getElementById('img-' + tipo + '-publi-' + id);
    var p = document.getElementById('p-' + tipo + '-publi-' + id);

    if (tipo == 'like') {
        p.style.color = '';
        img.src = 'recursos/icones/curtir-off.svg';
    } else if (tipo == 'share') {
        p.style.color = '';
        img.src = 'recursos/icones/compartilhar-off.svg';
    }
}

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