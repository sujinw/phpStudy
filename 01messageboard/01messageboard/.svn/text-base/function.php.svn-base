<?php
/**
 * [paging 分页]
 * @param  [integer] $total     [数据总数]
 * @param  [integer] $showNum   [每页显示多少条数据]
 * @param  [integer] $showPage  [每页显示的多少个页码]
 * @param  [string]  $paramName [分页参数名]
 * @return [Array]   $pageData  [分页相关数据]
 */
function paging( $total, $showNum = 20, $showPage = 5, $paramName = 'page' ) {
	$pageData 			   = [];
	$pageDatas 			   = [];
	$pageData['pageTotal'] = intval( $total ) > 0 && preg_match( '/^[1-9]\d*$/', $total ) ? $total : 1;
	$pageData['showNum']   = intval( $showNum ) > 0 && preg_match( '/^[1-9]\d*$/', $showNum ) ? $showNum : 20;
	$pageData['showPage']  = intval( $showPage ) > 0 && preg_match( '/^[1-9]\d*$/', $showPage ) ? $showPage : 5;
	$pageData['nowPage']   = isset( $_REQUEST[$paramName] ) ? intval( $_REQUEST[$paramName] ) : 1;
	$pageData['serverUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER['PHP_SELF'];
	$pageData['paramName'] = $paramName;
	$pageData['prePage']   = '';
	$pageData['nextPage']  = '';

	// 计算总页数
	$pageData['pageTotal'] = intval( round( $pageData['pageTotal'] / $pageData['showNum'] ) );

	// 当前页数异常默认显示第一页
	if ( $pageData['nowPage'] < 1 or $pageData['nowPage'] > $pageData['pageTotal'] ) {
		$pageData['nowPage'] = 1;
	}

	// 上一页、下一页链接
	if ( $pageData['pageTotal'] > 1 ) {
		if ( $pageData['nowPage'] == 1 ) {
			$pageData['nextPage'] = $pageData['serverUrl'] . '?' . $paramName . '=' . ( $pageData['nowPage'] + 1 );
		} elseif ( $pageData['nowPage'] == $pageData['pageTotal'] ) {
			$pageData['prePage']  = $pageData['serverUrl'] . '?' . $paramName . '=' . ( $pageData['nowPage'] - 1 );
		} else {
			$pageData['prePage']  = $pageData['serverUrl'] . '?' . $paramName . '=' . ( $pageData['nowPage'] - 1 );
			$pageData['nextPage'] = $pageData['serverUrl'] . '?' . $paramName . '=' . ( $pageData['nowPage'] + 1 );
		}
	}

	// 拼接分页html代码
	$pageHtml = '';
	// 分页总数大于1
	if ( $pageData['pageTotal'] > 1 ) {
		// 总页数大于每页显示多少页码
		if ( $pageData['pageTotal'] > $pageData['showPage'] ) {
			// 上一页
			if ( $pageData['prePage'] ) {
				$pageHtml .= '<a class="page_opt" href="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=1">首页</a>';
				$pageHtml .= '<a class="page_opt" href="' . $pageData['prePage'] . '">上一页</a>';
			} else {
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">首页</a>';
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">上一页</a>';
			}

			// 前省略号
			if ( $pageData['nowPage'] > ceil( $pageData['showPage'] / 2 ) ) {
				$pageHtml .= '<span class="page_more">...</span>';
			}

			// 中间部分
			$startNum = '';
			$endNum   = '';
			if ( $pageData['nowPage'] < ceil( $pageData['showPage'] / 2 ) ) {
				$startNum = 1;
				$endNum   = $pageData['showPage'];
			} elseif ( $pageData['nowPage'] > ( $pageData['pageTotal'] - intval( $pageData['showPage'] / 2 ) ) ) {
				$startNum = $pageData['pageTotal'] - $pageData['showPage'] + 1;
				$endNum   = $pageData['pageTotal'];
			} else {
				$startNum = $pageData['nowPage'] - intval( $pageData['showPage'] / 2 );
				$endNum   = $pageData['nowPage'] + intval( $pageData['showPage'] / 2 );
			}
			for ($i = $startNum; $i <= $endNum ; $i ++) { 
				if ( $i == $pageData['nowPage'] ) {
					$pageHtml .= '<span class="page_current">' . $i . '</span>';
				} else {
					$pageHtml .= '<a class="page_num" href="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=' . $i . '">' . $i . '</a>';
				}
			}

			// 后省略号
			if ( $pageData['nowPage'] < $pageData['pageTotal'] - intval( $pageData['showPage'] / 2 ) ) {
				$pageHtml .= '<span class="page_more">...</span>';
			}

			// 下一页
			if ( $pageData['nextPage'] ) {
				$pageHtml .= '<a class="page_opt" href="' . $pageData['nextPage'] . '">下一页</a>';
				$pageHtml .= '<a class="page_opt" href="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=' . $pageData['pageTotal'] . '">末页</a>';
			} else {
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">下一页</a>';
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">末页</a>';
			}

			// 分页右侧
			$pageHtml .= '<span class="page_total">共' . $pageData['pageTotal'] . '页</span>';
			$pageHtml .= '<span class="page_text">到第</span>';
			$pageHtml .= '<input class="page_input" type="text" maxlength="3" />';
			$pageHtml .= '<span class="page_text">页</span>';
			$pageHtml .= '<a class="page_submit" href="javascript:void(0);" data-url="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=">确定</a>';

		} else {	// 总页数小于等于每页显示多少页码
			// 上一页
			if ( $pageData['prePage'] ) {
				$pageHtml .= '<a class="page_opt" href="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=1">首页</a>';
				$pageHtml .= '<a class="page_opt" href="' . $pageData['prePage'] . '">上一页</a>';
			} else {
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">首页</a>';
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">上一页</a>';
			}

			// 中间部分
			for ($i = 1; $i <= $pageData['pageTotal'] ; $i++) { 
				if ( $i == $pageData['nowPage'] ) {
					$pageHtml .= '<span class="page_current">' . $i . '</span>';
				} else {
					$pageHtml .= '<a class="page_num" href="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=' . $i . '">' . $i . '</a>';
				}
			}

			// 下一页
			if ( $pageData['nextPage'] ) {
				$pageHtml .= '<a class="page_opt" href="' . $pageData['nextPage'] . '">下一页</a>';
				$pageHtml .= '<a class="page_opt" href="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=' . $pageData['pageTotal'] . '">末页</a>';
			} else {
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">下一页</a>';
				$pageHtml .= '<a class="page_ban" href="javascript:void(0);">末页</a>';
			}

			// 分页右侧
			$pageHtml .= '<span class="page_total">共' . $pageData['pageTotal'] . '页</span>';
			$pageHtml .= '<span class="page_text">到第</span>';
			$pageHtml .= '<input class="page_input" type="text" maxlength="3" />';
			$pageHtml .= '<span class="page_text">页</span>';
			$pageHtml .= '<a class="page_submit" href="javascript:void(0);" data-url="' . $pageData['serverUrl'] . '?' . $pageData['paramName'] . '=">确定</a>';
		}
	}

	// 把需要的数据装入返回数组
	$pageDatas['pageHtml']  = $pageHtml;
	$pageDatas['limit']     = ' LIMIT ' . $pageData['showNum'] * ( $pageData['nowPage'] - 1 ) . ',' . $pageData['showNum'];

	return $pageDatas;
}

/**
 * [getOnlineIp 获取用户公网IP地址]
 * @return [String] [用户公网IP地址]
 */
function getOnlineIp() {
	$ch = curl_init('http://city.ip138.com/ip2city.asp');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$a = curl_exec($ch);
	preg_match('/\[(.*)\]/', $a, $ip);
	return @$ip[1];
}

/**
 * [jsNotice 输出js代码提示信息]
 * @param  [String] $msg [提示信息]
 * @param  [String] $url [跳转链接]
 * @return [String] [js代码]
 */
function jsNotice( $msg, $url = 'no' ) {
	if ( $url == 'no' ) {
		echo '<script type="text/javascript"> $(function() { layer.msg("' . $msg . '", {time : 1000}); }); </script>';
	} else {
		echo '<script type="text/javascript"> $(function() { layer.msg("' . $msg . '", {time : 1000}, function() { window.location.href = "' . $url . '"; }); }); </script>';
	}
}

/**
 * [getSuffix 获取文件后缀名]
 * @param  [String] $fileName [文件名]
 * @return [String] $suffix [文件后缀名]
 */
function getSuffix( $fileName ) {
	if ( strrchr( $fileName, '.' ) ) {
		$suffix   = strrchr( $fileName, '.' );
	} else {
		$suffix   = '';
	}
	return $suffix;
}
?>