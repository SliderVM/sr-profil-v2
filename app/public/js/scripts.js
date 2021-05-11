$(document).ready(function(){

    //tablesorter
    $("#warehouse").tablesorter({
        headers: {
            0: {sorter: false},
            1: {sorter: false},
            2: {sorter: false},
            8: {sorter: false}
        }
    });

    //tablesorter
    $("#warehouse_tubes").tablesorter({
        headers: {
            0: {sorter: false},
            1: {sorter: false},
            2: {sorter: false},
            9: {sorter: false}
        }
    });

    // datepicker
    pickmeup('.pmu', {
        hide_on_select: true
    });

    //фиксированная ширина штрипса
    var fullwidth = 1250;

    function obrez() {

        var width = 0;
        var count = 0;
        var waste = 0;
        var sum = 0;

        $(".apr-fieldset").each(function() {
            width = Number($(this).find(".apr-width").val());
            count = Number($(this).find(".apr-count").val());
            sum += width * count;
        });

        waste = fullwidth - sum;
        $("#apr-waste").text(waste);

        if (waste < 0) {
            $(".btn-apr-save").prop("disabled", true);
            $("#apr-waste").addClass("text-danger");
        }
        else {
            $(".btn-apr-save").prop("disabled", false);
            $("#apr-waste").removeClass("text-danger");
        }

    };

    $(".apr-fieldset").on('keyup mouseup', '.apr-width, .apr-count', obrez);

    // добавление типа резки
    $(".btn-apr-add").on('click', function() {
        $(this).closest(".modal").find(".apr-fieldset:first").clone(true)
            .find("legend").append('<button class="close float-right">×</button>')
            .end().find(":input").val("")
            .end().insertBefore(".btn-apr-add");
    });

    // удаление типа резки
    $(".apr-fieldset").on('click', 'legend .close', function() {
        $(this).closest(".apr-fieldset").remove();
        obrez();
    });

    //03.11.17
    //Возможное производство штрипса
    $('#addShtripsVariant .savevalues').on('click', function() {
        var var1 = $('input[name=ShtripsVariantVar1]').val();
        var var2 = $('input[name=ShtripsVariantVar2]').val();
        $('table#shtripsVariant tbody').append('<tr><td>'+var1+'</td><td>'+var2+'</td><td><button type="button" class="close"><span>&times;</span></button></td></tr>');
        $('#addShtripsVariant').modal('hide');
    });

    $('#shtripsVariant').on('click', 'tr .close', function() {
        $(this).closest('tr').remove();
    });

    //Возможное производство трубы
    $('#addTubeVariant .savevalues').on('click', function() {
        var var1 = $('select[name=TubeVariantVar1]').val();
        var var2 = $('input[name=TubeVariantVar2]').val();
        var var3 = $('input[name=TubeVariantVar3]').val();
        var var4 = $('input[name=TubeVariantVar4]').val();
        var var5 = $('input[name=TubeVariantVar5]').val();
        $('table#tubeVariant tbody').append('<tr><td>'+var1+'</td><td>'+var2+'</td><td>'+var3+'</td><td>'+var4+'</td><td>'+var5+'</td><td><a href="#" class="btn btn-outline-primary btn-sm">Произвести</a></td></tr>');
        $('#addTubeVariant').modal('hide');
    });

});