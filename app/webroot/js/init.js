(function($){
  $(function(){
    $('.sidenav').sidenav();
    $('.parallax').parallax();
    // Hide message on click
    $(document).on('click', '.message', function () {
        $(this).hide();
    });
    // add padding bottom if footer is fixed
    if ($('.fixed-footer').length) {
        var height = $('footer.fixed-footer').height() * 2;
        $('main').css('padding-bottom', height + 'px');
    }
  });
})(jQuery);
