var custom_dom = {
	/**
     * 滚动页面到指定位置，这里使用了 ES6 支持的默认参数值
     *
     * @param selector
     * @param offset
     * @param duration
     */
    scroll_to: function(selector = 'body', offset = 10, duration = 'slow') {
        selector = typeof selector === 'string' ? $(selector) : selector;
        $("html,body").stop().animate({scrollTop: selector.offset().top - offset}, duration);
    },


    /**
     * 切换内容按钮
     * 找到被填充的容器，找到填充的内容，将内容装进容器
     * @author lxf 2018-12-06
     * @param  {[type]} selector                  触发切换按钮
     * @param  {String} filled_container_selector 填充容器
     * @return {[type]}                           [description]
     */
    switch_button: function(selector, filled_container_selector = '') {
		if (selector === null || typeof selector === 'string') {
	        return this;
	    }
		selector.addClass('current').siblings().removeClass('current');


		if (filled_container_selector) {
			// 容器
			filled_container_selector = typeof filled_container_selector === 'string' ? $(filled_container_selector) : filled_container_selector;
			if (filled_container_selector.length > 1) {
				// 内容
				content_selector = selector.data('content');
				content_selector = typeof content_selector === 'string' ? $(content_selector) : content_selector;

				// 填充内容
				filled_container_selector.html(content_selector.html());
			}
		}

    },

    /**
     * 启用按钮
     * @param selector
     * @param text
     * @returns {_dom_deps}
     */
    enable_button: function(selector, text) {
        if (selector === null) {
            return this;
        }

        selector = typeof selector === 'string' ? $(selector) : selector;
        selector = selector.prop('disabled', false);

        if (text) {
            if (selector.is('button')) {
                selector.html(text);
            } else if (selector.is('input')) {
                selector.val(text);
            }
        }

        return this;
    },

    /**
     * 禁用按钮
     * @param selector
     * @param text
     * @returns {_dom_deps}
     */
    disable_button: function(selector, text) {
        if (selector === null) {
            return this;
        }

        selector = typeof selector === 'string' ? $(selector) : selector;
        selector = selector.prop('disabled', true);

        if (text) {
            if (selector.is('button')) {
                selector.html(text);
            } else if (selector.is('input')) {
                selector.val(text);
            }
        }

        return this;
    },

}