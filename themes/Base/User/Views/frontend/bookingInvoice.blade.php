@extends('Layout::empty')

@push('css')
    <style type="text/css">
        html, body {
            background: #f4f4f9;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', Arial, sans-serif;
        }
        .bravo_topbar, .bravo_header, .bravo_footer {
            display: none;
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
            max-width: 180px;
        }
        .invoice-header h2 {
            font-size: 24px;
            font-weight: bold;
            color: #ff9800;
        }
        .invoice-header .invoice-info {
            text-align: right;
            color: #757575;
        }
        .card {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .card h5 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
        .card p {
            font-size: 16px;
            color: #757575;
            margin: 5px 0;
        }
        .row {
            display: flex;
            gap: 15px;
        }
        .col {
            flex: 1;
        }
        .invoice-amount {
            text-align: center;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 15px;
        }
        .invoice-amount .label {
            font-size: 14px;
            color: #9e9e9e;
        }
        .invoice-amount .amount {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
        }
        hr {
            border: 0;
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }
        .customer-info h5 {
            font-size: 18px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 10px;
        }
        .customer-info p {
            font-size: 16px;
            color: #757575;
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
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <div id="invoice-print-zone">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div>
                @if(!empty($logo = setting_item('logo_invoice_id') ?? setting_item('logo_id')))
                    <img src="{{get_file_url($logo, 'full')}}" alt="{{setting_item('site_title')}}">
                @endif
            </div>
            <div class="invoice-info">
                <h2>{{__("INVOICE")}}</h2>
                <p>{{__('Invoice #: :number', ['number' => $booking->id])}}</p>
                <p>{{__('Created: :date', ['date' => display_date($booking->created_at)])}}</p>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="row">
            <div class="card col">
                <h5>{{__('Company Information')}}</h5>
                {!! nl2br(setting_item('invoice_company')) !!}
            </div>
            <div class="card col">
                <h5>{{__('Amount Due')}}</h5>
                <div class="invoice-amount">
                    <div class="label">{{__("Amount due:")}}</div>
                    <div class="amount">{{format_money($booking->total - $booking->paid)}}</div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <hr>
        <div class="customer-info">
            <h5>{{__('Billing to:')}}</h5>
            <p>{{$booking->first_name}} {{$booking->last_name}}</p>
            <p>{{$booking->email}}</p>
            <p>{{$booking->phone}}</p>
            <p>{{$booking->address}}</p>
            <p>{{implode(', ', [$booking->city, $booking->state, $booking->zip_code, get_country_name($booking->country)])}}</p>
        </div>

        <!-- Booking Details -->
        <hr>
        @if(!empty($service->email_new_booking_file))
            <div class="email_new_booking">
                @include($service->email_new_booking_file ?? '')
            </div>
        @endif
    </div>

    <!-- Print Button -->
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">{{__("Print Invoice")}}</button>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset("module/user/js/user.js") }}"></script>
@endpush
