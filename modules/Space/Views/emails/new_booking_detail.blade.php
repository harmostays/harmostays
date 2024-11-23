<?php
$translation = $service->translate();
$lang_local = app()->getLocale();
?>

<div class="b-table-wrap">
    <table class="b-table" cellspacing="0" cellpadding="0">
        <tr>
            <td class="label">{{__('Booking Number')}}</td>
            <td class="val">#{{$booking->id}}</td>
        </tr>
        <tr>
            <td class="label">{{__('Booking Status')}}</td>
            <td class="val">{{$booking->statusName}}</td>
        </tr>
        @if($booking->gatewayObj)
            <tr>
                <td class="label">{{__('Payment method')}}</td>
                <td class="val">{{$booking->gatewayObj->getOption('name')}}</td>
            </tr>
        @endif
        @if($booking->gatewayObj and $note = $booking->gatewayObj->getOption('payment_note'))
            <tr>
                <td class="label">{{__('Payment Note')}}</td>
                <td class="val">{!! clean($note) !!}</td>
            </tr>
        @endif
        <tr>
            <td class="label">{{__('Stay name')}}</td>
            <td class="val">
                <a href="{{$service->getDetailUrl()}}">{!! clean($translation->title) !!}</a>
            </td>

        </tr>
        <tr>
            @if($translation->address)
                <td class="label">{{__('Address')}}</td>
                <td class="val">
                    {{$translation->address}}
                </td>
            @endif
        </tr>
        @if($booking->start_date && $booking->end_date)
            <tr>
                <td class="label">{{__('Check-in date')}}</td>
                <td class="val">{{display_date($booking->start_date)}}</td>
            </tr>
            <tr>
                <td class="label">{{__('Check-out date')}}</td>
                <td class="val">
                    {{display_date($booking->end_date)}}
                </td>
            </tr>
            @if($booking->getMeta("booking_type") == "by_day")
                <tr>
                    <td class="label">{{__('Days:')}}</td>
                    <td class="val">
                        {{$booking->duration_days}}
                    </td>
                </tr>
            @endif
            @if($booking->getMeta("booking_type") == "by_night")
                <tr>
                    <td class="label">{{__('Nights:')}}</td>
                    <td class="val">
                        {{$booking->duration_nights}}
                    </td>
                </tr>
            @endif
        @endif

        @if($meta = $booking->getMeta('adults'))
            <tr>
                <td class="label">{{__('Adults')}}:</td>
                <td class="val">
                    <strong>{{$meta}}</strong>
                </td>
            </tr>
        @endif
        @if($meta = $booking->getMeta('children'))
            <tr>
                <td class="label">{{__('Children')}}:</td>
                <td class="val">
                    <strong>{{$meta}}</strong>
                </td>
            </tr>
        @endif
        <tr>
            <td class="label">{{__('Pricing')}}</td>
            <td class="val">
                <table class="pricing-list" width="100%">
                    <tr>
                        <td class="label fsz21">{{__('Total Reservation Amount')}}</td>
                        <td class="val fsz21"><strong style="color: #FA5636">{{format_money($booking->total)}}</strong></td>
                    </tr>
                    <tr>
                        <td class="label fsz21">{{__('Amount Paid')}}</td>
                        <td class="val fsz21"><strong style="color: #FA5636">{{format_money($booking->paid)}}</strong></td>
                    </tr>
                    @if($booking->total > $booking->paid)
                        <tr>
                            <td class="label fsz21">{{__('Amount Due')}}</td>
                            <td class="val fsz21"><strong style="color: #FA5636">{{format_money($booking->total - $booking->paid)}}</strong></td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="text-center mt20">
    <a href="{{ route("user.booking_history") }}" target="_blank" class="btn btn-primary manage-booking-btn">{{__('Manage Bookings')}}</a>
</div>
