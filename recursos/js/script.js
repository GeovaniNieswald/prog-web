function publicar(idUsuario) {
    var conteudo = $('#editor').trumbowyg('html');
    
    if (conteudo == '') {
        alert("Você deve escrever alguma coisa");
    } else {
        var dados = {};
        dados.tipo = 'publicar';
        dados.idUsuario = idUsuario;
        dados.conteudo = conteudo;

        $.ajax({
            url: getRoot()+'controller/controllerFeed',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    window.location.reload();
                } 
            }
        });
    }
}

function compartilhar(id, idPublicacao, idUsuario, idCriador) {
    var img = document.getElementById('img-share-publi-' + id);
    var p = document.getElementById('p-share-publi-' + id);

    if (p.classList.contains('compartilhou')) {
        var r = confirm("Deseja mesmo descompartilhar a publicação?");

        if (r) {
            var dados = {};
            dados.tipo = 'descompartilhar';
            dados.idPublicacao = idPublicacao;
            dados.idUsuario = idUsuario;
            dados.idCriador = idCriador;

            $.ajax({
                url: getRoot()+'controller/controllerFeed',
                type: 'POST',
                dataType: 'json',
                data: dados,
                success: function (response) {
                    if (response.retorno == 'success') {
                        p.classList.add('cor-cinza');
                        p.classList.remove('cor-verde');
                        img.src = 'recursos/icones/compartilhar-off.svg';

                        p.innerHTML = response.numComps;

                        p.classList.remove('compartilhou');
                        window.location.reload();
                    }
                }
            });            
        }        
    } else {
        var dados = {};
        dados.tipo = 'compartilhar';
        dados.idPublicacao = idPublicacao;
        dados.idUsuario = idUsuario;
        dados.idCriador = idCriador;

        $.ajax({
            url: getRoot()+'controller/controllerFeed',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    p.classList.add('cor-verde');
                    p.classList.remove('cor-cinza');
                    img.src = 'recursos/icones/compartilhar.svg';

                    p.innerHTML = response.numComps;

                    p.classList.add('compartilhou');
                    window.location.reload();
                }
            }
        });        
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

function apagar(id) {
    var r = confirm("Deseja mesmo apagar a publicação?");

    if (r) {
        var dados = {};
        dados.tipo = 'apagar';
        dados.id = id;

        $.ajax({
            url: getRoot()+'controller/controllerFeed',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    alert("Publicação apagada com sucesso!");
                    window.location.reload();
                } else {
                    alert("Não foi possível apagar sua publicação!");
                }
            }
        });        
    }
}

function editar(id, conteudo) {
    $('#editor-p').trumbowyg('html', conteudo);

    document.getElementById("salvar").onclick = function () { editarP(id); };
}

function editarP(id) {
    var r = confirm("Deseja mesmo editar a publicação? Isso excluira todos os compartilhamentos e curtidas da publicação!");

    if (r) {
        var dados = {};
        dados.tipo     = 'editar';
        dados.id       = id;
        dados.conteudo = $('#editor-p').trumbowyg('html');

        $.ajax({
            url: getRoot()+'controller/controllerFeed',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    alert("Publicação editada com sucesso!");
                    window.location.reload();
                } else {
                    alert("Não foi possível editar sua publicação!");
                }
            }
        });        
    }
}

$("#seguir").on("click", function(event) {
    event.preventDefault();

    var seguir = document.getElementById("seguir");

    if (seguir.classList.contains('seguir-botao')) {
        var dados = {};
        dados.tipo = 'seguir';
        dados.idAlvo = document.getElementById("idAlvo").value;
        dados.idUsuario = document.getElementById("idUsuario").value;

        $.ajax({
            url: getRoot()+'controller/controllerRelacionamento',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    seguir.classList.add('seguindo-botao');
                    seguir.classList.remove('seguir-botao');
                    seguir.classList.remove('seguir-botao-hover');
                    seguir.innerHTML = 'Seguindo';
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            }
        });
    } else {
        var dados = {};
        dados.tipo = 'pararSeguir';
        dados.idAlvo = document.getElementById("idAlvo").value;
        dados.idUsuario = document.getElementById("idUsuario").value;

        $.ajax({
            url: getRoot()+'controller/controllerRelacionamento',
            type: 'POST',
            dataType: 'json',
            data: dados,
            success: function (response) {
                if (response.retorno == 'success') {
                    seguir.classList.add('seguir-botao');
                    seguir.classList.remove('seguindo-botao');
                    seguir.classList.remove('seguindo-botao-hover');
                    seguir.innerHTML = 'Seguir';
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            }
        });
    }
});

$("#seguir").on("mouseover", function(event) {
    event.preventDefault();

    var seguir = document.getElementById("seguir");

    if (seguir.classList.contains('seguir-botao')) {
        seguir.classList.add('seguir-botao-hover');
        
    } else {
        seguir.classList.add('seguindo-botao-hover');
        seguir.innerHTML = 'Deixar de seguir';
    }   
});

$("#seguir").on("mouseout", function(event) {
    event.preventDefault();

    var seguir = document.getElementById("seguir");

    if (seguir.classList.contains('seguir-botao')) {
        seguir.classList.remove('seguir-botao-hover');
        
    } else {
        seguir.classList.remove('seguindo-botao-hover');
        seguir.innerHTML = 'Seguindo';
    }   
});

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

        var img = document.createElement('img');
        img.src = 'recursos/icones/' + tipo + '-on.svg';

        img.onload = function(e){
            icon.src   = 'recursos/icones/' + tipo + '-on.svg';
            icon_p.src = 'recursos/icones/' + tipo + '-on.svg';
        };
        img.onerror = function(e) {
            icon.src   = '../recursos/icones/' + tipo + '-on.svg';
            icon_p.src = '../recursos/icones/' + tipo + '-on.svg';
        };
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

        var img = document.createElement('img');
        img.src = 'recursos/icones/' + tipo + '-off.svg';

        img.onload = function(e){
            icon.src   = 'recursos/icones/' + tipo + '-off.svg';
            icon_p.src = 'recursos/icones/' + tipo + '-off.svg';
        };
        img.onerror = function(e) {
            icon.src   = '../recursos/icones/' + tipo + '-off.svg';
            icon_p.src = '../recursos/icones/' + tipo + '-off.svg';
        };
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
        if(subMenu && subMenuP) {
            subMenu.classList.remove('subMenuVisible');
            subMenuP.classList.remove('subMenuVisible');   
        }
    }   
});

//Retorno do root
function getRoot() {
    var root = "http://"+document.location.hostname+"/prog-web/";
    return root;
}

var myEle = document.getElementById("nascimento");
if(myEle){
    VMasker(document.querySelector("#nascimento")).maskPattern("99/99/9999");
}

var myEle2 = document.getElementById("celular");
if(myEle2){
    VMasker(document.querySelector("#celular")).maskPattern("(99) 99999-9999");
}

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
                alert("Cadastro realizado com sucesso, confirme seu cadastro no e-mail!");
                window.location.href = getRoot()+'index';
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
                window.location.href = getRoot()+'index';
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

//Ajax do formulário de edição de perfil
$("#formEditar").on("submit", function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: getRoot()+'controller/controllerPerfil',
        type: 'POST',
        data: formData,
        success: function (data) {
            var response = JSON.parse(data);
            
            if (response.retorno == 'success') {
                alert("Perfil editado com sucesso!");
                window.location.reload();
            } else {
                var msg = "";

                $.each(response.erros, function(key, value) {
                    msg += value + '\n';
                });

                msg = msg.substr(0, (msg.length - 1));

                alert(msg);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#imgPerfil').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
}

$("#file-input").change(function() {
    readURL(this);
});