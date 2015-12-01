$(window).ready(function () {
    // Show the initial default chart
    $('#detal').click(function(){
        var detal = $(this).attr('data-estatistic');
        if(detal === undefined)
            return false;
        else {
            var detalEst = $(this).attr('data-detal');
            $.ajax({
                url: './ajax/controllerInd.php',
                type: 'POST',
                data: 'acao=' + detal + '&type=' + detalEst,
                success: function (data) {
                    console.log(data);
                    $('.modal-title').html('Detalhes');
                    $('.modal-body').html(data);
                    $('#myModal').modal();
                },
                error: function (erro) {
                    console.log(erro);
                }
            })
        }
    });

    $("#personSystem").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=personSystem',
            dataType: 'json',
            beforeSend:function(){
                $('.person').hide(); $('.iasd').hide(); $('.religions').hide();

                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#personSystem").addClass('btn-inverse').removeClass('btn-primary');
                $("#placeholder").html('<img align="center" src="./assets/img/loader.gif" title="Carregando..." alt="Carregando..."/>');

                $('#detal').attr('data-estatistic', 'detalPersons');
            },
            success: function(data){
                console.log(data);
                grafic(data, 'personSystem');
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#religions").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=religions&type=person',
            dataType: 'json',
            beforeSend: function(){
                $('.person').hide(); $('.iasd').hide(); $('.religions').show();

                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#religions").addClass('btn-inverse').removeClass('btn-primary');
                $("#religionsAll").addClass('btn-inverse').removeClass('btn-primary');
                $("#placeholder").html('<img align="center" src="./assets/img/loader.gif" title="Carregando..." alt="Carregando..."/>');
                $('#detal').attr('data-estatistic', 'detalReligions').attr('data-detal', 'person');

            },
            success: function(data){
                grafic(data, 'religions');
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#religionsAll").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=religions&type=person',
            dataType: 'json',
            beforeSend: function(){
                $('#religionsMor').addClass('btn-primary').removeClass('btn-inverse');
                $('#religionsCal').addClass('btn-primary').removeClass('btn-inverse');
                $("#religionsAll").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalReligions').attr('data-detal', 'person');
                $('#placeholder').empty();
            },
            success: function(data){
                grafic(data, 'religionsAll');
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#religionsCal").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=religions&type=calebe',
            dataType: 'json',
            beforeSend: function(){
                $('#religionsAll').addClass('btn-primary').removeClass('btn-inverse');
                $('#religionsMor').addClass('btn-primary').removeClass('btn-inverse');
                $("#religionsCal").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalReligions').attr('data-detal', 'calebe');
                $('#placeholder').empty();
            },
            success: function(data){
                console.log(data);
                grafic(data, 'religionsCal');
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#religionsMor").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=religions&type=resident',
            dataType: 'json',
            beforeSend: function(){
                $('#religionsAll').addClass('btn-primary').removeClass('btn-inverse');
                $('#religionsCal').addClass('btn-primary').removeClass('btn-inverse');
                $("#religionsMor").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalReligions').attr('data-detal', 'resident');
                $('#placeholder').empty();
            },
            success: function(data){
                console.log(data);
                grafic(data, 'religionsMor');
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#projectsKnow").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=projectsKnow',
            dataType: 'json',
            beforeSend: function(){
                $('.person').hide(); $('.iasd').hide(); $('.religions').hide();

                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#projectsKnow").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalProjectsKnow');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                grafic(data, 'projectsKnow');
                //Morris.Bar({
                  //  element: 'placeholder',
                  //  data: data,
                  //  xkey: 'y',
                  //  ykeys: 'a',
                  //  labels: 'Pessoas',
                  //  hideHover: 'auto',
                  //  resize: true

                //});
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $('#myModal').on('submit', '#searchProjects', function(){
        var form = $(this).serialize();
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=detalProjectsEspecific&'+form,
            dataType: 'json',
            beforeSend: function(){
                $("#projects").empty();
                $("#number").empty();
            },
            success: function(retorno){
                $("#projects").html(retorno.title);
                $("#number").html(retorno.number);
            }
        });
        return false;
    });

    $("#projectsOpnion").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=projectsOpnion',
            dataType: 'json',
            beforeSend: function(){
                $('.person').hide(); $('.iasd').hide(); $('.religions').hide();

                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#projectsOpnion").addClass('btn-inverse').removeClass('btn-primary');
                $("#placeholder").html('<img align="center" src="./assets/img/loader.gif" title="Carregando..." alt="Carregando..."/>');
                $('#detal').attr('data-estatistic', 'detalProjectsOpnion');

            },
            success: function(data){
                console.log(data);
                grafic(data, 'projectsOpnion');
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionIASD").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionIASD&type=all',
            dataType: 'json',
            beforeSend: function(){
                $('.person').hide(); $('.iasd').show(); $('.religions').hide();
                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionIASD").addClass('btn-inverse').removeClass('btn-primary');
                $("#opnionIASDAll").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionIASD').attr('data-detal', 'all');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoas',
                    hideHover: 'auto',
                    resize: true

                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionIASDAll").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionIASD&type=all',
            dataType: 'json',
            beforeSend: function(){
                $('#opnionIASDBad').addClass('btn-primary').removeClass('btn-inverse');
                $('#opnionIASDGood').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionIASDAll").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionIASD').attr('data-detal', 'all');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoas',
                    hideHover: 'auto',
                    resize: true

                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionIASDGood").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionIASD&type=good',
            dataType: 'json',
            beforeSend: function(){
                $("#opnionIASDAll").addClass('btn-primary').removeClass('btn-inverse');
                $('#opnionIASDBad').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionIASDGood").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionIASD').attr('data-detal', 'good');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoas',
                    hideHover: 'auto',
                    resize: true

                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionIASDBad").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionIASD&type=bad',
            dataType: 'json',
            beforeSend: function(){
                $("#opnionIASDAll").addClass('btn-primary').removeClass('btn-inverse');
                $('#opnionIASDGood').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionIASDBad").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionIASD').attr('data-detal', 'bad');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoas',
                    hideHover: 'auto',
                    resize: true

                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionPerson").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionPerson&type=all',
            dataType: 'json',
            beforeSend: function(){
                $('.person').show(); $('.iasd').hide(); $('.religions').hide();
                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionPerson").addClass('btn-inverse').removeClass('btn-primary');
                $("#opnionPersonAll").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionPerson').attr('data-detal', 'all');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoas',
                    hideHover: 'auto',
                    resize: true
                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });


    $("#opnionPersonAll").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionPerson&type=all',
            dataType: 'json',
            beforeSend: function(){
                $('.person').show(); $('.iasd').hide(); $('.religions').hide();
                $('.btn-inverse').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionPersonAll").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionPerson').attr('data-detal', 'all');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoas',
                    hideHover: 'auto',
                    resize: true
                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionPersonGood").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionPerson&type=good',
            dataType: 'json',
            beforeSend: function(){
                $("#opnionPersonAll").addClass('btn-primary').removeClass('btn-inverse');
                $('#opnionPersonBad').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionPersonGood").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionPerson').attr('data-detal', 'good');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoa',
                    hideHover: 'auto',
                    resize: true
                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });

    $("#opnionPersonBad").click(function () {
        $.ajax({
            url: './ajax/controllerInd.php',
            type: 'POST',
            data: 'acao=opnionPerson&type=bad',
            dataType: 'json',
            beforeSend: function(){
                $("#opnionPersonAll").addClass('btn-primary').removeClass('btn-inverse');
                $('#opnionPersonGood').addClass('btn-primary').removeClass('btn-inverse');
                $("#opnionPersonBad").addClass('btn-inverse').removeClass('btn-primary');
                $('#detal').attr('data-estatistic', 'detalOpnionPerson').attr('data-detal', 'bad');
                $('#placeholder').empty();
            },
            success: function(data){
                //console.log(data);
                Morris.Bar({
                    element: 'placeholder',
                    data: data,
                    xkey: 'y',
                    ykeys: 'a',
                    labels: 'Pessoa',
                    hideHover: 'auto',
                    resize: true
                });
            },
            error:function(erro){
                console.log(erro);
            }
        })
    });



    // Add the Flot version string to the footer

});


function grafic(data, id) {

    var placeholder = $("#placeholder");

    $("#"+id).click(function () {

        placeholder.unbind();

        $("#title").text("Pessoas no Sistema");
        $("#description").text("Semi-transparent, black-colored label background.");

        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5,
                            color: "#000"
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });

        setCode([
            "$.plot('#placeholder', data, {",
            "    series: {",
            "        pie: { ",
            "            show: true,",
            "            radius: 1,",
            "            label: {",
            "                show: true,",
            "                radius: 3/4,",
            "                formatter: labelFormatter,",
            "                background: { ",
            "                    opacity: 0.5,",
            "                    color: '#000'",
            "                }",
            "            }",
            "        }",
            "    },",
            "    legend: {",
            "        show: false",
            "    }",
            "});"
        ]);
    });
}

// A custom label formatter used by several of the plots

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}

//

function setCode(lines) {
    $("#code").text(lines.join("\n"));
}
