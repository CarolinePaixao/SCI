$(document).ready(function(){

    $('.modalReligion').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=religion&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Religião');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

    $('.modalAdmin').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=admin&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Administrador');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

    $('.modalCalebe').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=calebe&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Calebe');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

    $('.modalTeam').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=team&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Equipe');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

    $('.modalChurch').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=church&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Igreja');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

    $('.modalMission').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=mission&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Missão');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

    $('.modalResident').click(function(){
        var cod = $(this).attr('data-id');
        $.ajax({
            url:'./ajax/controllerDet.php',
            type:'post',
            data:'acao=resident&cod='+cod,
            success:function(retorno){
                $('.modal-title').html('Detalhes Morador');
                $('.modal-body').html(retorno);
                $('#myModal').modal();
            }
        });
        return false;
    });

});