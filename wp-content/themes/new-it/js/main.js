// Video Duration Style
//	function videoDurationStyle(duration) {
//		var durationArr= duration.split('.');
//		duration = durationArr[0];
//		durationArr= duration.split(':');
//		duration = '';
//		if (parseInt(durationArr[durationArr.length-3])>0) duration += parseInt(durationArr[0])+'h ';
//		if (parseInt(durationArr[durationArr.length-2])>0) duration += parseInt(durationArr[1])+'m ';
//		if (parseInt(durationArr[durationArr.length-1])>0) duration += parseInt(durationArr[2])+'s ';
//		return duration;
//	}

jQuery(document).ready(function($) {



		$('.navbar-toggle').click(function(){

		$('.navbar-toggle').toggleClass("toogle-menu-items_off");

		if($('.navbar-toggle').hasClass('toogle-menu-items_off')){
			$('body').removeClass('show-callback');
			$('.phone-list .phones').addClass('single');

		}
	});
	
    //fancyfields
    $('.choice-select').fancyfields();
    $('.filter').fancyfields();
    $('.select-box').selectBox();

    $("#carousel").jcarousel({wrap: 'circular'});

    $("#accordion").accordion({collapsible: true});

    $("ul.tabs-training").tabs("div.panes-training > div");
    $("ul.tabs-convenient").tabs("div.panes-convenient > div");
    $("ul.tabs-certification").tabs("div.panes-certification > div");


	$("#report tr.even .td-block-in").hide();
	
	$("#report tr.odd").click(function(){
		$(this).toggleClass('active');
		$(this).next("tr").find('.td-block-in').slideToggle(300);
		return false;
	});
	
	$('.filter_form select').change(function() {
		$(this).closest('.filter_form').submit();
	});
	
	$('.video_gallery .video_duration').each(function(){
		$(this).html(videoDurationStyle($(this).html()));
	});

	
});