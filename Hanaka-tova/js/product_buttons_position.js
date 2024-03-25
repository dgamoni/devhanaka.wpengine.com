jQuery(document).ready(function($){

    var $prod_img = $('.woocommerce ul.products .product-item-image .front img');
    var $prod_butt = $('.woocommerce .product-item-box .product-buttons');
    $(window).on('load resize', function(){
       var height = $prod_img.height() - $prod_butt.height();
       $prod_butt.css('top', height);
    }).trigger('resize'); //on page load



	$("#footer-sidebar-2 li#text-2").click(function(){
	    $("div.textwidget").toggleClass("open");
	});

	$("#footer-sidebar-2 li#nav_menu-3").click(function(){
	    $("div.menu-footer-1-container").toggleClass("open");
	});

	$("#footer-sidebar-2 li#nav_menu-4").click(function(){
	    $("div.menu-footer-2-container").toggleClass("open");
	});

	

	$(window).on("load resize", function(e) {
	    var win = $(window).width();
		responsiveAction(win);
	});

	function responsiveAction(width) {

		if(width < 640) {
		    $( ".footer-sidebar-2-wrapper #nav_menu-2" ).insertAfter( ".footer-sidebar-2-wrapper #text-3 div.line" );
		    $("#nav_menu-3 .widgettitle a").removeAttr("href");
		    $( "#store-page-green" ).insertAfter( "#store-page-logo" );
		    $( "header .shopping-cart" ).insertAfter( ".header-menu-bg .header-menu #mega_main_menu" );
		}

		if(width > 640) {
		    $( ".footer-sidebar-2-wrapper #nav_menu-2" ).insertAfter( ".footer-sidebar-2-wrapper #text-2" );
		    $( "#store-page-green" ).insertAfter( "#store-page-images2" );	
		    $( ".header-menu .shopping-cart" ).insertBefore( "header .col-md-6 .search-bar" );	
		}
	}

	jQuery(function (){ 
		if(jQuery('.rtl .woocommerce-MyAccount-content p').is(':visible')) {
			jQuery('.rtl .woocommerce-MyAccount-content p').each(function() {
				var word = jQuery(this).html();
				jQuery(this).html(word.replace('Hello', ' שלום ').replace('not', ' לא '));
			});
			jQuery('.rtl .woocommerce-MyAccount-content p a').each(function() {
				var word = jQuery(this).html();
				jQuery(this).html(word.replace('Sign out', ' התנתק '));
			});
		}
	});
});
