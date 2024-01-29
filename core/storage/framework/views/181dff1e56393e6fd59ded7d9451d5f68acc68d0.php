<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Image'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?> | <?php echo app('translator')->get('SKU'); ?> </th>
                                    <th><?php echo app('translator')->get('Category'); ?> | <?php echo app('translator')->get('Brand'); ?></th>
                                    <th><?php echo app('translator')->get('Stock'); ?> </th>
                                    <th><?php echo app('translator')->get('Total Sale'); ?> | <?php echo app('translator')->get('Alert Qty'); ?></th>
                                    <th><?php echo app('translator')->get('Unit'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <img
                                                src="<?php echo e(getImage(getFilePath('product') . '/' . $product->image, getFileSize('product'))); ?>">
                                        </td>

                                        <td class="long-text">
                                            <span class="fw-bold text--primary"><?php echo $product->name ?></span>
                                            <br>
                                            <span class="text--small "><?php echo e($product->sku); ?> </span>
                                        </td>

                                        <td>
                                            <?php echo e(__($product->category->name)); ?>

                                            <br>
                                            <span class="text--primary"><?php echo e($product->brand->name); ?></span>
                                        </td>

                                        <td>
                                            <?php echo e($product->totalInStock()); ?>

                                        </td>

                                        <td>
                                            <?php echo e($product->totalSale()); ?>

                                            <br>
                                            <span class="badge badge--warning"><?php echo e($product->alert_quantity); ?></span>
                                        </td>

                                        <td> <?php echo e($product->unit->name); ?></td>

                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission('admin.product.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <div class="button--group">
                                                    <a href="<?php echo e(route('admin.product.edit', $product->id)); ?>"
                                                        class="btn btn-sm btn-outline--primary ms-1 editBtn"><i
                                                            class="las la-pen"></i> <?php echo app('translator')->get('Edit'); ?></a>
                                                </div>
                                            <?php endif ?>
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
                <?php if($products->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($products) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

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

    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Name or SKU']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Name or SKU']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.product.create')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <a href="<?php echo e(route('admin.product.create')); ?>" class="btn btn-outline--primary">
            <i class="la la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </a>
    <?php endif ?>
    <?php
        $params = request()->all();
    ?>

    <?php $hasPermission = App\Models\Role::hasPermission(['admin.product.import', 'admin.product.pdf', 'admin.product.csv'])  ? 1 : 0;
            if($hasPermission == 1): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-outline--success dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php echo app('translator')->get('Action'); ?>
            </button>
            <ul class="dropdown-menu">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.product.pdf', $params)); ?>"><i
                                class="la la-download"></i><?php echo app('translator')->get('Export PDF'); ?></a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.csv')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.product.csv')); ?>"><i
                                class="la la-download"></i><?php echo app('translator')->get('Export CSV'); ?></a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.import')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item importBtn" href="javascript:void(0)">
                            <i class="las la-cloud-upload-alt"></i> <?php echo app('translator')->get('Import CSV'); ?></a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict"
            $(".importBtn").on('click', function(e) {
                let importModal = $("#importModal");
                importModal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/product/index.blade.php ENDPATH**/ ?>