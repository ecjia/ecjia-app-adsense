// JavaScript Document
;
(function(app, $) {
	app.link_goods = {
		init: function() {
			$(".nav-list-ready ,.ms-selection .nav-list-content").disableSelection();
			app.link_goods.search_link_goods();
			app.link_goods.del_link_goods();
			app.link_goods.change_link_model();
			app.link_goods.submit_link_goods();
		},

		search_link_goods: function() { /* 查找商品 */
			$('[data-toggle="searchPosition"]').on('click', function() {
				var $choose_list = $('.search_link_goods'),
					searchURL = $choose_list.attr('data-url');
				var filters = {
					'JSON': {
						'city_id': $choose_list.find('[name="city_id"] option:checked').val(),
					}
				};
				$.get(searchURL, filters, function(data) {
					app.link_goods.load_link_goods_opt(data);
				}, "JSON");
			})
		},
		load_link_goods_opt: function(data) {
			$('.nav-list-ready').html('');
			if (data.content.length > 0) {
				for (var i = 0; i < data.content.length; i++) {
					var disable = $('.nav-list-content .ms-elem-selection').find('input[value="' + data.content[i].value + '"]').length ? 'disabled' : '';
					var opt = '<li class="ms-elem-selectable ' + disable + '" id="goodsId_' + data.content[i].value + '" data-id="' + data.content[i].value + '" data-price="' + data.content[i].data + '"><span>' + data.content[i].text + '</span></li>'
					$('.nav-list-ready').append(opt);
				};
			} else {
				$('.nav-list-ready').html('<li class="ms-elem-selectable disabled"><span>未搜索到商品信息</span></li>');
			}
			app.link_goods.search_link_goods_opt();
			app.link_goods.add_link_goods();
		},
		search_link_goods_opt: function() {
			//li搜索筛选功能
			$('#ms-search').quicksearch(
			$('.ms-elem-selectable', '#ms-custom-navigation'), {
				onAfter: function() {
					$('.ms-group').each(function(index) {
						$(this).find('.isShow').length ? $(this).css('display', 'block') : $(this).css('display', 'none');
					});
					return;
				},
				show: function() {
					this.style.display = "";
					$(this).addClass('isShow');
				},
				hide: function() {
					this.style.display = "none";
					$(this).removeClass('isShow');
				},
			});
		},
		add_link_goods: function() {
			$('.nav-list-ready li').on('click', function() {
				var $this = $(this),
					tmpobj = $('<li class="ms-elem-selection"><input type="hidden" name="goods_id[]" data-double="0" data-price="' + $this.attr('data-price') + '" value="' + $this.attr('data-id') + '" /><span class="link_static m_r5">[单向关联]</span>' + $this.text() + '<span class="edit-list"><a class="change_links_mod" href="javascript:;">切换关联</a><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span></li>');
				if (!$this.hasClass('disabled')) {
					tmpobj.appendTo($(".ms-selection .nav-list-content"));
					$this.addClass('disabled');
				}
				//给新元素添加点击事件
				tmpobj.on('dblclick', function() {
					$this.removeClass('disabled');
					tmpobj.remove();
				}).find('i.del').on('click', function() {
					tmpobj.trigger('dblclick');
				});
			});
		},
		del_link_goods: function() {
			//给右侧元素添加点击事件
			$('.nav-list-content .ms-elem-selection').on('dblclick', function() {
				var $this = $(this);
				$(".nav-list-ready li").each(function(index) {
					if ($(".nav-list-ready li").eq(index).attr('id') == 'goodsId_' + $this.find('input').val()) {
						$(".nav-list-ready li").eq(index).removeClass('disabled');
					}
				});
				$this.remove();
			}).find('i.del').on('click', function() {
				$(this).parents('li').trigger('dblclick');
			});
		},
		change_link_model: function() {
			//切换关联模式
			$(document).off('click.changelinksmod').on('click.changelinksmod', '.change_links_mod', function() {
				var $info = $(this).parents('.ms-elem-selection').find('input[name="goods_id[]"]');
				$info.attr('data-double') == 1 ? $info.attr('data-double', '0').parents('.ms-elem-selection').find('.link_static').text('[单向关联]') : $info.attr('data-double', '1').parents('.ms-elem-selection').find('.link_static').text('[双向关联]');
			});
		},
		submit_link_goods: function() {
			//表单提交
			$('form[name="theForm"]').on('submit', function(e) {
				e.preventDefault();
				var url = $(this).attr('action');
				var info = {
					'linked_array': []
				};
				$('.nav-list-content li').each(function(index) {
					var id = $('.nav-list-content li').eq(index).find('input').val(),
						is_double = $('.nav-list-content li').eq(index).find('input').attr('data-double');
					info.linked_array.push({
						'id': id,
						'is_double': is_double
					});
				});
				$.get(url, info, function(data) {
					ecjia.admin.showmessage(data);
				});
			})
		}
	}
})(ecjia.admin, jQuery);

// end