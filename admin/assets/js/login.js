$(function () {
    
    $('.list-inline li > a').click(function () {
        var activeForm = $(this).attr('href') + ' > form';
        //console.log(activeForm);
        $(activeForm).addClass('magictime swap');
        //set timer to 1 seconds, after that, unload the magic animation
        setTimeout(function () {
            $(activeForm).removeClass('magictime swap');
        }, 1000);
    });
});

/** INICIO PÁGINA LOGIN.HTML
 *
 *
 *
 */

/**
 *  Função para submiter e processar resultado do form de Login
 */
$('form[id="formLogin"]').submit(function () {
    var img = $('#img');
    var button = $(':button');
    var form = $(this);
    $.ajax({
        url: './ajax/controller.php',
        type: 'POST',
        data: 'acao=login&' + form.serialize(),
        beforeSend: function () {
            button.attr("disabled", true);
            img.fadeIn('slow');
        },
        success: function (retorno) {
            button.attr("disabled", false);
            img.fadeOut('slow');
            console.log(retorno);
            if (retorno === 'sucesso') {
                form.fadeOut("slow", function () {
                    show("Login efetuado com sucesso<br><img src='./assets/img/loader.gif'> ", 'success');
                });
                $(location).attr('href', 'index.php');
            } else if (retorno === 'loginerrado') {
                show("Nome de Usuário incorreto", 'danger');
            } else if (retorno === 'senhaerrada') {
                show("Senha incorreta", 'danger');
            } else if (retorno === 'vazio') {
                show("Por favor, preencha os campos", 'warning');
            } else {
                show("Ocorreu um erro inesperado. Por favor, recarregue a página e tente novamente.<br>" +
                    "Se o problema persistir, contate o administrator do sistema.", 'warning');
            }
        }
    });

    return false;
});

/**
 * Função para submiter e processar resultado do form de ForgotPass (login.html)
 */
$('form[id="formForgot"]').submit(function () {
    var img = $('#img');
    var button = $(':button');
    var form = $(this);
    $.ajax({
        url: './ajax/controller.php',
        type: 'POST',
        data: 'acao=forgot&' + form.serialize(),
        beforeSend: function () {
            button.attr("disabled", true);
            img.fadeIn('slow');
        },
        success: function (retorno) {
            button.attr("disabled", false);
            img.fadeOut('slow');
            console.log(retorno);
            if (retorno === 'enviado') {
                form.fadeOut("slow", function () {
                    show("Um email com sua senha foi enviado com sucesso. Atualiaze a página para tentar o login novamente.", 'success');
                });
            } else if (retorno === 'emailinvalido') {
                show("Por favor, preencha com um email válido", 'warning');
            } else if (retorno === 'naoencontrado') {
                show("Este email não está cadastrado", 'warning');
            } else if (retorno === 'falha') {
                show("Falha ao enviar o email. Por favor, recarregue a página e tente novamente.<br>" +
                    "Se o problema persistir, contate o administrator do sistema.", 'warning');
            } else {
                show("Ocorreu um erro inesperado. Por favor, recarregue a página e tente novamente.<br>" +
                    "Se o problema persistir, contate o administrator do sistema.", 'warning');
            }
        }
    });

    return false;
});
/**
 *
 *
 *
 * FIM PÁGINA LOGIN.HTML
 */

/**
 * Função para mensagens de Alerta
 * @param msg
 *      Mensagem que será exibida
 * @param type
 *      Qual o tipo da mensagem. Opções: sucess, danger, warning, info, primary, default
 */
function show(msg, type) {
    var div = $('#message');

    div.empty().fadeOut("fast", function () {
        return div.html("<div class='alert alert-" + type + "'>" + msg + "</div>").fadeIn("slow");
    });

    setTimeout(function () {
        div.empty().fadeOut("slow");
    }, 9000);
}