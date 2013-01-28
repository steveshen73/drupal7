$(document).ready(function(){

	var FREQ = 10000 ;
	var repeat = true;
	
	function showFrequency(){
		$("#freq").html( "Page refreshes every " + FREQ/1000 + " second(s).");
	}
	
	function startAJAXcalls(){
	
		if(repeat){
			setTimeout( function() {
					getXMLNews();
					startAJAXcalls();
				}, 	
				FREQ
			);
		}
	}


//Using jquery with proxy file to fetch the data from a cross-domain
	function getXMLNews(){
		$.ajax({
			url: "http://localhost/jquery_rss/proxy.php?url=http://blog.bill.com/bills_20/rss.xml",
			cache: false,
			dataType: "xml",
			success:  function(xml){
				
				$('#blog').empty();
				$(xml).find("item").each(function() {
                               
                                //need to find date format to work on the pubDate
                                var info = $(this).find("pubDate").text() + ' '  + '<a href ="' + $(this).find("link").text() + '">' + $(this).find("title").text() + '</a><br/>';
			       $('#blog').append( info );
				});
				
				getTimeAjax();
			} 
		});
	}


	function getTimeAjax(){
	$('#updatedTime').load("time.php");
		/*
		var time = "";
		$.ajax({
			url: "time.php",
			cache: false,
			success: function(data){
				$('#updatedTime').html(data);
			}
		});
		*/
	}
	
	$("#btnStop").click(function(){
		repeat = false;
		$("#freq").html( "Updates paused." );
	});

	$("#btnStart").click(function(){
		repeat = true;
		startAJAXcalls();
		showFrequency();
	});	

	showFrequency();
	getXMLNews();
	startAJAXcalls();
});
