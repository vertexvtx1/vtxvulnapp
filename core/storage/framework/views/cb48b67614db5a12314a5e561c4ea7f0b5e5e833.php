<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Invoice No.'); ?></th>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Supplier'); ?></th>
                                    <th><?php echo app('translator')->get('TRX'); ?></th>
                                    <th><?php echo app('translator')->get('Reason'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $paymentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($paymentLogs->firstItem() + $loop->index); ?></td>
                                        <td class="fw-bold">
                                            <?php if($log->purchase_id): ?>
                                                <span class="text--primary"> <?php echo e(@$log->purchase->invoice_no); ?></span>
                                            <?php else: ?>
                                                <span class="text--danger">
                                                    <?php echo e(@$log->purchaseReturn->purchase->invoice_no); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(showDateTime($log->created_at, 'd M, Y')); ?></td>
                                        <td class="fw-bold"><?php echo e($log->supplier->name); ?> </td>
                                        <td><?php echo e($log->trx); ?></td>
                                        <td><?php echo e(ucwords(strtolower(keyToTitle($log->remark)))); ?></td>
                                        <td><?php echo e($general->cur_sym . showAmount($log->amount)); ?></td>
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
                <?php if($paymentLogs->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo  paginateLinks($paymentLogs) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="" method="GET" class="d-flex flex-wrap justify-content-end gap-2">

        <div class="input-group w-auto">
            <select name="remark" class="form-control">
                <option value="" selected><?php echo app('translator')->get('All'); ?></option>
                <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($remark); ?>" <?php if($remark == request()->remark): echo 'selected'; endif; ?>>
                        <?php echo e(ucwords(strtolower(keyToTitle($remark)))); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <button class="btn btn--primary input-group-text"><i class="la la-search"></i></button>
        </div>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-date-field','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-date-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-key-field','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-key-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </form>

    <?php
        $params = request()->all();
    ?>
    <?php $hasPermission = App\Models\Role::hasPermission(['admin.customer*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-outline--success dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php echo app('translator')->get('Action'); ?>
            </button>
            <ul class="dropdown-menu">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.payment.supplier.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.report.payment.supplier.pdf', $params)); ?>"><i
                                class="la la-download"></i><?php echo app('translator')->get('PDF'); ?></a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.payment.supplier.csv')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.report.payment.supplier.csv', $params)); ?>"><i
                                class="la la-download"></i><?php echo app('translator')->get('CSV'); ?></a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/payment/supplier/log.blade.php ENDPATH**/ ?>