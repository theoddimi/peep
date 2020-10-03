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

// $("#peep-file_upload").on('change',function(){
//   $('#peep-image-preview').attr("src", window.URL.createObjectURL(this.files[0]));
//   $("#peep-image-preview-remove").show();
// });
//
// $("#peep-image-preview-remove").on('click', function(){
//   $('#peep-file_upload').val('');
//   $('#peep-image-preview').attr("src", "");
//   $("#peep-image-preview-remove").hide();
// });

$("#peep-file_upload").on('change',function(){
  $('.peep-card-body-image-bg').css("background-image", 'url('+window.URL.createObjectURL(this.files[0])+')');
  $('.peep-card-body-image').attr("src", window.URL.createObjectURL(this.files[0]));
  $('#peep-image-preview').attr("src", window.URL.createObjectURL(this.files[0]));
  $("#peep-image-preview-remove").show();

});
$("#peep-image-preview-remove").on('click', function(){
  initImage = $('#peep-file_upload').attr("data-attr");
  $('#peep-image-preview').attr("src", "");
  $("#peep-image-preview-remove").hide();
   $('.peep-card-body-image-bg').css("background-image", 'url('+initImage+')');
   $('.peep-card-body-image').attr("src", initImage);
   $('#peep-file_upload').val('');
});

});
