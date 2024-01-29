@extends('admin.layouts.app')
@section('panel')
    @if (@json_decode($general->system_info)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title">@lang('New Version Available') <button class="btn btn--dark float-end">@lang('Version')
                                {{ json_decode($general->system_info)->version }}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <p>
                            <pre class="f-size--24">{{ json_decode($general->system_info)->details }}</pre>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (@json_decode($general->system_info)->message)
        <div class="row">
            @foreach(json_decode($general->system_info)->message as $msg)
            <div class="col-md-12">
                <div class="alert border border--primary" role="alert">
                    <div class="alert__icon bg--primary">
                        <i class="far fa-bell"></i></div>
                        <p class="alert__message">@php echo $msg; @endphp</p>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @endif

    <div class="row gy-4 mb-30">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.sale.index') }}" icon="las la-shopping-cart" icon_style="false"
                title="Sales" value="{{ $general->cur_sym }}{{ showAmount($widget['total_sale']) }}" color="primary" />
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.sale.return.index') }}" icon="las la-undo" icon_style="false"
                title="Sales Return" value="{{ $general->cur_sym }}{{ showAmount($widget['total_sale_return']) }}"
                color="warning" />
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.purchase.index') }}" icon="las la-shopping-bag"
                icon_style="false" title="Purchases"
                value="{{ $general->cur_sym }}{{ showAmount($widget['total_purchase']) }}" color="success" />
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.purchase.return.index') }}" icon="las la-share"
                icon_style="false" title="Purchases Return"
                value="{{ $general->cur_sym }}{{ showAmount($widget['total_purchase_return']) }}" color="danger" />
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

    <div class="row gy-4 mb-30">
        <div class="col-xxl-7">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5>@lang('Monthly Purchase & Sales Report') (@lang('Last 12 Month'))</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="apex-bar-chart"> </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5>@lang('Top Selling Products')</h5>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Product')</th>
                                    <th>@lang('SKU')</th>
                                    <th>@lang('Quantity')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topSellingProducts as $product)
                                    <tr>

                                        <td data-label="@lang('Product')">
                                            {{ $loop->iteration }}. &nbsp;
                                            <a class="text--dark"
                                                href="{{ route('admin.product.edit', $product->id) }}">{{ strLimit(__($product->name), 20) }}</a>
                                        </td>
                                        <td data-label="@lang('Quantity')">{{ $product->sku }} </td>
                                        <td data-label="@lang('Quantity')">{{ $product->total_sale }}
                                            {{ $product->unit->name }} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4 mb-30">
        <div class="col-xl-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5>@lang('Product Alert Items') </h5>
                <a href="{{ route('admin.product.alert') }}" class="btn btn-sm btn-outline--primary">@lang('View All')</a>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Product')</th>
                                    <th>@lang('Warehouse')</th>
                                    <th>@lang('Alert')</th>
                                    <th>@lang('Stock')</th>
                                    <th>@lang('Unit')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($widget['alertProductsQty'] as $alertQty)
                                    <tr>
                                        <td class="fw-bold"> {{ $alertQty->name }} </td>
                                        <td> {{ $alertQty->warehouse_name }} </td>
                                        <td>
                                            <span class="bg--warning px-2 rounded">
                                                {{ $alertQty->alert_quantity }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="bg--danger px-2 rounded">
                                                {{ $alertQty->quantity }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $alertQty->unit_name }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5>@lang('Latest Sale Returns') </h5>
                <a href="{{ route('admin.sale.return.index') }}"
                    class="btn btn-sm btn-outline--primary">@lang('View All')</a>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Invoice No.') </th>
                                    <th>@lang('Customer')</th>
                                    <th>@lang('Amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($saleReturns as $return)
                                    <tr>
                                        <td>
                                            {{ showDateTime($return->return_date, 'd M, Y') }}
                                        </td>

                                        <td>
                                            <a class="text--dark"
                                                href="{{ route('admin.sale.return.edit', $return->id) }}">{{ $return->sale->invoice_no }}</a>
                                        </td>

                                        <td>
                                            {{ $return->customer->name }}
                                        </td>

                                        <td>
                                            {{ $general->cur_sym . showAmount($return->payable_amount) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.product.category.index') }}" icon="lab la-buffer"
                title="Categories" value="{{ $widget['total_category'] }}" bg="1" />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.product.index') }}" icon="lab la-product-hunt"
                title="Products" value="{{ $widget['total_product'] }}" bg="primary" />
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.supplier.index') }}" icon="las la-user-friends"
                title="Suppliers" value="{{ $widget['total_supplier'] }}" bg="18" />
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.customer.index') }}" icon="las la-users" title="Customers"
                value="{{ $widget['total_customers'] }}" bg="19" />
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

@endsection

@push('style')
    <style>
        .widget-two__btn {
            right: 15px !important;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>

    <script>
        "use strict";
        window.onload = function() {

            var options = {
                series: [{
                        name: 'Total Purchase',
                        data: @json($purchaseData)
                    },
                    {
                        name: 'Total Purchase Return',
                        data: @json($purchaseReturnData)
                    },
                    {
                        name: 'Total Sale',
                        data: @json($saleData)
                    },
                    {
                        name: 'Total Sale Return',
                        data: @json($saleReturnData)
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 417,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($months)
                },
                yaxis: {
                    title: {
                        text: "{{ $general->cur_text }}",
                        style: {
                            color: '#7c97bb'
                        }
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                fill: {
                    colors: ['#008ffb', '#fbb225', '#00e396', '#ea5455'],
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return `{{ $general->cur_sym }} ${val}`
                        }
                    }
                },
                legend: {
                    markers: {
                        width: 12,
                        height: 12,
                        strokeWidth: 0,
                        strokeColor: '#fff',
                        fillColors: ['#008ffb', '#fbb225', '#00e396', '#ea5455'],
                        radius: 12,
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
            chart.render();
        }
    </script>
@endpush
