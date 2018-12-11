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
     * @return {[type]}                           [description]
     */
    switch_button: function(selector, filled_container_selector = '') {
		if (selector === null || typeof selector === 'string') {
	        return this;
	    }
		selector.addClass('current').siblings().removeClass('current');
    },

    /**
     * 将内容填充到容器中
     * @author lixiaofeng 2018-12-08
     * @param  {[type]} container_selector        容器
     * @param  {String} content_selector          填充内容
     * @return {[type]}                           [description]
     */
    fill_container: function(container_selector, content_selector = '') {
        if (container_selector === null) {
            return this;
        }

        // 容器
        container_selector = typeof container_selector === 'string' ? $(container_selector) : container_selector;
        if (container_selector.length < 1) {
            return this;
        }

        // 内容
        content_selector = typeof content_selector === 'string' ? $(content_selector) : content_selector;

        // 填充内容
        container_selector.html(content_selector.html());
    },

    /**
     * [prompt_notice description]
     * @author lixiaofeng 2018-12-08
     * @param  {[type]}  notice_selector [description]
     * @param  {Boolean} title           [description]
     * @param  {String}  width           [description]
     * @param  {String}  type            [description]
     * @return {[type]}                  [description]
     */
    prompt_notice: function(notice_selector, title = false, width = '30%', type = 'blue') {
        if (notice_selector === null) {
            return this;
        }

        notice_selector = typeof notice_selector === 'string' ? $(notice_selector) : notice_selector;

        if (notice_selector.length < 1) {
            return this;
        }

        $.dialog({
            title : title,
            content : notice_selector.html(),
            boxWidth: width,
            type: type,
        });
    },

    /**
     * 启用按钮
     * @param selector
     * @param text
     * @returns {_dom_deps}
     */
    /*enable_button: function(selector, text) {
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
    },*/

    /**
     * 禁用按钮
     * @param selector
     * @param text
     * @returns {_dom_deps}
     */
    /*disable_button: function(selector, text) {
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
    },*/
}