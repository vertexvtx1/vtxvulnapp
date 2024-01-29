<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg--transparent">
                <div class="card-body p-0 ">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two bg--white">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Invoice No.'); ?> | <?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Supplier'); ?> | <?php echo app('translator')->get('Mobile'); ?></th>
                                    <th><?php echo app('translator')->get('Total Amount'); ?> | <?php echo app('translator')->get('Warehouse'); ?></th>
                                    <th><?php echo app('translator')->get('Discount'); ?> | <?php echo app('translator')->get('Payable'); ?> </th>
                                    <th><?php echo app('translator')->get('Paid'); ?> | <?php echo app('translator')->get('Due'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <?php if($purchase->return_status == 1): ?>
                                                <small><i class="fa fa-circle text--danger" title="<?php echo app('translator')->get('Returned'); ?>"
                                                        aria-hidden="true"></i></small>
                                            <?php endif; ?>
                                            <span class="fw-bold">
                                                <?php echo e($purchase->invoice_no); ?>

                                            </span>
                                            <br>
                                            <small><?php echo e(showDateTime($purchase->purchase_date, 'd M, Y')); ?></small>
                                        </td>

                                        <td>
                                            <span class="text--primary fw-bold"> <?php echo e($purchase->supplier->name); ?></span>
                                            <br>
                                            +<?php echo e($purchase->supplier->mobile); ?>

                                        </td>

                                        <td>
                                            <span
                                                class="fw-bold"><?php echo e($general->cur_sym . showAmount($purchase->total_price)); ?></span>
                                            <br>
                                            <?php echo e($purchase->warehouse->name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($general->cur_sym . showAmount($purchase->discount_amount)); ?>

                                            <br>
                                            <span
                                                class="fw-bold"><?php echo e($general->cur_sym . showAmount($purchase->payable_amount)); ?></span>
                                        </td>
                                        <td>
                                            <?php echo e($general->cur_sym . showAmount($purchase->paid_amount)); ?>


                                            <br>

                                            <?php if($purchase->due_amount < 0): ?>
                                                <span class="text--danger fw-bold" title="<?php echo app('translator')->get('Receivable from Supplier'); ?>">
                                                    - <?php echo e($general->cur_sym . showAmount(abs($purchase->due_amount))); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="fw-bold" title="<?php echo app('translator')->get('Payable to Supplier'); ?>">
                                                    <?php echo e($general->cur_sym . showAmount($purchase->due_amount)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <a href="<?php echo e(route('admin.purchase.edit', $purchase->id)); ?>"
                                                        class="btn btn-sm btn-outline--primary ms-1 editBtn">
                                                        <i class="la la-pen"></i> <?php echo app('translator')->get('Edit'); ?>
                                                    </a>
                                                <?php endif ?>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--info ms-1 dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="la la-ellipsis-v"></i><?php echo app('translator')->get('More'); ?>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.payment.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <a href="javascript:void(0)" class="dropdown-item paymentModalBtn"
                                                            data-supplier="<?php echo e($purchase->supplier->name); ?>"
                                                            data-invoice="<?php echo e($purchase->invoice_no); ?>"
                                                            data-id="<?php echo e($purchase->id); ?>"
                                                            data-due_amount="<?php echo e($purchase->due_amount); ?>">
                                                            <?php if($purchase->due_amount < 0): ?>
                                                                <i class="la la-hand-holding-usd"></i>
                                                                <?php echo app('translator')->get('Receive Payment'); ?>
                                                            <?php elseif($purchase->due_amount > 0): ?>
                                                                <i class="la la-money-bill-wave"></i>
                                                                <?php echo app('translator')->get('Give Payment'); ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    <?php endif ?>

                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.return.items')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <?php if($purchase->return_status == 0 && $purchase->due_amount > 0): ?>
                                                            <li>
                                                                <a href="<?php echo e(route('admin.purchase.return.items', $purchase->id)); ?>"
                                                                    class="dropdown-item editBtn">
                                                                    <i class="la la-undo"></i> <?php echo app('translator')->get('Return Purchase'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif ?>
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.return.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <?php if($purchase->return_status): ?>
                                                            <li>
                                                                <a href="<?php echo e(route('admin.purchase.return.edit', $purchase->purchaseReturn->id)); ?>"
                                                                    class="dropdown-item editBtn">
                                                                    <i class="la la-undo"></i> <?php echo app('translator')->get('View Return Details'); ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif ?>
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.invoice.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('admin.purchase.invoice.pdf', $purchase->id)); ?>">
                                                                <i class="la la-download"></i> <?php echo app('translator')->get('Download Details'); ?>
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <?php if($purchases->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo  paginateLinks($purchases) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

    <!-- Start Payment Modal  -->
    <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Payment'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-body">
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Invoice No.'); ?></label>
                            <input type="text" class="form-control invoice-no" readonly>
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Supplier'); ?></label>
                            <input type="text" class="form-control supplier-name" readonly>
                        </div>

                        <div class="form-group">
                            <label class="amountType"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text"><?php echo e($general->cur_sym); ?></button>
                                <input type="text" class="form-control payable_amount" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="payingReceiving"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text"><?php echo e($general->cur_sym); ?></button>
                                <input type="number" step="any" name="amount" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100 permit"><?php echo app('translator')->get('Submit'); ?></button>
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
                    <h4 class="modal-title"><?php echo app('translator')->get('Import Product'); ?></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form method="post" action="<?php echo e(route('admin.product.import')); ?>" id="importForm"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="alert alert-warning p-3" role="alert">
                                <p>
                                    - <?php echo app('translator')->get('Format your CSV the same way as the sample file below.'); ?> <br>
                                    - <?php echo app('translator')->get('The number of columns in your CSV should be the same as the example below.'); ?><br>
                                    - <?php echo app('translator')->get('Valid fields Tip: make sure name of fields must be following: name, category, sku, brand, unit,alert_quantity and note.'); ?><br>
                                    - <?php echo app('translator')->get("Required field's (name, category, sku, brand, unit,alert_quantity), Unique Field's (name, sku) column cell must not be empty."); ?><br>
                                    - <?php echo app('translator')->get('When an error occurs download the error file and correct the incorrect cells and import that file again through format.'); ?><br>
                                    - <?php echo app('translator')->get('Recommendation for importing huge data, you have to increase your server execution time and memory limit.'); ?><br>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold"><?php echo app('translator')->get('Select File'); ?></label>
                            <input type="file" class="form-control" name="file" accept=".csv" required>
                            <div class="mt-1">
                                <small class="d-block">
                                    <?php echo app('translator')->get('Supported files:'); ?> <b class="fw-bold"><?php echo app('translator')->get('csv'); ?></b>
                                </small>
                                <small>
                                    <?php echo app('translator')->get('Download sample template file from here'); ?>
                                    <a href="<?php echo e(asset('assets/files/sample/product.csv')); ?>" title="<?php echo app('translator')->get('Download csv file'); ?>"
                                        class="text--primary" download>
                                        <b><?php echo app('translator')->get('csv'); ?></b>
                                    </a>

                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="Submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Import'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .table-responsive {
            min-height: 400px;
            background: transparent
        }

        .card {
            box-shadow: none;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['dateSearch' => 'yes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dateSearch' => 'yes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.new')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <a href="<?php echo e(route('admin.purchase.new')); ?>" class="btn btn-outline--primary h-45">
            <i class="la la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </a>
    <?php endif ?>
    <?php
        $params = request()->all();
    ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <a class="btn btn-outline--dark" href="<?php echo e(route('admin.purchase.pdf', $params)); ?>"><i
                class="la la-download"></i><?php echo app('translator')->get('PDF'); ?></a>
    <?php endif ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.csv')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <a class="btn btn-outline--info" href="<?php echo e(route('admin.purchase.csv', $params)); ?>"><i
                class="la la-download"></i><?php echo app('translator')->get('CSV'); ?></a>
    <?php endif ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
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
                    amountTypeLabel.text(`<?php echo app('translator')->get('Payable Amount'); ?>`);
                    payingReceivingLabel.text(`<?php echo app('translator')->get('Paying Amount'); ?>`);
                } else {
                    amountTypeLabel.text(`<?php echo app('translator')->get('Receivable Amount'); ?>`);
                    payingReceivingLabel.text(`<?php echo app('translator')->get('Receiving Amount'); ?>`);
                }
                modal.find('.payable_amount').val(`${due}`);
                modal.find('.supplier-name').val(`${data.supplier}`);
                modal.find('.invoice-no').val(`${data.invoice}`);
                let form = modal.find('form')[0];
                form.action = `<?php echo e(route('admin.supplier.payment.store', '')); ?>/${data.id}`
                modal.modal('show');
            });

            //Import-Modal
            $(".importBtn").on('click', function(e) {
                let importModal = $("#importModal");
                importModal.modal('show');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/purchase/index.blade.php ENDPATH**/ ?>