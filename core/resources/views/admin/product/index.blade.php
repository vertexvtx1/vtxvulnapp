@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Image')</th>
                                    <th>@lang('Name') | @lang('SKU') </th>
                                    <th>@lang('Category') | @lang('Brand')</th>
                                    <th>@lang('Stock') </th>
                                    <th>@lang('Total Sale') | @lang('Alert Qty')</th>
                                    <th>@lang('Unit')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <img
                                                src="{{ getImage(getFilePath('product') . '/' . $product->image, getFileSize('product')) }}">
                                        </td>

                                        <td class="long-text">
                                            <span class="fw-bold text--primary"><?php echo $product->name ?></span>
                                            <br>
                                            <span class="text--small ">{{ $product->sku }} </span>
                                        </td>

                                        <td>
                                            {{ __($product->category->name) }}
                                            <br>
                                            <span class="text--primary">{{ $product->brand->name }}</span>
                                        </td>

                                        <td>
                                            {{ $product->totalInStock() }}
                                        </td>

                                        <td>
                                            {{ $product->totalSale() }}
                                            <br>
                                            <span class="badge badge--warning">{{ $product->alert_quantity }}</span>
                                        </td>

                                        <td> {{ $product->unit->name }}</td>

                                        <td>
                                            @can('admin.product.edit')
                                                <div class="button--group">
                                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                                        class="btn btn-sm btn-outline--primary ms-1 editBtn"><i
                                                            class="las la-pen"></i> @lang('Edit')</a>
                                                </div>
                                            @endcan
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
                @if ($products->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($products) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

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

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Name or SKU" />
    @can('admin.product.create')
        <a href="{{ route('admin.product.create') }}" class="btn btn-outline--primary">
            <i class="la la-plus"></i>@lang('Add New')
        </a>
    @endcan
    @php
        $params = request()->all();
    @endphp

    @can(['admin.product.import', 'admin.product.pdf', 'admin.product.csv'])
        <div class="btn-group">
            <button type="button" class="btn btn-outline--success dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                @lang('Action')
            </button>
            <ul class="dropdown-menu">
                @can('admin.product.pdf')
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.product.pdf', $params) }}"><i
                                class="la la-download"></i>@lang('Export PDF')</a>
                    </li>
                @endcan
                @can('admin.product.csv')
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.product.csv') }}"><i
                                class="la la-download"></i>@lang('Export CSV')</a>
                    </li>
                @endcan
                @can('admin.product.import')
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
