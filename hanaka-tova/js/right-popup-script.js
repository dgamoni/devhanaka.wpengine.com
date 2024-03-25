jQuery(document).ready(function($){
    $(".fx-close-popup").click(function(){
    	$(this).parent().remove();
    });

    $(".fx-negative").click(function(){
    	$(this).parent().parent().remove();
    	$.ajax({
	       type: "POST",
	        url: "/wp-admin/admin-ajax.php",
	        data: "action=add_expire_cookie_2&day=31"
	        // success: function (data) {
	        //   if (data) {
	        //     alert(1);
	        //   } else {
	        //     alert(2);
	        //   }
	        // }
	      });
    });

  var $win = $(window);
  var fixed = $(".fx-popup-container");
  var limit = 1000;

  function tgl (state) {
      fixed.toggleClass("hidden", state);
  }

setTimeout(function() {
   $win.on("scroll", function () {
       var top = $win.scrollTop();
       
       if (top < limit) {
          //fixed.animate({right: '-600px'});
           tgl(true);
       } else {
          //fixed.animate({right: '0'});
          tgl(false);
       }
   });
 }, 6000);

	$(".fx-popup-btn").click(function() {
    var email = $(".fx-popup-email").val();
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

    if (pattern.test($('.fx-popup-email').val()) && email != "") {
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: "action=add_email&email=" + email,
        success: function (data) {
          if (data) {
            //alert("תודה");
            $(".fx-popup-email").val("");
            $(".fx-popup-email").css({'border' : 'none'});
            $(".fx-success-message").slideDown(1000);
            $('.fx-success-message').delay(2000).slideUp(1000);
          } else {
            $(".fx-already-signed").slideDown(1000);
            $('.fx-already-signed').delay(2000).slideUp(1000);
            $(".fx-popup-email").val("");
          }
        }
      });

    } else {
      $(".fx-popup-email").css({'border' : '1px solid #ff0000'});
      $(".fx-error-message").slideDown(1000);
      $('.fx-error-message').delay(2000).slideUp(1000);
    }
    });

});