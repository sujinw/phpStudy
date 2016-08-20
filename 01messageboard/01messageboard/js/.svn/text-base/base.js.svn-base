$(function() {
	/* 主体高度 */
	if ( $('.base_wrapper').height() < getPageSize()[3] ) {
		$('.base_wrapper').css('min-height', getPageSize()[3]);
	}

	/* 监测窗体大小变化事件 */
	$(window).resize(function() {
		if ( $('.base_wrapper').height() < getPageSize()[3] ) {
			$('.base_wrapper').css('min-height', getPageSize()[3]);
		}
	});
});

/**
 * 获取页面的宽度、高度，浏览器的宽度、高度
 * return array arrayPageSize
 */
function getPageSize() {
	var xScroll, yScroll;
	if (window.innerHeight && window.scrollMaxY) {
		xScroll = window.innerWidth + window.scrollMaxX;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else {
		if (document.body.scrollHeight > document.body.offsetHeight) {
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		} else {
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}
	}
	var windowWidth, windowHeight;
	if (self.innerHeight) {
		if (document.documentElement.clientWidth) {
			windowWidth = document.documentElement.clientWidth;
		} else {
			windowWidth = self.innerWidth;
		}
		windowHeight = self.innerHeight;
	} else {
		if (document.documentElement && document.documentElement.clientHeight) {
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
		} else {
			if (document.body) {
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}
		}
	}
	if (yScroll < windowHeight) {
		pageHeight = windowHeight;
	} else {
		pageHeight = yScroll;
	}
	if (xScroll < windowWidth) {
		pageWidth = xScroll;
	} else {
		pageWidth = windowWidth;
	}
	arrayPageSize = new Array(pageWidth, pageHeight, windowWidth, windowHeight);
	return arrayPageSize;
}

/**
 * 获取相对网页顶部滚动的距离
 * @return int scrollTop 相对网页顶部滚动的距离
 */
function getScrollTop() {
	var scrollTop = 0;
	if( document.documentElement && document.documentElement.scrollTop ) {
		scrollTop = document.documentElement.scrollTop;
	}
	else if( document.body ) {
		scrollTop = document.body.scrollTop;
	}
	return scrollTop;
}