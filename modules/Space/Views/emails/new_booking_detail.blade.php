<?php
$translation = $service->translate();
$lang_local = app()->getLocale();
?>


@push('css')
    <style type="text/css">
        html,
        body {
            background: #f4f4f9;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', Arial, sans-serif;
        }

        #invoice-print-zone {
            background: #ffffff;
            padding: 20px;
            margin: 60px auto 40px auto;
            max-width: 900px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header img {
            max-width: 100px;
        }

        .invoice-header h2 {
            font-size: 24px;
            font-weight: bold;
            color: #ff9800;
            margin-bottom: 0;
        }

        .invoice-header p {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #cccccc;
            vertical-align: top;
        }

        table tr td:first-child {
            border-left: none;
            width: 30%;
        }

        table tr td:last-child {
            border-right: none;
            width: 30%;
        }

        table tr td strong {
            display: block;
            margin-bottom: 15px;
        }

        table tr td h5 {
            margin-bottom: 0;
        }

        table tr td p {
            font-size: 14px;
            color: #555;
            font-weight: 600;
            margin: 5px 0;
        }

        hr {
            border: 0;
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        button {
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e67e22;
        }

        .text-center {
            text-align: center;
        }

        .mt20 {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
@endpush

<div class="b-panel-title">{{ __('Stay information') }}</div>
<div class="b-table-wrap">
    <table class="b-table" cellspacing="0" cellpadding="0">
        <tr>
            <td class="label">{{ __('Booking Number') }}</td>
            <td class="val">#{{ $booking->id }}</td>
        </tr>
        <tr>
            <td class="label">{{ __('Booking Status') }}</td>
            <td class="val">{{ $booking->statusName }}</td>
        </tr>
        @if($booking->gatewayObj)
            <tr>
                <td class="label">{{ __('Payment Method') }}</td>
                <td class="val">{{ $booking->gatewayObj->getOption('name') }}</td>
            </tr>
        @endif
        @if($booking->gatewayObj && $note = $booking->gatewayObj->getOption('payment_note'))
            <tr>
                <td class="label">{{ __('Payment Note') }}</td>
                <td class="val">{!! clean($note) !!}</td>
            </tr>
        @endif
        <tr>
            <td class="label">{{ __('Stay Name') }}</td>
            <td class="val">
                <a href="{{ $service->getDetailUrl() }}">{!! clean($translation->title) !!}</a>
            </td>
        </tr>
        @if($translation->address)
            <tr>
                <td class="label">{{ __('Address') }}</td>
                <td class="val">{{ $translation->address }}</td>
            </tr>
        @endif
        @if($booking->start_date && $booking->end_date)
            <tr>
                <td class="label">{{ __('Start Date') }}</td>
                <td class="val">{{ display_date($booking->start_date) }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('End Date') }}</td>
                <td class="val">{{ display_date($booking->end_date) }}</td>
            </tr>
            @if($booking->getMeta('booking_type') == 'by_day')
                <tr>
                    <td class="label">{{ __('Days') }}</td>
                    <td class="val">{{ $booking->duration_days }}</td>
                </tr>
            @endif
            @if($booking->getMeta('booking_type') == 'by_night')
                <tr>
                    <td class="label">{{ __('Nights') }}</td>
                    <td class="val">{{ $booking->duration_nights }}</td>
                </tr>
            @endif
        @endif
        @if($meta = $booking->getMeta('adults'))
            <tr>
                <td class="label">{{ __('Adults') }}</td>
                <td class="val"><strong>{{ $meta }}</strong></td>
            </tr>
        @endif
        @if($meta = $booking->getMeta('children'))
            <tr>
                <td class="label">{{ __('Children') }}</td>
                <td class="val"><strong>{{ $meta }}</strong></td>
            </tr>
        @endif
        {{-- <tr>
            <td class="label">{{ __('Pricing') }}</td>
            <td class="val">
                <table class="b-table pricing-list" width="100%">
                    <tr>
                        <td class="label">{{ __('Rental Price') }}</td>
                        <td class="val">
                            @php $price_item = $booking->total_before_extra_price; @endphp
                            <strong>{{ format_money($price_item) }}</strong>
                        </td>
                    </tr>
                    @php $extra_price = $booking->getJsonMeta('extra_price') @endphp
                    @if(!empty($extra_price))
                        <tr>
                            <td colspan="2" class="label-title"><strong>{{ __('Extra Prices:') }}</strong></td>
                        </tr>
                        @foreach($extra_price as $type)
                            <tr>
                                <td class="label">{{ $type['name'] }}</td>
                                <td class="val"><strong>{{ format_money($type['total'] ?? 0) }}</strong></td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        </tr> --}}
        <tr>
            <td class="label fsz21">{{ __('Total') }}</td>
            <td class="val fsz21"><strong style="color: #FA5636">{{ format_money($booking->total) }}</strong></td>
        </tr>
        <tr>
            <td class="label fsz21">{{ __('Paid') }}</td>
            <td class="val fsz21"><strong style="color: #FA5636">{{ format_money($booking->paid) }}</strong></td>
        </tr>
        @if($booking->total > $booking->paid)
            <tr>
                <td class="label fsz21">{{ __('Remaining') }}</td>
                <td class="val fsz21"><strong style="color: #FA5636">{{ format_money($booking->total - $booking->paid) }}</strong></td>
            </tr>
        @endif
    </table>
</div>
<div class="text-center mt20">
    <a href="{{ route('user.booking_history') }}" target="_blank" class="btn btn-primary manage-booking-btn">{{ __('Manage Bookings') }}</a>
</div>
