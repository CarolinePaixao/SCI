/**
 * Created by Caroline on 11/08/2015.
 */
$(document).ready(function() {


    /** INICIO PÁGINA FORMADMIN.PHP
     *
     *
     *
     */

    $("#formAdmin").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveAdmin1&'+form,
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

    $("#formAdminEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveAdmin2&'+form,
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

    $("#formAdminLogin").submit(function () {
        var form = $(this).serialize();
        if($("#USER_PASS").val() !== $("#pass2").val()){
            showMessage('.message', 'As senhas não conferem', 'danger');
        }else {
            $.ajax({
                url: './ajax/controller.php',
                type: 'post',
                data: 'acao=saveAdmin3&' + form,
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
     * FIM PÁGINA FORMADMIN.HTML
     */


    /** INICIO PÁGINA FORMPESQUISA.PHP
     *
     *
     *
     */

    $('#knowIASD1').click(function(){
        $('.visita').show();
    });
    $('#knowIASD0').click(function(){
        $('.visita').hide();
        $('.voltaria').hide();
    });
    $('#visitIASD1').click(function(){
        $('.voltaria').show();
    });
    $('#visitIASD0').click(function(){
        $('.voltaria').hide();
    });
    $('#tv1').click(function(){
        $('.tv').show();
    });
    $('#tv0').click(function(){
        $('.tv').hide();
    });

    $("#formPesquisa").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveResearch1&'+form,
            dataType: 'json',
            beforeSend: function(){
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);

                if(retorno === ''){
                    $("#2").removeClass("disabled").addClass("active");
                    $("#3").removeClass("disabled").addClass("active");
                    $(".step1").hide();
                    $(".step3").html('<div class="alert alert-info">Já foi realizado a pesquisa com está pessoa. Obrigado.</div>').show();
                }
                else{
                    $("#2").removeClass("disabled").addClass("active");
                    $(".step1").hide();
                    $('.tempoFe').html(retorno.TIME_FE);
                    if(retorno.KNOW_IASD === "1"){
                        $('.knowIASD').html('SIM');
                        $('.visita').show();
                        if(retorno.IASD_VISIT === "1"){
                            $('.visitIASD').html('SIM');
                            $('.voltaria').show();
                            if(retorno.IASD_BACK === "1")
                                $('.backIASD').html('SIM');
                            else
                                $('.backIASD').html('NÃO');
                            $('.iasdLocal').html(retorno.IASD_LOCAL);
                        }else
                            $('.visitIASD').html('NÃO');

                    }else
                        $('.knowIASD').html('NÃO');

                    if(retorno.KNOW_SIGNIFICATION === "1")
                        $('.knowSignification').html('SIM');
                    else
                        $('.knowSignification').html('NÃO');

                    if(retorno.CONSIDER_ADVENTISTA === "1")
                        $('.considerAdventista').html('SIM');
                    else
                        $('.considerAdventista').html('NÃO');

                    var op = retorno.OPNION_ADVENTISTA.split(';');
                    $('.opnionPersonGood').html(op[0]);
                    $('.opnionPersonBad').html(op[1]);

                    op = retorno.OPNION_IASD.split(';');
                    $('.opnionChurchGood').html(op[0]);
                    $('.opnionChurchBad').html(op[1]);

                    $('.opnionFor').html(retorno.OPNION_REASON);

                    if(retorno.KNOW_DESBRAVADOR === "1")
                        $('.knowDesbravadores').html('SIM');
                    else
                        $('.knowDesbravadores').html('NÃO');

                    if(retorno.KNOW_AVENTUREIRO === "1")
                        $('.knowAventureiros').html('SIM');
                    else
                        $('.knowAventureiros').html('NÃO');

                    if(retorno.KNOW_ADRA === "1")
                        $('.knowAdra').html('SIM');
                    else
                        $('.knowAdra').html('NÃO');

                     op = retorno.OPNION_PROJECTS.split(';');
                    $('.opnionProject').html(op[0]);
                    $('.opnionProjectReason').html(op[1]);

                    if(retorno.KNOW_TVNOVOTEMPO == "1"){
                        $('.knowtv').html('SIM');
                        $('.tv').show();
                        $('.program').html(retorno.PROGRAM_TV);
                    }else
                        $('.knowtv').html('NÃO');

                    $(".step2").show();
                }

            }
        });
        return false;
    });

    $("#formConfirm").submit(function () {
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveResearch2',
            beforeSend: function(){
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'success'){
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
     * FIM PÁGINA FORMPESQUISA.PHP
     */


    /** INICIO PÁGINA FORMRELIGIAO.PHP
     *
     *
     *
     */

    $("#formReligiao").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'POST',
            data: 'acao=saveReligion&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function(retorno){
                console.log(retorno);
                if(retorno === 'exist'){
                    showMessage('.message', 'Está religião já está cadastrada. <a href="consulta.php?p=aux">Voltar à consulta.</a>', 'danger')
                }else if(retorno === 'success'){
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


    /** INICIO PÁGINA FORMEQUIPE.PHP
     *
     *
     *
     */

    $("#formEquipe").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveEquipe&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
                if(retorno === 'exist'){
                    showMessage('.message', 'Já existe uma Equipe com este nome.', 'danger')
                }else if(retorno === 'success'){
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

    $("#formMissao").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url:'./ajax/controller.php',
            type: 'post',
            data: 'acao=saveMissao1&'+form,
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

    $("#formMissaoEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveMissaoE&'+form,
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
    $("#formMissaoIgreja").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveMissaoI&'+form,
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


    /** INICIO PÁGINA FORMIGREJA.PHP
     *
     *
     *
     */

    $("#formIgreja").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveIgreja1&'+form,
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

    $("#formIgrejaEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveIgreja2&'+form,
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



    /** INICIO PÁGINA FORMMORADOR.PHP
     *
     *
     *
     */

    $("#formMorador").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveMorador1&'+form,
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

    $("#formMoradorEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveMorador2&'+form,
            beforeSend: function () {
                $('.message').empty();
            },
            success: function (retorno) {
                console.log(retorno);
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
    $("input[name='BAPTISM']").click(function(){
        getLeader();
    });
    $("select[id='ID_RELIGION_C']").change(function(){
        getLeader();
    });

    $("#formCalebe").submit(function () {
        var form = $(this).serialize();
        $.ajax({
           url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveCalebe1&'+form,
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

    $("#formCalebeEnd").submit(function () {
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controller.php',
            type: 'post',
            data: 'acao=saveCalebe2&'+form,
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

    $("#formCalebeLogin").submit(function () {
        var form = $(this).serialize();
        if($("#USER_PASS").val() !== $("#pass2").val()){
            showMessage('.message', 'As senhas não conferem', 'danger');
        }else {
            $.ajax({
                url: './ajax/controller.php',
                type: 'post',
                data: 'acao=saveCalebe3&' + form,
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


    $(".back").click(function(){
        var step = parseInt($(this).attr('data-back'));
        $('#'+(step+1)).removeClass('active').addClass('disabled');
        $(".step"+(step +1)).hide();
        $(".step"+(step +1)+'Ig').hide();
        $(".step"+(step +1)+'End').hide();
        $(".step"+step).show();
        return false;
    });



    /**
     *  Executa a requisição quando o campo ZIPCODE perder o foco
     *
     *
     */
    $('#ZIPCODE').blur(function () {
        /* Configura a requisição AJAX */
        $.ajax({
            url: './ajax/controller.php', /* URL que será chamada */
            type: 'POST', /* Tipo da requisição */
            data: 'acao=zipcode&zipcode=' + $('#ZIPCODE').val(), /* dado que será enviado via POST */
            dataType: 'json', /* Tipo de transmissão */
            timeout: 3000,
            beforeSend:function(){
                $('.message').html('<img class="col-md-offset-4" src="./assets/img/loader.gif"/> Buscando CEP...');
                $('#NAME_ADDRESS').attr('readonly', 'readonly');
                $('#DISTRICT').attr('readonly', 'readonly');
                $('#ID_CITY').attr('readonly', 'readonly');
                $('#STATE').attr('readonly', 'readonly');
            },
            success: function (data) {
                $('.message').empty();
                if (data.sucesso == 1) {
                    $('#NAME_ADDRESS').val(data.rua);
                    $('#DISTRICT').val(data.bairro);
                    $('#LATITUDE').val(data.latitude);
                    $('#LONGITUDE').val(data.longitude);
                    getCity(data.estado, data.cidade);
                    getState(data.estado);
                    $('#NUMBER').focus();
                }else{
                    $('#NAME_ADDRESS').removeAttr('readonly').focus();
                    $('#DISTRICT').removeAttr('readonly');
                    $('#ID_CITY').removeAttr('readonly');
                    $('#STATE').removeAttr('readonly');
                }
            },
            error: function () {
                $('.message').empty();
                $('#NAME_ADDRESS').removeAttr('readonly').focus();
                $('#DISTRICT').removeAttr('readonly');
                $('#ID_CITY').removeAttr('readonly');
                $('#STATE').removeAttr('readonly');
            }
        });
        return false;
    });
    /**
     *
     *
     *
     * Fim */



    $("#STATE").change(function(){
        var state = $('#STATE :selected').text();
        getCity(state);
    });
});

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


/**
 * FUNÇÃO PARA POPULAR COMBOBOX DE CIDADES DE ACORDO COM O ESTADO
 *
 */
function getCity(state, city) {
    $.ajax({
        url: './ajax/controller.php',
        type: 'post',
        data: {acao: 'city', nome: state, cidade: city},
        success: function (dados) {
            $("#ID_CITY").html(dados);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

/**
 *     FUNÇÃO PARA POPULAR COMBOBOX DE ESTADOS
 *
 */
function getState(state) {
    $.ajax({
        url: './ajax/controller.php',
        type: 'post',
        data: {acao: 'state', uf: state},
        success: function (dados) {
            $('#STATE').html(dados);
        }
    })
}


function getLeader(){
    var r = $("#ID_RELIGION_C :selected").text();
    var b = $("input[name='BAPTISM']:checked").val();

    if( r == "Adventista do Sétimo Dia"  &&   b == 1 )
        $(".lider").show();
    else
        $(".lider").hide();
}