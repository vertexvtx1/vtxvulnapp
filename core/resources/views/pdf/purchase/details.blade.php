@extends('pdf.layouts.master')

@section('main-content')
    <div class="list--row mb-15px">
        <div class="float-left">
            <h6 class="title">@lang('Supplier Info')</h6>
            <p class="mb-5px">@lang('Name'): {{ $supplier->name }}</p>
            <p class="mb-5px">@lang('Mobile'): {{ $supplier->mobile }}</p>
            <p class="mb-5px">@lang('Email'): {{ $supplier->email }}</p>
        </div>

        <div class="float-right">
            <h6>@lang('Company'): {{ $supplier->company_name }}</h6>
            <p class="mb-5px">@lang('Invoice No.'): #<b>{{ $purchase->invoice_no }}</b></p>
            <p class="mb-5px">@lang('Date'): {{ showDateTime($purchase->purchase_date, 'd F Y') }}</p>
            <p class="mb-5px">@lang('Warehouse'): {{ $purchase->warehouse->name }}</p>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>@lang('S.N.')</th>
                <th>@lang('Name')</th>
                <th>@lang('SKU')</th>
                <th>@lang('Quantity')</th>
                <th>@lang('Unit Price')</th>
                <th>@lang('Total')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->purchaseDetails as $value)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $value->product->name }}</td>
                    <td>{{ $value->product->sku }} </td>
                    <td>{{ $value->quantity . ' ' . $value->product->unit->name }} </td>
                    <td>{{ $general->cur_sym . showAmount($value->price) }}</td>
                    <td>{{ $general->cur_sym . showAmount($value->total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="list--row mb-15px mt-3">

        <div class="float-right border list--row summary-content">
            <div class="border-bottom clearfix">
                <p class="float-left">@lang('Subtotal')</p>
                <p class="float-right">{{ $general->cur_sym . showAmount($purchase->total_price) }}</p>
            </div>

            <div class="border-bottom clearfix">
                <p class="float-left">@lang('Discount')</p>
                <p class="float-right">{{ $general->cur_sym . showAmount($purchase->discount_amount) }}</p>
            </div>

            <div class="border-bottom clearfix">
                <p class="float-left">@lang('Grand Total')</p>
                <p class="float-right">{{ $general->cur_sym . showAmount($purchase->payable_amount) }}</p>
            </div>

            <div class="border-bottom clearfix">
                <p class="float-left">
                    @lang('Paid')
                </p>
                <p class="float-right">{{ $general->cur_sym . showAmount($purchase->paid_amount) }}</p>
            </div>

            <div class="clearfix">
                <p class="float-left">
                    @if ($purchase->due_amount >= 0)
                        @lang('Payable')
                    @else
                        @lang('Receivable')
                    @endif
                </p>
                <p class="float-right strong">{{ $general->cur_sym . showAmount(abs($purchase->due_amount)) }}</p>
            </div>
        </div>
    </div>
@endsection
