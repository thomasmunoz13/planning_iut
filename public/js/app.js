/**
 * Created by thomasmunoz on 10/03/15.
 */
$(document).ready(function(){
    function changeWeek(year, group, week){
        week = (week > 46) ? 46 : week;
        week = (week < 1) ? 1 : week;
        
        $('#planning').append('<h3 class="center-block text-center">Chargement ...</h3>');

        $.get('/planning/get/' + year + '/' + group + '/' + week, function(data){
            $('#planning').empty();
            $('#planning').append(
                $('<img>')
                    .attr('src', data.message)
                    .addClass('img-responsive')
            );

            week = parseInt(week);
            $('#prev').attr('href', '/view/p/' + year + '/' + group + '/' + (week - 1));
            $('#next').attr('href', '/view/p/' + year + '/' + group + '/' + (week + 1));

            var groupName = (group != 0) ? ' groupe ' + group : '';
            $('.jumbotron h2')
                .empty()
                .text('Année ' + year + groupName);

            $(".jumbotron select").val(week);
            window.history.pushState('', '', '/view/p/' + year + '/' + group + '/' + week);
        });
    };
    function OnClick(link){
        link = link.split('/').slice(3, link.length);
        changeWeek(link[0], link[1], link[2]);
    };

    $('.btn-group a').on('click', function(e){
        e.preventDefault();
        OnClick($(this).attr('href'));
    });
    $('select').on('change', function(){
        var link = window.location.pathname;
        link = link.split('/').slice(3, link.length);
        changeWeek(link[0], link[1], $(this).val());
    });
    $(document).keydown(function(e) {
        var link = window.location.pathname;
        link = link.split('/').slice(3, link.length);

        switch(e.which) {
            case 37: // left
                changeWeek(link[0], link[1], (parseInt(link[2]) - 1));
                break;
            case 39: // right
                changeWeek(link[0], link[1], (parseInt(link[2]) + 1));
                break;
            default: return;
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    });
    $('.dropdown li a').on('click', function(e){
        e.preventDefault();
        OnClick($(this).attr('href'));
    });

    $(document).on("swipeleft", function(){
        var link = window.location.pathname;
        link = link.split('/').slice(3, link.length);
        changeWeek(link[0], link[1], (parseInt(link[2]) - 1));
    });
    $(document).on("swiperight", function(){
        var link = window.location.pathname;
        link = link.split('/').slice(3, link.length);
        changeWeek(link[0], link[1], (parseInt(link[2]) + 1));
    });
});