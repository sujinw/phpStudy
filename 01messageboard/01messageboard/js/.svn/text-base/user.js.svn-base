$(function() {
	/* 安全退出 */
	$('#exit').click(function() {
		layer.confirm('确定要退出吗？', {
			icon     : 3,
			title    : [ '提示' ],
			closeBtn : 2,
			move     : false
		}, function(luxury) {
			layer.close(luxury);
			$.post('loginout.php', {username : $('#user_name').text()}, function( data ) {
				layer.msg( data.msg, {time : 1000}, function() {
					if ( data.state == 1 ) {
						window.location.reload(true);
					}
				});
			}, 'json');
		});
	});
});