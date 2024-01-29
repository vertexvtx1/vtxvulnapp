@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg--transparent">
                <div class="card-body p-0 ">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two bg--white">
                            <thead>
                                <tr>
                                    <th>@lang('Invoice No.') | @lang('Date')</th>
                                    <th>@lang('Supplier') | @lang('Mobile')</th>
                                    <th>@lang('Total Amount') | @lang('Warehouse')</th>
                                    <th>@lang('Discount') | @lang('Payable') </th>
                                    <th>@lang('Paid') | @lang('Due')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchases as $purchase)
                                    <tr>
                                        <td>
                                            @if ($purchase->return_status == 1)
                                                <small><i class="fa fa-circle text--danger" title="@lang('Returned')"
                                                        aria-hidden="true"></i></small>
                                            @endif
                                            <span class="fw-bold">
                                                {{ $purchase->invoice_no }}
                                            </span>
                                            <br>
                                            <small>{{ showDateTime($purchase->purchase_date, 'd M, Y') }}</small>
                                        </td>

                                        <td>
                                            <span class="text--primary fw-bold"> {{ $purchase->supplier->name }}</span>
                                            <br>
                                            +{{ $purchase->supplier->mobile }}
                                        </td>

                                        <td>
                                            <span
                                                class="fw-bold">{{ $general->cur_sym . showAmount($purchase->total_price) }}</span>
                                            <br>
                                            {{ $purchase->warehouse->name }}
                                        </td>
                                        <td>
                                            {{ $general->cur_sym . showAmount($purchase->discount_amount) }}
                                            <br>
                                            <span
                                                class="fw-bold">{{ $general->cur_sym . showAmount($purchase->payable_amount) }}</span>
                                        </td>
                                        <td>
                                            {{ $general->cur_sym . showAmount($purchase->paid_amount) }}

                                            <br>

                                            @if ($purchase->due_amount < 0)
                                                <span class="text--danger fw-bold" title="@lang('Receivable from Supplier')">
                                                    - {{ $general->cur_sym . showAmount(abs($purchase->due_amount)) }}
                                                </span>
                                            @else
                                                <span class="fw-bold" title="@lang('Payable to Supplier')">
                                                    {{ $general->cur_sym . showAmount($purchase->due_amount) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                @can('admin.purchase.edit')
                                                    <a href="{{ route('admin.purchase.edit', $purchase->id) }}"
                                                        class="btn btn-sm btn-outline--primary ms-1 editBtn">
                                                        <i class="la la-pen"></i> @lang('Edit')
                                                    </a>
                                                @endcan
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--info ms-1 dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="la la-ellipsis-v"></i>@lang('More')
                                                </button>

                                                <div class="dropdown-menu">
                                                    @can('admin.supplier.payment.store')
                                                        <a href="javascript:void(0)" class="dropdown-item paymentModalBtn"
                                                            data-supplier="{{ $purchase->supplier->name }}"
                                                            data-invoice="{{ $purchase->invoice_no }}"
                                                            data-id="{{ $purchase->id }}"
                                                            data-due_amount="{{ $purchase->due_amount }}">
                                                            @if ($purchase->due_amount < 0)
                                                                <i class="la la-hand-holding-usd"></i>
                                                                @lang('Receive Payment')
                                                            @elseif($purchase->due_amount > 0)
                                                                <i class="la la-money-bill-wave"></i>
                                                                @lang('Give Payment')
                                                            @endif
                                                        </a>
                                                    @endcan

                                                    @can('admin.purchase.return.items')
                                                        @if ($purchase->return_status == 0 && $purchase->due_amount > 0)
                                                            <li>
                                                                <a href="{{ route('admin.purchase.return.items', $purchase->id) }}"
                                                                    class="dropdown-item editBtn">
                                                                    <i class="la la-undo"></i> @lang('Return Purchase')
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endcan
                                                    @can('admin.purchase.return.edit')
                                                        @if ($purchase->return_status)
                                                            <li>
                                                                <a href="{{ route('admin.purchase.return.edit', $purchase->purchaseReturn->id) }}"
                                                                    class="dropdown-item editBtn">
                                                                    <i class="la la-undo"></i> @lang('View Return Details')
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endcan
                                                    @can('admin.purchase.invoice.pdf')
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.purchase.invoice.pdf', $purchase->id) }}">
                                                                <i class="la la-download"></i> @lang('Download Details')
                                                            </a>
                                                        </li>
                                                    @endcan
                                                </div>
                                            </div>
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
                @if ($purchases->hasPages())
                    <div class="card-footer py-4">
                        @php echo  paginateLinks($purchases) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <!-- Start Payment Modal  -->
    <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Payment')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label> @lang('Invoice No.')</label>
                            <input type="text" class="form-control invoice-no" readonly>
                        </div>
                        <div class="form-group">
                            <label> @lang('Supplier')</label>
                            <input type="text" class="form-control supplier-name" readonly>
                        </div>

                        <div class="form-group">
                            <label class="amountType"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text">{{ $general->cur_sym }}</button>
                                <input type="text" class="form-control payable_amount" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="payingReceiving"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text">{{ $general->cur_sym }}</button>
                                <input type="number" step="any" name="amount" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100 permit">@lang('Submit')</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Start Payment Modal  -->
    <!-- IMPORT MODAL -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Import Product')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form method="post" action="{{ route('admin.product.import') }}" id="importForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="alert alert-warning p-3" role="alert">
                                <p>
                                    - @lang('Format your CSV the same way as the sample file below.') <br>
                                    - @lang('The number of columns in your CSV should be the same as the example below.')<br>
                                    - @lang('Valid fields Tip: make sure name of fields must be following: name, category, sku, brand, unit,alert_quantity and note.')<br>
                                    - @lang("Required field's (name, category, sku, brand, unit,alert_quantity), Unique Field's (name, sku) column cell must not be empty.")<br>
                                    - @lang('When an error occurs download the error file and correct the incorrect cells and import that file again through format.')<br>
                                    - @lang('Recommendation for importing huge data, you have to increase your server execution time and memory limit.')<br>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">@lang('Select File')</label>
                            <input type="file" class="form-control" name="file" accept=".csv" required>
                            <div class="mt-1">
                                <small class="d-block">
                                    @lang('Supported files:') <b class="fw-bold">@lang('csv')</b>
                                </small>
                                <small>
                                    @lang('Download sample template file from here')
                                    <a href="{{ asset('assets/files/sample/product.csv') }}" title="@lang('Download csv file')"
                                        class="text--primary" download>
                                        <b>@lang('csv')</b>
                                    </a>

                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="Submit" class="btn btn--primary w-100 h-45">@lang('Import')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .table-responsive {
            min-height: 400px;
            background: transparent
        }

        .card {
            box-shadow: none;
        }
    </style>
@endpush

@push('breadcrumb-plugins')
    <x-search-form dateSearch='yes' />
    @can('admin.purchase.new')
        <a href="{{ route('admin.purchase.new') }}" class="btn btn-outline--primary h-45">
            <i class="la la-plus"></i>@lang('Add New')
        </a>
    @endcan
    @php
        $params = request()->all();
    @endphp
    @can('admin.purchase.pdf')
        <a class="btn btn-outline--dark" href="{{ route('admin.purchase.pdf', $params) }}"><i
                class="la la-download"></i>@lang('PDF')</a>
    @endcan
    @can('admin.purchase.csv')
        <a class="btn btn-outline--info" href="{{ route('admin.purchase.csv', $params) }}"><i
                class="la la-download"></i>@lang('CSV')</a>
    @endcan

@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.paymentModalBtn', function() {
                var modal = $('#paymentModal');
                let data = $(this).data();
                var due = parseFloat(Math.abs(data.due_amount)).toFixed(2);

                let amountTypeLabel = modal.find('.amountType')
                let payingReceivingLabel = modal.find('.payingReceiving')


                if (parseFloat(data.due_amount).toFixed(2) > 0) {
                    amountTypeLabel.text(`@lang('Payable Amount')`);
                    payingReceivingLabel.text(`@lang('Paying Amount')`);
                } else {
                    amountTypeLabel.text(`@lang('Receivable Amount')`);
                    payingReceivingLabel.text(`@lang('Receiving Amount')`);
                }
                modal.find('.payable_amount').val(`${due}`);
                modal.find('.supplier-name').val(`${data.supplier}`);
                modal.find('.invoice-no').val(`${data.invoice}`);
                let form = modal.find('form')[0];
                form.action = `{{ route('admin.supplier.payment.store', '') }}/${data.id}`
                modal.modal('show');
            });

            //Import-Modal
            $(".importBtn").on('click', function(e) {
                let importModal = $("#importModal");
                importModal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
