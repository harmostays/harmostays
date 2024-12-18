jQuery(function ($) {
	"use strict"
	var isEmpty = function isEmpty(f) {
		return (/^function[^{]+\{\s*\}/m.test(f.toString())
		);
	}
	$(".bravo-filter-price").each(function () {
		var input_price = $(this).find(".filter-price");
		var $this = input_price,
			type = $this.data('type'),
			minResult = $this.data('result-min'),
			maxResult = $this.data('result-max'),
			secondaryResult = $this.data('result-secondary'),
			secondaryValue = $this.data('secondary-value'),
			hasGrid = Boolean($this.data('grid')),
			graphForegroundTarget = $this.data('foreground-target');
		var config = {
			hide_min_max: true,
			hide_from_to: true,
			onStart: function () {
			},
			onChange: function () {
			},
			onFinish: function () {
				$(".bravo_form_filter").submit();
			},
			onUpdate: function () {
			}
		};
		$this.ionRangeSlider({
			hide_min_max: true,
			hide_from_to: true,
			onStart: isEmpty(config.onStart) === true ? function (data) {
				if (graphForegroundTarget) {
					var w = (100 - (data.from_percent + (100 - data.to_percent)));

					$(graphForegroundTarget).css({
						left: data.from_percent + '%',
						width: w + '%'
					});

					$(graphForegroundTarget + '> *').css({
						width: $(graphForegroundTarget).parent().width(),
						'transform': 'translateX(-' + data.from_percent + '%)'
					});
				}
				if (minResult && type === 'single') {
					if ($(minResult).is('input')) {
						$(minResult).val(data.from);
					} else {
						$(minResult).text(data.from);
					}
				} else if (minResult || maxResult && type === 'double') {
					if ($(minResult).is('input')) {
						$(minResult).val(data.from);
					} else {
						$(minResult).text(data.from);
					}

					if ($(minResult).is('input')) {
						$(maxResult).val(data.to);
					} else {
						$(maxResult).text(data.to);
					}
				}
				if (hasGrid && type === 'single') {
					$(data.slider).find('.irs-grid-text').each(function (i) {
						var current = $(this);

						if ($(current).text() === data.from) {
							$(data.slider).find('.irs-grid-text').removeClass('current');
							$(current).addClass('current');
						}
					});
				}
				if (secondaryResult) {
					secondaryValue.steps.push(data.max + 1);
					secondaryValue.values.push(secondaryValue.values[secondaryValue.values.length - 1] + 1);

					for (var i = 0; i < secondaryValue.steps.length; i++) {
						if (data.from >= secondaryValue.steps[i] && data.from < secondaryValue.steps[i + 1]) {
							if ($(secondaryResult).is('input')) {
								$(secondaryResult).val(secondaryValue.values[i]);
							} else {
								$(secondaryResult).text(secondaryValue.values[i]);
							}
						}
					}
				}
			} : config.onStart,
			onChange: isEmpty(config.onChange) === true ? function (data) {
				if (graphForegroundTarget) {
					var w = (100 - (data.from_percent + (100 - data.to_percent)));

					$(graphForegroundTarget).css({
						left: data.from_percent + '%',
						width: w + '%'
					});

					$(graphForegroundTarget + '> *').css({
						width: $(graphForegroundTarget).parent().width(),
						'transform': 'translateX(-' + data.from_percent + '%)'
					});
				}

				if (minResult && type === 'single') {
					if ($(minResult).is('input')) {
						$(minResult).val(data.from);
					} else {
						$(minResult).text(data.from);
					}
				} else if (minResult || maxResult && type === 'double') {
					if ($(minResult).is('input')) {
						$(minResult).val(data.from);
					} else {
						$(minResult).text(data.from);
					}

					if ($(minResult).is('input')) {
						$(maxResult).val(data.to);
					} else {
						$(maxResult).text(data.to);
					}
				}

				if (hasGrid && type === 'single') {
					$(data.slider).find('.irs-grid-text').each(function (i) {
						var current = $(this);

						if ($(current).text() === data.from) {
							$(data.slider).find('.irs-grid-text').removeClass('current');
							$(current).addClass('current');
						}
					});
				}

				if (secondaryResult) {
					for (var i = 0; i < secondaryValue.steps.length; i++) {
						if (data.from >= secondaryValue.steps[i] && data.from < secondaryValue.steps[i + 1]) {
							if ($(secondaryResult).is('input')) {
								$(secondaryResult).val(secondaryValue.values[i]);
							} else {
								$(secondaryResult).text(secondaryValue.values[i]);
							}
						}
					}
				}
			} : config.onChange,
			onFinish: isEmpty(config.onFinish) === true ? function (data) {
			} : config.onFinish,
			onUpdate: isEmpty(config.onUpdate) === true ? function (data) {
			} : config.onUpdate
		});
	});

	var mapEngine = new BravoMapEngine('bravo_results_map',{
		fitBounds:true,
		center:[51.505, -0.09],
		zoom:6,
		disableScripts:true,
		ready: function (engineMap) {
			if(bravo_map_data.markers){
				engineMap.addMarkers2(bravo_map_data.markers);
			}
		}
	});

	$('.bravo_form_search_map .smart-search .child_id').on('change',function () {
		reloadForm();
	});
    $('.bravo_form_search_map .g-map-place input[name=map_place]').on('change',function () {
        reloadForm();
    });

	$('.bravo_form_search_map .input-filter').on('change',function () {
		reloadForm();
	});
	$('.bravo_form_search_map .btn-filter,.btn-apply-advances').on('click',function () {
		reloadForm();
	});
	$('.btn-apply-advances').on('click',function(){
		$('#advance_filters').addClass('d-none');
	})

	function reloadForm(){
		$('.map_loading').show();
		$.ajax({
			data:$('.bravo_form_search_map input,select,textarea,input:hidden,#advance_filters input,select,textarea').serialize()+'&_ajax=1&_map=1',
			url:window.location.href.split('?')[0],
			dataType:'json',
			type:'get',
			success:function (json) {
				$('.map_loading').hide();
				if(json.status)
				{
					mapEngine.clearMarkers();
					mapEngine.addMarkers2(json.markers);

                    if(typeof json.fragments !== 'undefined'){
                        for(const k in json.fragments){
                            $(k).html(json.fragments[k]);
                        }
                    }

					$('.listing_items').animate({
                        scrollTop:0
                    },'fast');

					if(window.lazyLoadInstance){
						window.lazyLoadInstance.update();
					}

				}

			},
			error:function (e) {
				$('.map_loading').hide();
				if(e.responseText){
					$('.bravo-list-item').html('<p class="alert-text danger">'+e.responseText+'</p>')
				}
			}
		})
	}

	function reloadFormByUrl(url){
        $('.map_loading').show();
        $.ajax({
            url:url,
            dataType:'json',
            type:'get',
            success:function (json) {
                $('.map_loading').hide();
                if(json.status)
                {
                    mapEngine.clearMarkers();
                    mapEngine.addMarkers2(json.markers);

                    if(typeof json.fragments !== 'undefined'){
                        for(const k in json.fragments){
                            $(k).html(json.fragments[k]);
                        }
                    }
                    setTimeout(function () {
						$('.listing_items').animate({
							scrollTop:0
						},'fast');
						if($(document).width() < 991){
							$('html,body').animate({
								scrollTop: $(".listing_items").offset().top - 50
							},'fast');
						}
					},500);

                    if(window.lazyLoadInstance){
                        window.lazyLoadInstance.update();
                    }
                }

            },
            error:function (e) {
                $('.map_loading').hide();
                if(e.responseText){
                    $('.bravo-list-item').html('<p class="alert-text danger">'+e.responseText+'</p>')
                }
            }
        })
	}

	$('.toggle-advance-filter').on('click',function () {
		var id = $(this).data('target');
		$(id).toggleClass('d-none');
	});

    $(document).on('click', '.filter-item .dropdown-menu', function (e) {

        if(!$(e.target).hasClass('btn-apply-advances')){
            e.stopPropagation();
		}
    })
		.on('click','.bravo-pagination a',function (e) {
			e.preventDefault();
            reloadFormByUrl($(this).attr('href'));
        })
	;

});
