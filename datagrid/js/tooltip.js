/***
 *  ApPHP DataGrid Pro (AJAX enabled)                                          
 *  Developed by:  ApPHP <info@apphp.com>
 *  License:       GNU LGPL v.3                                                
 *  Site:          https://www.apphp.com/php-datagrid/                          
 *  Copyright:     ApPHP DataGrid (c) 2006-2017. All rights reserved.
 *  last modified: 28.11.2016
 ***/

$(document).ready(function() {
	// Tooltip only Text
	$('.masterTooltip').hover(function(){
		// Hover over code
		var title = $(this).attr('title');
		$(this).data('tipText', title).removeAttr('title');
		$('<p class="tooltip"></p>')
		.text(title)
		.appendTo('body')
		.fadeIn('slow');
	}, function() {
		// Hover out code
		$(this).attr('title', $(this).data('tipText'));
		$('.tooltip').remove();
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coordinates
		var mousey = e.pageY + 10; //Get Y coordinates
		$('.tooltip')
		.css({ top: mousey, left: mousex })
	});
});
