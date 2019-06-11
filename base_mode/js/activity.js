$(function () {
	jconfirm.pluginDefaults.useBootstrap = false;
	// 跳转
	$(document).on("click",".scroll_to", function (e) {
		e.preventDefault();
		let where = $(this).data("where");

		custom_dom.scroll_to(where);
	});

	/* 内容切换 */
	$(".content_switch li").on("click", function () {
		custom_dom.switch_button($(this));

		custom_dom.fill_container($('#fill'), $(this).data('content'));
	});

	/* 说明 */
	$("#btn_prompt").on("click", function (e) {
		e.preventDefault();
		var notice = $(this).data('notice');
		custom_dom.prompt_notice(notice);

	});

	/* 注册 */
	$('.login_info').on("click", function (e) {
		$.confirm({
			title : false,// 定制 可以禁用title
			content : $('#login').html(),// 定制
			boxWidth: '30%',// 定制
			type: 'blue', // 'material', 'bootstrap',// 默认 || 定制
			 //定死
			buttons: {
		        login:{
	        		text: '登录',
	        		btnClass: 'btn-blue btn-login',
	        		keys: ['enter'],
	        		action: function() {
	        			var self = this;
	        			var name = $('#user_name').val();
				        if (name == '') {
							$('#user_name').focus();
							return false;
						}

						var psd = $('#user_paw').val();
						if (psd == '') {
							$('#user_paw').focus();
							return false; // prevent modal from closing
						}

						$.ajax({
				            url: 'http://bigtalk.dev/base_mode/php/back.php',
				            dataType: 'json',
				            data: {name:name, psd:psd},
				            beforeSend:function() {
				            	 self.$$login.prop('disabled', true).removeClass('btn-blue').addClass('btn-gray');// 基于Jconfirm 可以有个按钮的禁用和启用
				            	 self.$$cancel.prop('disabled', true).removeClass('btn-red').addClass('btn-gray');// 基于Jconfirm 可以有个按钮的禁用和启用
				            }
				        }).then(function(json) {
				        	if (json.ret) {
				        		$.alert({
				        			title:false,
				        			content:'登录成功',
				        			type: 'green',
				        			boxWidth: '30%',
				        		});
				        		// click the 'hello' button
				        		self.$$cancel.trigger('click');
				        	} else {
				        		$('#error_msg').text(json.msg);
				        		self.$$login.prop('disabled', false).removeClass('btn-gray').addClass('btn-blue');// 基于Jconfirm 可以有个按钮的禁用和启用
				        		self.$$cancel.prop('disabled', false).removeClass('btn-gray').addClass('btn-red');// 基于Jconfirm 可以有个按钮的禁用和启用
				        	}
				        });

				        return false;
	        		}
		        },
		        cancel: {
		        	text: '取消',
		        	btnClass: 'btn-red',
		        	keys: ['esc'],
		        },
		    }
		});
	});

/*****************************************************************************************************************************/
	/* 倒计时 */
	var timer = setInterval(countDownFn, 1);

	function countDownFn() {
		var newTime = new Date();
		var startTime = new Date("2018/11/29 11:01:46");

		// getTime() 毫秒
		var remainingTime = startTime.getTime() - newTime.getTime();
		// Math.floor向下取整
		var day = Math.floor(remainingTime/1000/60/60/24);
		var hour = Math.floor(remainingTime/1000/60/60%24);
		var minute = Math.floor(remainingTime/1000/60%60);
		var second = Math.floor(remainingTime/1000%60);

		day = day<10?"0"+day:day;
		hour = day<10?"0"+hour:hour;
		minute = minute<10?"0"+minute:minute;
		second = second<10?"0"+second:second;

		if ( remainingTime < 1 ) {
			clearInterval(timer);
			return;
		}

		$(".remaining_day").html(day);
		$(".remaining_hour").html(hour);
		$(".remaining_minute").html(minute);
		$(".remaining_second").html(second);
	};


	$(".user_name_clear, .user_pwd_clear").click(function(){
			$(this).removeClass('show');
			$(this).prev().prop("value",'').focus();
		}
	);


});