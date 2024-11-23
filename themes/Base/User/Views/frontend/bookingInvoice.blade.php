@extends('Layout::empty')

@push('css')
    <style type="text/css">
            html, body {
            background: #f0f0f0;
        }
        .bravo_topbar, .bravo_header, .bravo_footer {
            display: none;
        }
        .invoice-amount {
            margin-top: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 20px;
            display: inline-block;
            text-align: center;
        }
        .email_new_booking .b-table {
            width: 100%;
        }
        .email_new_booking .val {
            text-align: right;
        }
        .email_new_booking td,
        .email_new_booking th {
            padding: 5px;
        }
        .email_new_booking .val table {
            text-align: left;
        }
        .email_new_booking .b-panel-title,
        .email_new_booking .booking-number,
        .email_new_booking .booking-status,
        .email_new_booking .manage-booking-btn {
            display: none;
        }
        .email_new_booking .fsz21 {
            font-size: 21px;
        }
        .table-service-head {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .table-service-head th {
            padding: 5px 15px;
        }
        #invoice-print-zone {
            background: white;
            padding: 15px;
            margin: 90px auto 40px auto;
            max-width: 1025px;
        }
        .invoice-company-info{
            margin-top: 15px;
        }
        .invoice-company-info p{
            margin-bottom: 2px;
            font-weight: normal;
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


        invoice-table-header th,
        invoice-table-header td {
            padding: 10px;
            border: 1px solid #cccccc;
            vertical-align: top;
        }

        invoice-table-header tr td:first-child {
            border-left: none;
            width: 30%;
        }

        invoice-table-header tr td:last-child {
            border-right: none;
            width: 30%;
        }

        invoice-table-header tr td strong {
            display: block;
            margin-bottom: 15px;
        }

        invoice-table-header tr td h5 {
            margin-bottom: 0;
        }

        invoice-table-header tr td p {
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

    </style>
@endpush

@section('content')
    <div id="invoice-print-zone">
        <div class="invoice-header">
            <div class="invoice-info">
                <h2>{{__("INVOICE")}}</h2>
                <p><strong>{{__('Invoice #:')}}</strong> {{$booking->id}}</p>
            </div>
            <div>
                @if(!empty($logo = setting_item('logo_invoice_id') ?? setting_item('logo_id')))
                    <img src="{{get_file_url($logo, 'full')}}" alt="{{setting_item('site_title')}}">
                @endif
            </div>
        </div>

        <table class="invoice-table-header">
            <tr>
                <td>
                    <strong>{{__('Dates:')}}</strong>
                    <h5>{{__('Issued On:')}}</h5>
                    <p>{{display_date($booking->created_at)}}</p>
                    <h5>{{__('Due By:')}}</h5>
                    <p>{{display_date($booking->end_date)}}</p>
                </td>
                <td>
                    <strong>{{__('Billed From:')}}</strong>
                    {!! setting_item_with_lang("invoice_company_info") !!}
                    <p>{{setting_item('invoice_company_phone', '+254 762 301 302')}}</p>
                </td>
                <td>
                    <strong>{{__('Billed To:')}}</strong>
                    <p>{{$booking->first_name}} {{$booking->last_name}}</p>
                    <p>{{$booking->email}}</p>
                    <p>{{$booking->phone}}</p>
                    <p>{{$booking->address}}</p>
                    <p>{{implode(', ', [$booking->city, $booking->state, $booking->zip_code, get_country_name($booking->country)])}}</p>
                </td>
            </tr>
        </table>

        <hr>
        @if(!empty($service->email_new_booking_file))
            <div class="email_new_booking">
                @include($service->email_new_booking_file ?? '')
            </div>
        @endif
        <div>
            <p><strong>{{__('Note:')}}</strong> {{__('Thank you for choosing Harmostays! If you have any questions about this invoice, please contact us at')}} <a href="mailto:info@harmostays.com">info@harmostays.com</a>.</p>
        </div>
    </div>

    <!-- Print Button -->
    <div class="text-center mt20">
        <button onclick="window.print()">{{__("Print Invoice")}}</button>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset("module/user/js/user.js") }}"></script>
@endpush
