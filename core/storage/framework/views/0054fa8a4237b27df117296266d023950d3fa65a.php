<?php $__env->startSection('panel'); ?>
    <?php if(@json_decode($general->system_info)->version > systemDetails()['version']): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->get('New Version Available'); ?> <button class="btn btn--dark float-end"><?php echo app('translator')->get('Version'); ?>
                                <?php echo e(json_decode($general->system_info)->version); ?></button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?php echo app('translator')->get('What is the Update ?'); ?></h5>
                        <p>
                            <pre class="f-size--24"><?php echo e(json_decode($general->system_info)->details); ?></pre>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(@json_decode($general->system_info)->message): ?>
        <div class="row">
            <?php $__currentLoopData = json_decode($general->system_info)->message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <div class="alert border border--primary" role="alert">
                    <div class="alert__icon bg--primary">
                        <i class="far fa-bell"></i></div>
                        <p class="alert__message"><?php echo $msg; ?></p>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="row gy-4 mb-30">
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '2','link' => ''.e(route('admin.sale.index')).'','icon' => 'las la-shopping-cart','iconStyle' => 'false','title' => 'Sales','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_sale'])).'','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '2','link' => ''.e(route('admin.sale.index')).'','icon' => 'las la-shopping-cart','icon_style' => 'false','title' => 'Sales','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_sale'])).'','color' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '2','link' => ''.e(route('admin.sale.return.index')).'','icon' => 'las la-undo','iconStyle' => 'false','title' => 'Sales Return','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_sale_return'])).'','color' => 'warning']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '2','link' => ''.e(route('admin.sale.return.index')).'','icon' => 'las la-undo','icon_style' => 'false','title' => 'Sales Return','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_sale_return'])).'','color' => 'warning']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '2','link' => ''.e(route('admin.purchase.index')).'','icon' => 'las la-shopping-bag','iconStyle' => 'false','title' => 'Purchases','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_purchase'])).'','color' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '2','link' => ''.e(route('admin.purchase.index')).'','icon' => 'las la-shopping-bag','icon_style' => 'false','title' => 'Purchases','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_purchase'])).'','color' => 'success']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '2','link' => ''.e(route('admin.purchase.return.index')).'','icon' => 'las la-share','iconStyle' => 'false','title' => 'Purchases Return','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_purchase_return'])).'','color' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '2','link' => ''.e(route('admin.purchase.return.index')).'','icon' => 'las la-share','icon_style' => 'false','title' => 'Purchases Return','value' => ''.e($general->cur_sym).''.e(showAmount($widget['total_purchase_return'])).'','color' => 'danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

    <div class="row gy-4 mb-30">
        <div class="col-xxl-7">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5><?php echo app('translator')->get('Monthly Purchase & Sales Report'); ?> (<?php echo app('translator')->get('Last 12 Month'); ?>)</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="apex-bar-chart"> </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5><?php echo app('translator')->get('Top Selling Products'); ?></h5>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Product'); ?></th>
                                    <th><?php echo app('translator')->get('SKU'); ?></th>
                                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $topSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>

                                        <td data-label="<?php echo app('translator')->get('Product'); ?>">
                                            <?php echo e($loop->iteration); ?>. &nbsp;
                                            <a class="text--dark"
                                                href="<?php echo e(route('admin.product.edit', $product->id)); ?>"><?php echo e(strLimit(__($product->name), 20)); ?></a>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Quantity'); ?>"><?php echo e($product->sku); ?> </td>
                                        <td data-label="<?php echo app('translator')->get('Quantity'); ?>"><?php echo e($product->total_sale); ?>

                                            <?php echo e($product->unit->name); ?> </td>
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
            </div>
        </div>
    </div>

    <div class="row gy-4 mb-30">
        <div class="col-xl-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5><?php echo app('translator')->get('Product Alert Items'); ?> </h5>
                <a href="<?php echo e(route('admin.product.alert')); ?>" class="btn btn-sm btn-outline--primary"><?php echo app('translator')->get('View All'); ?></a>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Product'); ?></th>
                                    <th><?php echo app('translator')->get('Warehouse'); ?></th>
                                    <th><?php echo app('translator')->get('Alert'); ?></th>
                                    <th><?php echo app('translator')->get('Stock'); ?></th>
                                    <th><?php echo app('translator')->get('Unit'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $widget['alertProductsQty']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alertQty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="fw-bold"> <?php echo e($alertQty->name); ?> </td>
                                        <td> <?php echo e($alertQty->warehouse_name); ?> </td>
                                        <td>
                                            <span class="bg--warning px-2 rounded">
                                                <?php echo e($alertQty->alert_quantity); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="bg--danger px-2 rounded">
                                                <?php echo e($alertQty->quantity); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php echo e($alertQty->unit_name); ?>

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
            </div>
        </div>

        <div class="col-xl-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h5><?php echo app('translator')->get('Latest Sale Returns'); ?> </h5>
                <a href="<?php echo e(route('admin.sale.return.index')); ?>"
                    class="btn btn-sm btn-outline--primary"><?php echo app('translator')->get('View All'); ?></a>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Invoice No.'); ?> </th>
                                    <th><?php echo app('translator')->get('Customer'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $saleReturns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <?php echo e(showDateTime($return->return_date, 'd M, Y')); ?>

                                        </td>

                                        <td>
                                            <a class="text--dark"
                                                href="<?php echo e(route('admin.sale.return.edit', $return->id)); ?>"><?php echo e($return->sale->invoice_no); ?></a>
                                        </td>

                                        <td>
                                            <?php echo e($return->customer->name); ?>

                                        </td>

                                        <td>
                                            <?php echo e($general->cur_sym . showAmount($return->payable_amount)); ?>

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
            </div>
        </div>

    </div>

    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','link' => ''.e(route('admin.product.category.index')).'','icon' => 'lab la-buffer','title' => 'Categories','value' => ''.e($widget['total_category']).'','bg' => '1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','link' => ''.e(route('admin.product.category.index')).'','icon' => 'lab la-buffer','title' => 'Categories','value' => ''.e($widget['total_category']).'','bg' => '1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','link' => ''.e(route('admin.product.index')).'','icon' => 'lab la-product-hunt','title' => 'Products','value' => ''.e($widget['total_product']).'','bg' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','link' => ''.e(route('admin.product.index')).'','icon' => 'lab la-product-hunt','title' => 'Products','value' => ''.e($widget['total_product']).'','bg' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','link' => ''.e(route('admin.supplier.index')).'','icon' => 'las la-user-friends','title' => 'Suppliers','value' => ''.e($widget['total_supplier']).'','bg' => '18']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','link' => ''.e(route('admin.supplier.index')).'','icon' => 'las la-user-friends','title' => 'Suppliers','value' => ''.e($widget['total_supplier']).'','bg' => '18']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->

        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','link' => ''.e(route('admin.customer.index')).'','icon' => 'las la-users','title' => 'Customers','value' => ''.e($widget['total_customers']).'','bg' => '19']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','link' => ''.e(route('admin.customer.index')).'','icon' => 'las la-users','title' => 'Customers','value' => ''.e($widget['total_customers']).'','bg' => '19']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .widget-two__btn {
            right: 15px !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/apexcharts.min.js')); ?>"></script>

    <script>
        "use strict";
        window.onload = function() {

            var options = {
                series: [{
                        name: 'Total Purchase',
                        data: <?php echo json_encode($purchaseData, 15, 512) ?>
                    },
                    {
                        name: 'Total Purchase Return',
                        data: <?php echo json_encode($purchaseReturnData, 15, 512) ?>
                    },
                    {
                        name: 'Total Sale',
                        data: <?php echo json_encode($saleData, 15, 512) ?>
                    },
                    {
                        name: 'Total Sale Return',
                        data: <?php echo json_encode($saleReturnData, 15, 512) ?>
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
                    categories: <?php echo json_encode($months, 15, 512) ?>
                },
                yaxis: {
                    title: {
                        text: "<?php echo e($general->cur_text); ?>",
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
                            return `<?php echo e($general->cur_sym); ?> ${val}`
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>