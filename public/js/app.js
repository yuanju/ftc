(function ($) {
    'use strict';

    $(function () {
        var $fullText = $('.admin-fullText');
        $('#admin-fullscreen').on('click', function () {
            $.AMUI.fullscreen.toggle();
        });

        $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function () {
            $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
        });

        $('#family_switch .am-dropdown-content li').click(function () {
            var index = $(this).index();
            //todo 记录默认家族，根据index设置session
            $(this).find('.am-icon-check').css('opacity', 1);
            $(this).siblings().find('.am-icon-check').css('opacity', 0);
            $('#family_current').text($(this).text());
            $('#family_switch').dropdown('close')
        });
      
        $.mCustomScrollbar.defaults.theme = "light-1"; 
        $("#admin-offcanvas").mCustomScrollbar();
    });
})(jQuery);
