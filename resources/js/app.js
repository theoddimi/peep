require('./bootstrap');

//ddButton = getElementById('userDdMenu');

$(document).ready(function(){

  $('#userDdMenu').on('click',function(){
    $(this).siblings('.dropdown-menu').toggle();
  });

  $(document).click(function(event) {
    if (!$(event.target).is("#userDdMenu, .dropdown-item ")) {
       $(".dropdown-menu").hide();

    }
});
});
