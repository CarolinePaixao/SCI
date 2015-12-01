/**
 * Created by Caroline on 14/10/2015.
 */

$(document).ready(function() {

    /**
     * ALTERAÇÃO DO PERFIL, PAGINA EDITPERFIL.PHP
     *
     *
     *
     */

    var r = $('#type').val();
    if(r == "calebe")
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'POST',
            data: 'acao=altPerfil&cod='+$('#type').attr('data-id'),
            success: function(retorno){
                $('.calebe').html(retorno);
            }
        });
    else
        $('.calebe').html();


    $("#formPerfilPessoal").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterPerfilPessoal&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'email'){
                    showMessage('.message', 'Por favor, insira um endereço de email válido.', 'danger')
                }else if(retorno === 'emailexist'){
                    showMessage('.message', 'Este endereço de email já está cadastrado em nosso sistema, por favor insira um novo email.', 'danger')
                }else if(retorno === 'exist'){
                    showMessage('.message', 'Esta pessoa já está cadastrada em nosso sistema', 'warning')
                }else if(retorno === 'phone'){
                    showMessage('.message', 'Por favor, insira um número de telefone válido.', 'danger')
                }else if(retorno === 'success'){
                    alert("Dados Pessoais atualizados!");
                    location.reload();
                }else
                    showMessage('.message', 'Ocorreu um erro inesperado, por favor atualize a página e tente novamente.', 'danger')
            }
        });
        return false;
    });

    $("#formPerfilEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterPerfilEnd&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'success'){
                    alert("Endereço atualizado!");
                    location.reload();
                }else
                    showMessage('.message', 'Ocorreu um erro inesperado, por favor atualize a página e tente novamente.', 'danger')
            }
        });
        return false;
    });

    $("#formPerfilLog").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterPerfilLog&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'success'){
                    alert("Senha atualizada!");
                    location.reload();
                }else
                    showMessage('.message', 'Ocorreu um erro inesperado, por favor atualize a página e tente novamente.', 'danger')
            }
        });
        return false;
    });

    /**
     *
     * FIM EDIÇÃO DE PERFIL
     *
     */


    /** INICIO PÁGINA FORMALTRELIGIAO.PHP
     *
     *
     *
     */

    $("#formAltReligiao").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'POST',
            data: 'acao=alterReligion&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'success'){
                    $("#2").removeClass("disabled").addClass("active");
                    $(".step1").hide();
                    $(".step2").show();
                }else{
                    showMessage('.message', 'Infelizmente ocorreu um erro inesperado. Atualize a página e tente novamente.', 'danger')
                }
            }
        });
        return false;
    });

    /**
     *
     *
     *
     * FIM PÁGINA FORMRELIGIAO.PHP
     */

    /** INICIO PÁGINA FORMIGREJA.PHP
     *
     *
     *
     */

    $("#formAltIgreja").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterIgreja1&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                $("#2").removeClass("disabled").addClass("active");
                $(".step1").hide();
                $(".step2").show();
            }
        });
        return false;
    });

    $("#formAltIgrejaEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterIgreja2&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                if(retorno === 'exist'){
                    showMessage('.message', 'Já existe uma igreja cadastrada neste endereço em nosso sistema. <a href="consulta.php?p=igreja">Voltar à consulta.</a>', 'danger');
                }else if(retorno === 'success'){
                    $("#3").removeClass("disabled").addClass("active");
                    $(".step2").hide();
                    $(".step3").show();
                }else{
                    showMessage('.message', 'Infelizmente ocorreu um erro inesperado. Atualize a página e tente novamente.', 'danger')
                }

            }
        });
        return false;
    });

    /**
     *
     *
     *
     * FIM PÁGINA FORMIGREJA.PHP
     */


    /** INICIO PÁGINA FORMEQUIPE.PHP
     *
     *
     *
     */

    $("#formAltEquipe").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterEquipe&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                if(retorno === 'success'){
                    $("#2").removeClass("disabled").addClass("active");
                    $(".step1").hide();
                    $(".step2").show();
                }else{
                    showMessage('.message', 'Infelizmente ocorreu um erro inesperado. Atualize a página e tente novamente.', 'danger')
                }
            }
        });
        return false;
    });

    /**
     *
     *
     *
     * FIM PÁGINA FORMEQUIPE.PHP
     */

    /** INICIO PÁGINA FORMMISSAO.PHP
     *
     *
     *
     */

    $("#formAltMissao").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url:'./ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterMissao1&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                if(retorno === 'date')
                    showMessage('.message', 'O inicio da missão não pode ser posterior a data final da missão. E a data final não pode ser anterior a data de inicio.', 'danger')
                else if (retorno === 'team')
                    showMessage('.message', 'Esta equipe já está reservada para outra missão neste mesmo periodo', 'danger');
                else if (retorno === 'success'){
                    var local;
                    $('input:radio[name=realizar]').each(function() {
                        //Verifica qual está selecionado
                        if ($(this).is(':checked'))
                            local = $(this).val();
                    });
                    $("#2").removeClass("disabled").addClass("active");
                    if(local == 'I'){
                        $(".step1").hide();
                        $(".step2Ig").show();
                    }else{
                        $(".step1").hide();
                        $(".step2End").show();
                    }
                }else
                    showMessage('.message', 'Ocorreu um erro inesperado, por favor atualize a página e tente novamente.', 'danger');
            }
        });
        return false;
    });

    $("#formAltMissaoEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterMissaoE&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                if(retorno === 'success') {
                    $("#3").removeClass("disabled").addClass("active");
                    $(".step2End").hide();
                    $(".step3").show();
                }else{
                    showMessage('.message', 'Infelizmente ocorreu um erro inesperado. Atualize a página e tente novamente.', 'danger')
                }
            }
        });
        return false;
    });
    $("#formAltMissaoIgreja").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterMissaoI&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                if(retorno === 'success'){
                    $("#3").removeClass("disabled").addClass("active");
                    $(".step2Ig").hide();
                    $(".step3").show();
                }else{
                    showMessage('.message', 'Infelizmente ocorreu um erro inesperado. Atualize a página e tente novamente.', 'danger')
                }

            }
        });
        return false;
    });

    /**
     *
     *
     *
     * FIM PÁGINA FORMMISSAO.PHP
     */




    /** INICIO PÁGINA FORMMORADOR.PHP
     *
     *
     *
     */

    $("#formAltMorador").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterMorador1&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'email'){
                    showMessage('.message', 'Por favor, insira um endereço de email válido.', 'danger')
                }else if(retorno === 'emailexist'){
                    showMessage('.message', 'Este endereço de email já está cadastrado em nosso sistema, por favor insira um novo email.', 'danger')
                }else if(retorno === 'exist'){
                    showMessage('.message', 'Esta pessoa já está cadastrada em nosso sistema', 'warning')
                }else if(retorno === 'phone'){
                    showMessage('.message', 'Por favor, insira um número de telefone válido.', 'danger')
                }else if(retorno === 'success') {
                    $("#2").removeClass("disabled").addClass("active");
                    $(".step1").hide();
                    $(".step2").show();
                }else
                    showMessage('.message', 'Ocorreu um erro inesperado, por favor atualize a página e tente novamente.', 'danger');

            }
        });
        return false;
    });

    $("#formAltMoradorEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterMorador2&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                $("#3").removeClass("disabled").addClass("active");
                $(".step2").hide();
                $(".step3").show();
            }
        });
        return false;
    });

    /**
     *
     *
     *
     * FIM PÁGINA FORMMORADOR.PHP
     */


    /** INICIO PÁGINA FORMCALEBE.PHP
     *
     *
     *
     */


    $("#formAltCalebe").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterCalebe1&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'email'){
                    showMessage('.message', 'Por favor, insira um endereço de email válido.', 'danger')
                }else if(retorno === 'emailexist'){
                    showMessage('.message', 'Este endereço de email já está cadastrado em nosso sistema, por favor insira um novo email.', 'danger')
                }else if(retorno === 'exist'){
                    showMessage('.message', 'Esta pessoa já está cadastrada em nosso sistema', 'warning')
                }else if(retorno === 'phone'){
                    showMessage('.message', 'Por favor, insira um número de telefone válido.', 'danger')
                }else if(retorno === 'year'){
                    showMessage('.message', 'O ano de tempo de fé não pode ser anterior a data de nascimento.', 'danger')
                }else if(retorno === 'success'){
                    $("#USER_NAME").val($("#EMAIL").val());
                    $("#2").removeClass("disabled").addClass("active");
                    $(".step1").hide();
                    $(".step2").show();
                }else
                    showMessage('.message', 'Ocorreu um erro inesperado, por favor atualize a página e tente novamente.', 'danger')
            }
        });
        return false;
    });

    $("#formAltCalebeEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerAlt.php',
            type: 'post',
            data: 'acao=alterCalebe2&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                $("#3").removeClass("disabled").addClass("active");
                $(".step2").hide();
                $(".step3").show();
            }
        });
        return false;
    });

    $("#formAltCalebeLogin").submit(function () {
        var form = $(this).serialize();
        if($("#USER_PASS").val() !== $("#pass2").val()){
            showMessage('.message', 'As senhas não conferem', 'danger');
        }else {
            $.ajax({
                url: './ajax/controllerAlt.php',
                type: 'post',
                data: 'acao=alterCalebe3&' + form,
                beforeSend: function () {
                    $('.message').empty();
                },
                success: function (retorno) {
                    console.log(retorno);
                    if(retorno === 'success'){
                        $("#4").removeClass("disabled").addClass("active");
                        $(".step3").hide();
                        $(".step4").show();
                    }else{
                        showMessage('.message', 'Infelizmente ocorreu um erro inesperado. Atualize a página e tente novamente.', 'danger')
                    }
                }
            });
        }
        return false;
    });

    /**
     *
     *
     *
     * FIM PÁGINA FORMCALEBE.HTML
     */



    /**
     * Função para mensagens de Alerta
     * @param msg
     *      Mensagem que será exibida
     * @param type
     *      Qual o tipo da mensagem. Opções: sucess, danger, warning, info, primary, default
     */
    function showMessage(name, msg, type) {
        var div = $(name);

        div.empty().fadeOut("fast", function () {
            return div.html("<div  style='text-align: center' class='alert alert-" + type + "'>" + msg + "</div>").fadeIn("slow");
        });

        setTimeout(function () {
            div.empty().fadeOut("slow");
        }, 9000);
    }

});