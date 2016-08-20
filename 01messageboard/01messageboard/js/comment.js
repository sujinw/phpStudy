$(function() {
	/* 留言内容可输入字符 */
	$('.content').keyup(function() {
		if ( $(this).val() ) {
			var length = 200 - $(this).val().length;
			if ( length < 0 ) {
				$('.content_desc').text( '不能超过200个字' );
			} else {
				$('.content_desc').text( '还能输入' + length + '个字' );
			}
		} else {
			$('.content_desc').text( '还能输入200个字' );
		}
	});

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
	                if ( o.obj.is('textarea') ) {
	                	infoObj.css({
	                		left : left,
	                		top  : top
	                	}).show().animate({
	                		top  : top - 35
	                	},200);
	                } else {
	                	infoObj.css({
	                		left : left,
	                		top  : top - o.obj.height()
	                	}).show().animate({
	                		top  : top - o.obj.height() - 5
	                	},200);
	                }
	                
	            }
	        }
	    },
	    beforeSubmit : function() {
	    	$('input[type="submit"]').attr('disabled', 'disabled');
	    }
	});
});