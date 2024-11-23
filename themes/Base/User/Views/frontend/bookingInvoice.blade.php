@extends('Layout::empty')

@push('css')
    <style type="text/css">
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
        invoice-table-header table td {
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

        <div class="invoice-table-header">
            <table>
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
        </div>
        <hr>
        @if(!empty($service->email_new_booking_file))
            <div class="email_new_booking">
                @include($service->email_new_booking_file ?? '')
            </div>
        @endif
        <div>
            <p><strong>{{__('Thank you for booking with Harmo Stays!')}}</strong></p>
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
