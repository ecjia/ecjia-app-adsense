// JavaScript Document
;
(function(app, $) {
	app.cycleimage = {
		cycleimage_group_info: function() {
			$('.copy').on('click', function() {
				var $this = $(this),
					message = $this.attr('data-msg'),
					url = $this.attr('data-href');
					var city_id = $("#city_id option:selected").val();
	                url += '&city_id=' + city_id;
				if (message != undefined) {
					smoke.confirm(message, function(e) {
						if (e) {
							$.get(url, function(data){
								ecjia.admin.showmessage(data);
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
						required: "轮播组名称"
					},
					position_code: {
						required: "轮播组代号"
					},
				},
				submitHandler: function() {
					$this.ajaxSubmit({
						dataType: "json",
						success: function(data) {
							ecjia.admin.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.admin.defaultOptions.validate, option);
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
							ecjia.admin.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.admin.defaultOptions.validate, option);
			$this.validate(options);
		},
	};
})(ecjia.admin, jQuery);

// end