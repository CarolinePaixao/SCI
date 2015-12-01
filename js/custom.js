// preloader
$(window).load(function(){
    $('.preloader').fadeOut(1000); // set duration in brackets
});

$(function() {
    new WOW().init();
    $('.templatemo-nav').singlePageNav({
    	offset: 70
    });

    /* Hide mobile menu after clicking on a link
    -----------------------------------------------*/
    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });

    $('#calebe').click(function(){
        window.open( "admin/");
    })
});

$(document).ready(function(){

    $('#formContact').submit(function(){
        var form = $(this).serialize();
        $.ajax({
            url: './admin/ajax/controller.php',
            type: 'post',
            data: 'acao=contact&'+form,
            beforeSend: function(){
                $('#submit').attr('disabled', 'disabled');
                $('#img').fadeIn('fast');
            },
            success: function(retorno){
                console.log(retorno);
                $('#submit').removeAttr('disabled');
                $('#img').fadeOut('fast');
                if(retorno === 'enviado'){
                    $('.contact-form').html('<strong>Sua mensagem foi enviada com sucesso</strong>');
                }else
                    $('.message').html('<strong>Infelizmente sua mensagem não foi enviada.</strong>');
            }
        })

        return false;
    })

});