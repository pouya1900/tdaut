jQuery(document).ready(function ($) {
    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    $('#video0').on('ended', function () {
        $("#image0").removeClass('display-none');
        $(".infographic_container").removeClass('display-none');
        $("#video0").hide();
    });
    $('#video1').on('ended', function () {
        $(".page_container").css('opacity', 1);
        $("#video1").hide('slow');
    });

    $('body').mousemove(function (event) {
        let x = event.pageX;
        let y = event.pageY;

        let x_move = 20 - x * 40 / $(window).width();
        let y_move = 10 - y * 20 / $(window).height();

        let style_text = 'translate3d(' + x_move + 'px, ' + y_move + 'px, 0)';

        $('.background_full').css('transform', style_text)


    });

    $('.infographic_section li').on('click', function (e) {
        $('.infographic_section li').not(this).css('opacity', 0);
    });

    $('#profile_side_menu').on('click', function () {
        var element = $('#profile_side');
        if (element.hasClass('profile_side_mobile')) {
            element.removeClass('profile_side_mobile');
        } else {
            element.addClass('profile_side_mobile');
        }

    });

    $('#accountAlertModal').modal('show');

    $('#hampa').on('click', function () {
        $('#hampaRedirectModal').modal('show');

        window.location.replace("http://autpayesh.ir/");
    });

});


