@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name') | @lang('Address')</th>
                                    <th>@lang('Mobile') | @lang('Email')</th>
                                    <th>@lang('Receivable')</th>
                                    <th>@lang('Payable')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $customer->name }}</span>
                                            <br>
                                            {{ strLimit($customer->address, 40) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold">+{{ $customer->mobile }}</span> <br> {{ $customer->email }}
                                        </td>
                                        <td>{{ $general->cur_sym . showAmount($customer->totalReceivableAmount()) }}</td>
                                        <td>{{ $general->cur_sym . showAmount($customer->totalPayableAmount()) }}</td>

                                        <td>
                                            <div class="button--group">
                                                <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn"
                                                    data-modal_title="@lang('Edit Customer')"
                                                    data-resource="{{ $customer }}">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                                @can('admin.customer.notification.log')
                                                    <a class="btn btn-sm btn-outline--warning"
                                                        href="{{ route('admin.customer.notification.log', $customer->id) }}"><i
                                                            class="la la-bell"></i>
                                                        @lang('Notify')
                                                    </a>
                                                @endcan

                                                @php
                                                    $totalReceivable = $customer->totalReceivableAmount() - abs($customer->totalPayableAmount());
                                                @endphp
                                                @can('admin.customer.payment.index')
                                                    <a href="{{ route('admin.customer.payment.index', $customer->id) }}"
                                                        @class([
                                                            'btn btn-sm btn-outline--info',
                                                            'disabled' => $totalReceivable == 0,
                                                        ])>
                                                        <i class="las la-money-bill-wave-alt"></i>@lang('Payment')
                                                    </a>
                                                @endcan
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
                @if ($customers->hasPages())
                    <div class="card-footer py-4">
                        @php echo  paginateLinks($customers) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Create Update Modal -->
    <div class="modal fade" id="cuModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form action="{{ route('admin.customer.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" name="name" class="form-control" autocomplete="off"
                                        value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Email')</label>
                                    <input type="email" class="form-control " name="email" value="{{ old('email') }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Mobile')
                                        <i class="fa fa-info-circle text--primary" title="@lang('Type the mobile number including the country code. Otherwise, SMS won\'t send to that number.')">
                                        </i>
                                    </label>
                                    <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control "
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Address')</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    @can('admin.customer.store')
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
    {{-- IMPORT MODAL --}}
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Import Customer')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form method="post" action="{{ route('admin.customer.import') }}" id="importForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="alert alert-warning p-3" role="alert">
                                <p>
                                    - @lang('Format your CSV the same way as the sample file below.') <br>
                                    - @lang('The number of columns in your CSV should be the same as the example below.')<br>
                                    - @lang('Valid fields Tip: make sure name of fields must be following: name, email, mobile, address')<br>
                                    - @lang("Required all field's, Unique Field's (email, mobile) column cell must not be empty.")<br>
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
                                    <a href="{{ asset('assets/files/sample/customer.csv') }}" title="@lang('Download csv file')"
                                        class="text--primary" download>
                                        <b>@lang('csv')</b>
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                    @can('admin.customer.import')
                        <div class="modal-footer">
                            <button type="Submit" class="btn btn--primary w-100 h-45">@lang('Import')</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    @can('admin.customer.store')
        <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Customer')">
            <i class="la la-plus"></i>@lang('Add New')
        </button>
    @endcan
    @can('admin.customer.notification.all')
        <a class="btn btn-sm btn-outline--info" href="{{ route('admin.customer.notification.all') }}"><i
                class="la la-bell"></i>
            @lang('Notification to All')
        </a>
    @endcan

    @php
        $params = request()->all();
    @endphp
    @can(['admin.customer.pdf', 'admin.customer.csv', 'admin.customer.import'])
        <div class="btn-group">
            <button type="button" class="btn btn-outline--success dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                @lang('Action')
            </button>
            <ul class="dropdown-menu">
                @can('admin.customer.pdf')
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.customer.pdf', $params) }}"><i
                                class="la la-download"></i>@lang('Export PDF')</a>
                    </li>
                @endcan
                @can('admin.customer.pdf')
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.customer.csv', $params) }}"><i
                                class="la la-download"></i>@lang('Export CSV')</a>
                    </li>
                @endcan
                @can('admin.customer.import')
                    <li>
                        <a class="dropdown-item importBtn" href="javascript:void(0)">
                            <i class="las la-cloud-upload-alt"></i> @lang('Import CSV')</a>
                    </li>
                @endcan
            </ul>
        </div>
    @endcan
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"
            $(".importBtn").on('click', function(e) {
                let importModal = $("#importModal");
                importModal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
