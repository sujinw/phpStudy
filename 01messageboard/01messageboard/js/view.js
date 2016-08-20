$(function() {
	/* 删除留言 */
	$('.comment_del').click(function() {
		var _this = $(this);
		layer.confirm('确定要删除该留言吗？', {
			icon     : 3,
			title    : [ '提示' ],
			closeBtn : 2,
			move     : false
		}, function(luxury) {
			$.post('commentdel.php', {id : _this.attr('data-id')}, function( data ) {
				layer.msg(data.msg, {time : 1000}, function() {
					if ( data.state == 1 ) {
						layer.close(luxury);
						if ( $('.comment_row').length == 1 ) {
							window.location.reload(true);
						} else {
							_this.parents('.comment_row').remove();
						}
					}
				});
			}, 'json');
		});
	});

	/* 删除回复、追加 */
	$('.reply_del').click(function() {
		var _this = $(this);
		var _pObj = $(this).parents('.comment_row');
		layer.confirm('确定要删除该回复吗？', {
			icon     : 3,
			title    : [ '提示' ],
			closeBtn : 2,
			move     : false
		}, function(luxury) {
			$.post('replydel.php', {id : _this.attr('data-id')}, function( data ) {
				layer.msg(data.msg, {time : 1000}, function() {
					if ( data.state == 1 ) {
						layer.close(luxury);
						_this.parents('.reply_row').remove();
					}
				});
			}, 'json');
		});
	});

	/* 回复、追加 */
	$('.reply_btn').click(function() {
		var _this = $(this);

		if ( _this.text() == '回复' ) {
			var _title = '回复：' + _this.attr('data-name');
		} else if ( _this.text() == '追加' ) {
			var _title = _this.text();
		} else {
			layer.msg('请不要乱搞哦', {time : 1000});
			return false;
		}

		layer.open({
			type 	 : 1,
			closeBtn : 2,
			title 	 : [ _title, 'height:50px;line-height:50px;background:#fff;color:#333;font-size:16px;' ],
			area 	 : [ '400px' ],
			content  : $('.reply_window'),
			move 	 : false,
			btn 	 : ['确定', '取消'],
			yes 	 : function(luxury) {
				var reg  = /^[\w\W]{2,20}$/;
				var reg2 = /^[\w\W]{1,200}$/;
				if ( !$('.reply_input').val() ) {
					layer.msg('请输入姓名', {time : 1000} ,function() {
						$('.reply_input').focus();
					});
				} else if ( !reg.test( $('.reply_input').val() ) ) {
					layer.msg('姓名应为2-20个字符', {time : 1000} ,function() {
						$('.reply_input').focus();
					});
				} else if ( !$('.reply_textarea').val() ) {
					layer.msg('请输入' + _this.text() + '内容', {time : 1000}, function() {
						$('.reply_textarea').focus();
					});
				} else if ( !reg2.test( $('.reply_textarea').val() ) ) {
					layer.msg(_this.text() + '内容不能超过200个字符', {time : 1000}, function() {
						$('.reply_textarea').focus();
					});
				} else {
					$.post('reply.php', {name : $('.reply_input').val(), content : $('.reply_textarea').val(), pid : _this.attr('data-id'), title : _this.text(), who : _this.attr('data-name')}, function( data ) {
						layer.msg(data.msg, {time : 1000}, function() {
							if ( data.state == 1 ) {
								layer.close(luxury);
								window.location.reload(true);
							}
						});
					}, 'json');
				}
			},
			no 		 : function() {
				return false;
			},
			success	 : function() {
				$('.reply_textarea').attr('placeholder', '请输入' + _this.text() + '内容...');
			}
		});
	});

	// 跳转到第几页
	$('.page_input').change(function() {
		var _href = $('.page_submit').attr('data-url') + $(this).val().toString();
		$('.page_submit').attr('href', _href);
	});
});