@extends('layouts.app',['container_class'=>'container-fluid'])
@push('css')
    <link href="{{ asset('themes/mytravel/dist/frontend/module/tour/css/tour.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <style type="text/css">
        .bravo_footer {
            display: none
        }
    </style>
@endpush
@section('content')
    <div class="bravo_search_tour">
        <h1 class="d-none">
            {{setting_item_with_lang("tour_page_search_title")}}
        </h1>
        <div class="bravo_form_search_map">
            @include('Tour::frontend.layouts.search-map.form-search-map')
        </div>
        <div class="bravo_search_map {{ setting_item_with_lang("tour_layout_map_option",false,"map_left") }}">
            <div class="results_map">
                <div class="map-loading d-none">
                    <div class="st-loader"></div>
                </div>
                <div id="bravo_results_map" class="results_map_inner"></div>
            </div>
            <div class="results_item">
                @include('Tour::frontend.layouts.search-map.advance-filter')
                <div class="listing_items ajax-search-result">
                    @include('Tour::frontend.ajax.search-result-map')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        var bravo_map_data = {
            markers:{!! json_encode($markers) !!}
        };
    </script>
    <script type="text/javascript" src="{{ asset("themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('themes/mytravel/js/filter-map.js?_ver='.config('app.asset_version')) }}"></script>
@endpush
