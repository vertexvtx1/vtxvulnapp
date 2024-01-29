@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg--transparent">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two bg--white">
                            <thead>
                                <tr>
                                    <th>@lang('Invoice No.') | @lang('Date')</th>
                                    <th>@lang('Supplier') | @lang('Mobile')</th>
                                    <th>@lang('Warehouse') | @lang('Total Amount')</th>
                                    <th>@lang('Lessed') | @lang('Receivable') </th>
                                    <th>@lang('Received') | @lang('Due')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($purchaseReturn as $return)
                                    <tr>
                                        <td>
                                            <span class="fw-bold text--primary">{{ $return->purchase->invoice_no }}</span>
                                            <br>
                                            <small>{{ showDateTime($return->return_date, 'd M, Y') }}</small>
                                        </td>

                                        <td>
                                            <span class="fw-bold">
                                                {{ $return->purchase->supplier->name }}</span>
                                            <br>
                                            +{{ $return->purchase->supplier->mobile }}
                                        </td>

                                        <td>
                                            {{ $return->purchase->warehouse->name }}
                                            <br>
                                            <span
                                                class="fw-bold">{{ $general->cur_sym . showAmount($return->total_price) }}</span>
                                        </td>

                                        <td>
                                            {{ $general->cur_sym . showAmount($return->discount_amount) }}
                                            <br>
                                            <span
                                                class="fw-bold">{{ $general->cur_sym . showAmount($return->receivable_amount) }}</span>
                                        </td>

                                        <td>
                                            {{ $general->cur_sym . showAmount($return->received_amount) }}
                                            <br>

                                            @if ($return->due_amount < 0)
                                                <span class="text--danger fw-bold" title="@lang('Payable to Supplier')">
                                                    - {{ $general->cur_sym . showAmount(abs($return->due_amount)) }}
                                                </span>
                                            @else
                                                <span class="fw-bold" title="@lang('Receivable from Supplier')">
                                                    {{ $general->cur_sym . showAmount($return->due_amount) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                @can('admin.purchase.return.edit')
                                                <a href="{{ route('admin.purchase.return.edit', $return->id) }}"
                                                    class="btn btn-sm btn-outline--primary ms-1 editBtn"><i
                                                        class="las la-pen"></i> @lang('Edit')
                                                </a>
                                                @endcan

                                                <button type="button"
                                                    class="btn btn-sm btn-outline--info ms-1 dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="la la-ellipsis-v"></i>@lang('More')
                                                </button>

                                                <div class="dropdown-menu">
                                                    @can('admin.supplier.payment.receive.store')
                                                        @if ($return->due_amount != 0)
                                                            <a href="javascript:void(0)" class="dropdown-item paymentModalBtn"
                                                                data-supplier="{{ $return->supplier->name }}"
                                                                data-invoice="{{ $return->purchase->invoice_no }}"
                                                                data-id="{{ $return->id }}"
                                                                data-due_amount="{{ $return->due_amount }}">
                                                                @if ($return->due_amount < 0)
                                                                    <i class="la la-hand-holding-usd"></i>
                                                                    @lang('Give Payment')
                                                                @elseif($return->due_amount > 0)
                                                                    <i class="la la-money-bill-wave"></i>
                                                                    @lang('Receive Payment')
                                                                @endif
                                                            </a>
                                                        @endif
                                                    @endcan
                                                    @can('admin.purchase.return.invoice.pdf')
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.purchase.return.invoice.pdf', $return->id) }}/?print=true">
                                                                <i class="la la-download"></i> @lang('Download Details')
                                                            </a>
                                                        </li>
                                                    @endcan
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg--white">
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
            @if ($purchaseReturn->hasPages())
                <div class="card-footer py-4 bg--white">
                    @php echo  paginateLinks($purchaseReturn) @endphp
                </div>
            @endif
        </div>
    </div>

    <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                    </h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label> @lang('Invoice No.')</label>
                            <input type="text" class="form-control invoice_no" readonly>
                        </div>
                        <div class="form-group">
                            <label> @lang('Supplier')</label>
                            <input type="text" class="form-control supplier-name" readonly>
                        </div>
                        <div class="form-group">
                            <label class="amountType"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text">{{ $general->cur_sym }}</button>
                                <input type="text" class="form-control receivable_amount" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="payment-type"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text">{{ $general->cur_sym }}</button>
                                <input type="number" step="any" name="amount" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
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
    @php
        $params = request()->all();
    @endphp
    @can(['admin.purchase.return*'])
        @can('admin.purchase.pdf')
            <a class="btn btn-outline--dark" href="{{ route('admin.purchase.return.pdf', $params) }}"><i
                    class="la la-download"></i>@lang('PDF')</a>
        @endcan
        @can('admin.purchase.csv')
            <a class="btn btn-outline--info" href="{{ route('admin.purchase.return.csv', $params) }}"><i
                    class="la la-download"></i>@lang('CSV')</a>
        @endcan
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
                let payingReceivingLabel = modal.find('.payment-type')

                if (parseFloat(data.due_amount).toFixed(2) > 0) {
                    amountTypeLabel.text(`@lang('Receivable amount')`);
                    payingReceivingLabel.text(`@lang('Receiving amount')`);
                    modal.find('.modal-title').text(`Receive Payment`);
                } else {
                    amountTypeLabel.text(`@lang('Payable amount')`);
                    payingReceivingLabel.text(`@lang('Paying amount')`);
                    modal.find('.modal-title').text(`Give Payment`);
                }

                modal.find('.receivable_amount').val(`${due}`);
                modal.find('.supplier-name').val(`${data.supplier}`);
                modal.find('.invoice_no').val(`${data.invoice}`);
                let form = modal.find('form')[0];
                form.action = `{{ route('admin.supplier.payment.receive.store', '') }}/${data.id}`;
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
