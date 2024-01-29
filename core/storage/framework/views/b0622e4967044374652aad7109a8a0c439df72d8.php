<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg--transparent">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two bg--white">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Invoice No.'); ?> | <?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Supplier'); ?> | <?php echo app('translator')->get('Mobile'); ?></th>
                                    <th><?php echo app('translator')->get('Warehouse'); ?> | <?php echo app('translator')->get('Total Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Lessed'); ?> | <?php echo app('translator')->get('Receivable'); ?> </th>
                                    <th><?php echo app('translator')->get('Received'); ?> | <?php echo app('translator')->get('Due'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $purchaseReturn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text--primary"><?php echo e($return->purchase->invoice_no); ?></span>
                                            <br>
                                            <small><?php echo e(showDateTime($return->return_date, 'd M, Y')); ?></small>
                                        </td>

                                        <td>
                                            <span class="fw-bold">
                                                <?php echo e($return->purchase->supplier->name); ?></span>
                                            <br>
                                            +<?php echo e($return->purchase->supplier->mobile); ?>

                                        </td>

                                        <td>
                                            <?php echo e($return->purchase->warehouse->name); ?>

                                            <br>
                                            <span
                                                class="fw-bold"><?php echo e($general->cur_sym . showAmount($return->total_price)); ?></span>
                                        </td>

                                        <td>
                                            <?php echo e($general->cur_sym . showAmount($return->discount_amount)); ?>

                                            <br>
                                            <span
                                                class="fw-bold"><?php echo e($general->cur_sym . showAmount($return->receivable_amount)); ?></span>
                                        </td>

                                        <td>
                                            <?php echo e($general->cur_sym . showAmount($return->received_amount)); ?>

                                            <br>

                                            <?php if($return->due_amount < 0): ?>
                                                <span class="text--danger fw-bold" title="<?php echo app('translator')->get('Payable to Supplier'); ?>">
                                                    - <?php echo e($general->cur_sym . showAmount(abs($return->due_amount))); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="fw-bold" title="<?php echo app('translator')->get('Receivable from Supplier'); ?>">
                                                    <?php echo e($general->cur_sym . showAmount($return->due_amount)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.return.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <a href="<?php echo e(route('admin.purchase.return.edit', $return->id)); ?>"
                                                    class="btn btn-sm btn-outline--primary ms-1 editBtn"><i
                                                        class="las la-pen"></i> <?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                                <?php endif ?>

                                                <button type="button"
                                                    class="btn btn-sm btn-outline--info ms-1 dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="la la-ellipsis-v"></i><?php echo app('translator')->get('More'); ?>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.payment.receive.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <?php if($return->due_amount != 0): ?>
                                                            <a href="javascript:void(0)" class="dropdown-item paymentModalBtn"
                                                                data-supplier="<?php echo e($return->supplier->name); ?>"
                                                                data-invoice="<?php echo e($return->purchase->invoice_no); ?>"
                                                                data-id="<?php echo e($return->id); ?>"
                                                                data-due_amount="<?php echo e($return->due_amount); ?>">
                                                                <?php if($return->due_amount < 0): ?>
                                                                    <i class="la la-hand-holding-usd"></i>
                                                                    <?php echo app('translator')->get('Give Payment'); ?>
                                                                <?php elseif($return->due_amount > 0): ?>
                                                                    <i class="la la-money-bill-wave"></i>
                                                                    <?php echo app('translator')->get('Receive Payment'); ?>
                                                                <?php endif; ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endif ?>
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.return.invoice.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('admin.purchase.return.invoice.pdf', $return->id)); ?>/?print=true">
                                                                <i class="la la-download"></i> <?php echo app('translator')->get('Download Details'); ?>
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr class="bg--white">
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
            <?php if($purchaseReturn->hasPages()): ?>
                <div class="card-footer py-4 bg--white">
                    <?php echo  paginateLinks($purchaseReturn) ?>
                </div>
            <?php endif; ?>
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
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Invoice No.'); ?></label>
                            <input type="text" class="form-control invoice_no" readonly>
                        </div>
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Supplier'); ?></label>
                            <input type="text" class="form-control supplier-name" readonly>
                        </div>
                        <div class="form-group">
                            <label class="amountType"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text"><?php echo e($general->cur_sym); ?></button>
                                <input type="text" class="form-control receivable_amount" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="payment-type"></label>
                            <div class="input-group">
                                <button type="button" class="input-group-text"><?php echo e($general->cur_sym); ?></button>
                                <input type="number" step="any" name="amount" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
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
    <?php
        $params = request()->all();
    ?>
    <?php $hasPermission = App\Models\Role::hasPermission(['admin.purchase.return*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
        <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <a class="btn btn-outline--dark" href="<?php echo e(route('admin.purchase.return.pdf', $params)); ?>"><i
                    class="la la-download"></i><?php echo app('translator')->get('PDF'); ?></a>
        <?php endif ?>
        <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.csv')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <a class="btn btn-outline--info" href="<?php echo e(route('admin.purchase.return.csv', $params)); ?>"><i
                    class="la la-download"></i><?php echo app('translator')->get('CSV'); ?></a>
        <?php endif ?>
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
                let payingReceivingLabel = modal.find('.payment-type')

                if (parseFloat(data.due_amount).toFixed(2) > 0) {
                    amountTypeLabel.text(`<?php echo app('translator')->get('Receivable amount'); ?>`);
                    payingReceivingLabel.text(`<?php echo app('translator')->get('Receiving amount'); ?>`);
                    modal.find('.modal-title').text(`Receive Payment`);
                } else {
                    amountTypeLabel.text(`<?php echo app('translator')->get('Payable amount'); ?>`);
                    payingReceivingLabel.text(`<?php echo app('translator')->get('Paying amount'); ?>`);
                    modal.find('.modal-title').text(`Give Payment`);
                }

                modal.find('.receivable_amount').val(`${due}`);
                modal.find('.supplier-name').val(`${data.supplier}`);
                modal.find('.invoice_no').val(`${data.invoice}`);
                let form = modal.find('form')[0];
                form.action = `<?php echo e(route('admin.supplier.payment.receive.store', '')); ?>/${data.id}`;
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/purchase_return/index.blade.php ENDPATH**/ ?>