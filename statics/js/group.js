// JavaScript Document
;(function (app, $) {
    app.ad_group_list = {
        init: function () {
            //搜索功能
            $("form[name='searchForm'] .search_ad_position").on('click', function (e) {
                e.preventDefault();
                var url = $("form[name='searchForm']").attr('action');
                var keywords = $("input[name='keywords']").val();
                if (keywords != '') {
                    url += '&keywords=' + keywords;
                }
                ecjia.pjax(url);
            });

			$('[href="#editArea"]').on('click', function() {
				var name	= $(this).attr('data-name'),
						val		= $(this).attr('value');
				$('#editArea .parent_name').text(name);
				$('#editArea input[name="id"]').val(val);
			});

			$('form').on('submit', function(e) {
				e.preventDefault();
				$(this).ajaxSubmit({
					dataType : "json",
					success : function(data) {
						$('#editArea').modal('hide');
						$('#addArea').modal('hide');
						ecjia.admin.showmessage(data);
					}
				});
			});
        }
    };
 
    
    /* **编辑** */
    app.ad_group_edit = {
        init: function () {
        	$('.copy').on('click', function() {
				var $this = $(this),
					message = $this.attr('data-msg'),
					url = $this.attr('data-href');
					var city_id = $("#city_id option:selected").val();
					var position_name = $("input[name='position_name']").val();
					var position_desc = $("#position_desc").val()
					var sort_order = $("input[name='sort_order']").val();
	                url += '&city_id=' + city_id+'&position_name=' + position_name+'&position_desc=' + position_desc+'&sort_order=' + sort_order;
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
			
            app.ad_group_edit.submit_form();
        },
        submit_form: function (formobj) {
            var $form = $("form[name='theForm']");
            var option = {
                rules: {
                    position_name: {
                        required: true
                    },
                    position_code: {
                        required: true
                    }
                },
                messages: {
                    position_name: {
                        required: "请输入广告组名称"
                    },
                    position_code: {
                        required: "请输入广告组代号"
                    }
                },
                submitHandler: function () {
                    $form.ajaxSubmit({
                        dataType: "json",
                        success: function (data) {
                            ecjia.admin.showmessage(data);
                        }
                    });
                }
            }
            var options = $.extend(ecjia.admin.defaultOptions.validate, option);
            $form.validate(options);
        }
	}
    
    

    /* 关联商品 */
    app.link_goods = {
        init: function () {
            $(".nav-list-ready ,.ms-selection .nav-list-content").disableSelection();
            app.link_goods.search_link_goods();
            app.link_goods.del_link_article();
            app.link_goods.submit_link_article();
        },
 
        search_link_goods: function () {
            /* 查找商品 */
            $('[data-toggle="searchGoods"]').on('click', function () {
                var $choose_list = $('.choose_list'),
                    searchURL = $choose_list.attr('data-url');
                var filters = {
                     'city_id': $choose_list.find('[name="city_id"] option:checked').val(),
                };
                $.get(searchURL, filters, function (data) {
                    app.link_goods.load_link_article_opt(data);
                }, "JSON");
            })
        },
 
        load_link_article_opt: function (data) {
            $('.nav-list-ready').html('');
            if (data.content.length > 0) {
                for (var i = 0; i < data.content.length; i++) {
                    var disable = $('.nav-list-content .ms-elem-selection').find('input[value="' + data.content[i].value + '"]').length ? 'disabled' : '';
                    var opt = '<li class="ms-elem-selectable ' + disable + '" id="articleId_' + data.content[i].value + '" data-id="' + data.content[i].value + '"><span>' + data.content[i].text + '</span></li>'
                    $('.nav-list-ready').append(opt);
                };
            } else {
                $('.nav-list-ready').html('<li class="ms-elem-selectable disabled"><span>' + js_lang.select_goods_empty + '</span></li>');
            }
            app.link_goods.search_link_article_opt();
            app.link_goods.add_link_article();
        },
 
        search_link_article_opt: function () {
            //li搜索筛选功能
            $('#ms-search').quicksearch(
                $('.ms-elem-selectable', '#ms-custom-navigation'), {
                onAfter: function () {
                    $('.ms-group').each(function (index) {
                        $(this).find('.isShow').length ? $(this).css('display', 'block') : $(this).css('display', 'none');
                    });
                    return;
                },
                show: function () {
                    this.style.display = "";
                    $(this).addClass('isShow');
                },
                hide: function () {
                    this.style.display = "none";
                    $(this).removeClass('isShow');
                },
            });
        },
 
        add_link_article: function () {
            $('.nav-list-ready li')
                .on('click', function () {
                var $this = $(this),
                    tmpobj = $('<li class="ms-elem-selection"><input type="hidden" name="goods_id[]" value="' + $this.attr('data-id') + '" />' + $this.text() +
                        '<span class="edit-list"><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span></li>');
                if (!$this.hasClass('disabled')) {
                    tmpobj.appendTo($(".ms-selection .nav-list-content"));
                    $this.addClass('disabled');
                }
                //给新元素添加点击事件
                tmpobj.on('dblclick', function () {
                    $this.removeClass('disabled');
                    tmpobj.remove();
                }).find('i.del').on('click', function () {
                    tmpobj.trigger('dblclick');
                });
            });
        },
 
        del_link_article: function () {
            //给右侧元素添加点击事件
            $('.nav-list-content .ms-elem-selection').on('dblclick', function () {
                var $this = $(this);
                $(".nav-list-ready li").each(function (index) {
                    if ($(".nav-list-ready li").eq(index).attr('id') == 'articleId_' + $this.find('input').val()) {
                        $(".nav-list-ready li").eq(index).removeClass('disabled');
                    }
                });
                $this.remove();
            }).find('i.del').on('click', function () {
                $(this).parents('li').trigger('dblclick');
            });
        },
 
        submit_link_article: function () {
            //表单提交
            $('form[name="theForm"]').on('submit', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var info = {
                    'linked_array': []
                };
                $('.nav-list-content li').each(function (index) {
                    var position_id = $('.nav-list-content li').eq(index).find('input').val();
                    info.linked_array.push({
                        'position_id': position_id
                    });
                });
                $.get(url, info, function (data) {
                    ecjia.admin.showmessage(data);
                });
            })
        }
    }
    
    
    
})(ecjia.admin, jQuery);

//end