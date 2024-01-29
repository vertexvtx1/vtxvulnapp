<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Address'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td> <?php echo e($warehouse->name); ?></td>
                                        <td><?php echo e($warehouse->address); ?> </td>
                                        <td>
                                            <?php
                                                echo $warehouse->statusBadge;
                                            ?>
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn"
                                                    data-resource="<?php echo e($warehouse); ?>" data-modal_title="<?php echo app('translator')->get('Edit Warehouse'); ?>"
                                                    data-has_status="1">
                                                    <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                </button>
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
                <?php if($warehouses->hasPages()): ?>
                    <div class="card-footer d-flex justify-content-center py-4">
                        <?php echo paginateLinks($warehouses) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

    <!-- Create Update Modal -->
    <div class="modal fade" id="cuModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.warehouse.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Address'); ?></label>
                            <input type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>" required>
                        </div>

                        <div class="status"></div>
                    </div>
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.warehouse.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('Import Warehouse'); ?></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form method="post" action="<?php echo e(route('admin.warehouse.import')); ?>" id="importForm"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="alert alert-warning p-3" role="alert">
                                <p>
                                    - <?php echo app('translator')->get('Format your CSV the same way as the sample file below.'); ?> <br>
                                    - <?php echo app('translator')->get('Valid fields Tip: make sure name of fields must be following: name, address'); ?><br>
                                    - <?php echo app('translator')->get('Required (name, address) , Unique (name)'); ?><br>
                                    - <?php echo app('translator')->get('When an error occurs download the error file and correct the incorrect cells and import that file again through format.'); ?><br>
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
                                    <a href="<?php echo e(asset('assets/files/sample/warehouse.csv')); ?>" title="<?php echo app('translator')->get('Download csv file'); ?>"
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

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
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

    <?php $hasPermission = App\Models\Role::hasPermission('admin.warehouse.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <button type="button" class="btn btn-sm btn-outline--primary h-45 cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Warehouse'); ?>">
            <i class="la la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </button>
    <?php endif ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.warehouse.import')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <button type="button" class="btn btn-sm btn-outline--info importBtn">
            <i class="las la-cloud-upload-alt"></i><?php echo app('translator')->get('Import CSV'); ?>
        </button>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/warehouse/index.blade.php ENDPATH**/ ?>