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