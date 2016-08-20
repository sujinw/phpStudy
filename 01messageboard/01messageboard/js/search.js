$(function() {
	/* 表单验证 */
	$('.chkform').Validform({
		tiptype   : function( msg, o, cssctl ) {
			if ( !o.obj.is('form') ) {
				var objtip  = o.obj.parent().next().find('.Validform_checktip');
				cssctl( objtip, o.type );
				objtip.text( msg );
				var infoObj = o.obj.parent().next().find('.info');
				if ( o.type == 2 ) {
					infoObj.fadeOut();
				} else {
					if( infoObj.is(':visible') ) {
						return;
					}
	                var left = o.obj.position().left, // offset()
	                top      = o.obj.position().top;
	                infoObj.css({
	                	left : left,
	                	top  : top - o.obj.height()
	                }).show().animate({
	                	top  : top - o.obj.height() - 5
	                },200);
	            }
	        }
	    },
	    beforeSubmit : function() {
	    	// return false;
	    }
	});
});