(function( $ ) {

	$( document ).ready(function() {
		$("button.menu-toggle").click(function(){
	        $("ul.menu-links").toggleClass("open");
	        $("button.menu-toggle").toggleClass("open");
	    });
	});

})( jQuery );
