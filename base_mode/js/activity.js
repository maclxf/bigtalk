$(function () {
	// 跳转
	$(document).on("click",".scroll_to", function (e) {
		e.preventDefault();
		let where = $(this).data("where");

		custom_dom.scroll_to(where);
	});

	/* 内容切换 */
	$(".content_switch li").on("click", function () {
		custom_dom.switch_button($(this));
	});

	$('.login_info').on("click", function (e) {
		$.confirm({
			title : 'Login',
			content : $('#login').html(),
			boxWidth: '30%',
			type: 'blue', // 'material', 'bootstrap',
			useBootstrap: false,
			buttons: {
		        login:{
		        		text: '登录',
		        		btnClass: 'btn-blue',
		        		keys: ['enter'],
		        		action: function() {
		        			if ($('#user_name').val() == '') {
		        				$('#user_name').focus();
		        				return false;
		        			}

		        			if ($('#user_paw').val() == '') {
		        				$('#user_paw').focus();
		        				return false; // prevent modal from closing
		        			}
		        			$.ajax({
        			            url: 'http://bigtalk.dev/base_mode/php/back.php',
        			            dataType: 'json',
        			            success: function(json) {
        			            	if (json.login.ret) {
        			            		$.alert({
        			            			title:'提示',
        			            			content:'登录成功',
        			            			boxWidth: '30%',
        			            			useBootstrap: false,
        			            		});
        			            	}
        			            }
        			        });
		        		}
		        },
		        cancel: {
		        	text: '取消',
		        	btnClass: 'btn-red',
		        	keys: ['esc'],
		        	/*action:{

		        	}*/

		        }/*function(heyButton){
		            // access the button using jquery
		            this.$$hello.trigger('click'); // click the 'hello' button
		            this.$$hey.prop('disabled', true); // disable the current button using jquery method

		            // jconfirm button methods, all methods listed here
		            this.buttons.hello.setText('Helloooo'); // setText for 'hello' button
		            this.buttons.hey.disable(); // disable with button function provided by jconfirm
		            this.buttons.hey.enable(); // enable with button function provided by jconfirm
		            // the button's instance is passed as the first argument, for quick access
		            heyButton === this.buttons.hey;
		        },*/
		    }
		});
	});


	/* 说明 */
	$("#btn_prompt").on("click", function (e) {
		e.preventDefault();
		$.dialog({
			title : 'I`m Title',
			content : $('#prompt_one').html(),
			boxWidth: '30%',
			type: 'blue', // 'material', 'bootstrap',
			useBootstrap: false,
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


	/* 用户名登录框 */
	$("#user_name, #user_paw").keyup(function(){
	    var n = this.value.length;
	    if( n > 3 ) {
	    	$(this).next().addClass('show');
		}else{
			$(this).next().removeClass('show');
		}
	});

	$(".user_name_clear, .user_pwd_clear").click(function(){
			$(this).removeClass('show');
			$(this).prev().prop("value",'').focus();
		}
	);

	/* 登录框提示 -- 取消*/
	$(".login_info").on("click", function () {
		$(".login_wrap").fadeToggle();
		$(".login_wrap").prev().fadeToggle();
	});

	$(".prompt_info").on("click", function () {
		$(".info_prompt_wrap").fadeToggle();
		$(".info_prompt_wrap").prev().fadeToggle();
	});

	$(".btn_prompt_cancel, .btn_prompt_confirm").on("click", function() {
		$(".info_prompt_wrap").fadeToggle();
		$(".info_prompt_wrap").prev().fadeToggle();

		var prompt_btn_status = $(this).text();
		if ( prompt_btn_status == "确定" ) {
			alert(111);
		}
	});

});