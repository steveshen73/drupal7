
$(document).ready(function(){

    //alert('in homepage.js document.ready') ; 

    /*  Set the handlers for mouseover links in the Workflow imagemap  */

    $("#workflow li a").hover(
	function() { 
	    var old_src = $('.diagram').attr('src') ;
	    var new_src = 'graphics/workflow-diagram-' + $(this).attr('name') + '.png' ; 
	    $('.diagram').attr("src", new_src) ;
	    //alert('changed src of ' + $('.diagram') + ' from ' + old_src + ' to ' + new_src) ; 
        },
	function() { 
	    var old_src = 'graphics/workflow-diagram.png' ; 
	    $('.diagram').attr("src", old_src) ;  
	    //alert('changed src of ' + $('.diagram') + ' to ' + old_src) ; 
      }
    );

    //alert('preloading images') ; 

    preload_images('pictures/notebooks.jpg', 
		   'pictures/scratching-head.jpg', 
		   'pictures/paper.jpg', 
		   'pictures/examining.jpg', 
		   'pictures/car-interior.jpg') ;
    animate_panel('1', '2000', '10000') ; 

});
