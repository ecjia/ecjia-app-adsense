// JavaScript Document
;
(function(app, $) {
	app.mh_cycleimage = {
		cycleimage_group_info: function() {
			$('.copy').on('click', function() {
				var $this = $(this),
					message = $this.attr('data-msg'),
					url = $this.attr('data-href');
					var position_name = $("input[name='position_name']").val();
					var position_desc = $("#position_desc").val()
					var max_number = $("input[name='max_number']").val();
					var sort_order = $("input[name='sort_order']").val();
					var ad_width = $("input[name='ad_width']").val();
					var ad_height = $("input[name='ad_height']").val();
	                url += '&position_name=' + position_name+'&position_desc=' + position_desc+'&max_number=' + max_number+'&sort_order=' + sort_order+'&ad_width=' + ad_width+'&ad_height=' + ad_height;
				if (message != undefined) {
					smoke.confirm(message, function(e) {
						if (e) {
							$.get(url, function(data){
								ecjia.merchant.showmessage(data);
							})
						}
					}, {ok:"确定", cancel:"取消"});
				} 
			});
		
			var $this = $('form[name="theForm"]');
			var option = {
				rules: {
					position_name: {
						required: true
					},
					position_code: {
						required: true
					},
				},
				messages: {
					position_name: {
						required: "请输入轮播组名称"
					},
					position_code: {
						required: "请输入轮播组代号"
					},
				},
				submitHandler: function() {
					$this.ajaxSubmit({
						dataType: "json",
						success: function(data) {
							ecjia.merchant.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.merchant.defaultOptions.validate, option);
			$this.validate(options);
		},
		
		cycleimage_info: function() {
			var $this = $('form[name="theForm"]');
			var option = {
				rules: {
					ad_link: {
						required: true
					},
				},
				messages: {
					ad_link: {
						required: "请输入图片链接"
					},
				},
				submitHandler: function() {
					$this.ajaxSubmit({
						dataType: "json",
						success: function(data) {
							ecjia.merchant.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.merchant.defaultOptions.validate, option);
			$this.validate(options);
		},
	};
})(ecjia.merchant, jQuery);

// end