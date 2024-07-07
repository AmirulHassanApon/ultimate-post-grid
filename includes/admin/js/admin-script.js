jQuery(document).ready(function($) {
    $('.upg-tab').on('click', function() {
        var tab = $(this).data('tab');
        $('.upg-tab').removeClass('active');
        $(this).addClass('active');
        $('.upg-tab-content').removeClass('active');
        $('#' + tab).addClass('active');
    });
});