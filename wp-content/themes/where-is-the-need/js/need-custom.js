(function ($) {
  $(function() {
    $('.taxonomy-dropdown-box').change(function(){
      var current_option = $(this).val();
      if ( current_option != 0 ) {
        window.location.href = current_option;
      }
    });
  });
}(jQuery));
