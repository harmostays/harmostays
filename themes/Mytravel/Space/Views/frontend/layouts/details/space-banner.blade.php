@if($row->banner_image_id)
<div class="bravo_content">
    @if(!empty($breadcrumbs))
    <div class="container">
        <nav class="py-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter mb-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{url('')}}">{{__('Home')}}</a></li>
                @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 {{$breadcrumb['class'] ?? ''}}">
                    @if(!empty($breadcrumb['url']))
                    <a href="{{url($breadcrumb['url'])}}">{{$breadcrumb['name']}}</a>
                    @else
                    {{$breadcrumb['name']}}
                    @endif
                </li>
                @endforeach
            </ol>
        </nav>
    </div>
    @endif
    <div class="mb-8">
        <div id="sliderSyncingNav" class="travel-slick-carousel u-slick mb-2"
             data-infinite="true"
             data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
             data-arrow-left-classes="flaticon-back u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
             data-arrow-right-classes="flaticon-next u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
             data-nav-for="#sliderSyncingThumb">
            @foreach($row->getGallery() as $key=>$item)
                <div class="js-slide">
                    <img class="img-fluid border-radius-3" src="{{$item['large']}}" alt="{{ __("Gallery") }}">
                </div>
            @endforeach
        </div>
        @if(!empty($row->video))
            <div class="position-absolute right-0 mr-3 mt-md-n11 mt-n9">
                <div class="flex-horizontal-center">
                    <a class="travel-fancybox btn btn-white transition-3d-hover py-2 px-md-5 px-3 shadow-6 mr-1" href="javascript:;"
                       data-src="{{ handleVideoUrl($row->video) }}"
                       data-speed="700">
                        <i class="flaticon-movie mr-md-2 font-size-18 text-primary"></i>
                        <span class="d-none d-md-inline">{{ __("Video") }}</span>
                    </a>
                </div>
            </div>
        @endif
        <div id="sliderSyncingThumb" class="travel-slick-carousel u-slick u-slick--gutters-4 u-slick--transform-off"
             data-infinite="true"
             data-slides-show="6"
             data-is-thumbs="true"
             data-nav-for="#sliderSyncingNav"
             data-responsive='[{
                                        "breakpoint": 992,
                                        "settings": {
                                            "slidesToShow": 4
                                        }
                                    }, {
                                        "breakpoint": 768,
                                        "settings": {
                                            "slidesToShow": 3
                                        }
                                    }, {
                                        "breakpoint": 554,
                                        "settings": {
                                            "slidesToShow": 2
                                        }
                                    }]'>
            @foreach($row->getGallery() as $key=>$item)
                <div class="js-slide" style="cursor: pointer;">
                    <img class="img-fluid border-radius-3 height-110" src="{{$item['thumb']}}" alt="{{ __("Gallery") }}">
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif