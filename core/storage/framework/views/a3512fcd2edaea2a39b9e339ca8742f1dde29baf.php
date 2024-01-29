<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Mobile | Email'); ?></th>
                                    <th><?php echo app('translator')->get('Payable'); ?></th>
                                    <th><?php echo app('translator')->get('Receivable'); ?></th>

                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($suppliers->firstItem() + $loop->index); ?></td>
                                        <td><?php echo e($supplier->name); ?></td>
                                        <td><span class="fw-bold"> <?php echo e($supplier->mobile); ?> </span><br> <?php echo e($supplier->email); ?>

                                        </td>

                                        <td><?php echo e($general->cur_sym . showAmount($supplier->totalPayableAmount())); ?></td>
                                        <td><?php echo e($general->cur_sym . showAmount($supplier->totalReceivableAmount())); ?></td>

                                        <td>
                                            <div class="button--group">
                                                <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn"
                                                    data-resource="<?php echo e($supplier); ?>"
                                                    data-modal_title="<?php echo app('translator')->get('Edit Supplier'); ?>">
                                                    <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                </button>

                                                <?php
                                                    $totalPayable = $supplier->totalPayableAmount() - abs($supplier->totalReceivableAmount());
                                                ?>
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.payment.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <a href="<?php echo e(route('admin.supplier.payment.index', $supplier->id)); ?>"
                                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                            'btn btn-sm btn-outline--info',
                                                            'disabled' => $totalPayable == 0,
                                                        ]) ?>">
                                                        <i class="las la-money-bill-wave-alt"></i><?php echo app('translator')->get('Payment'); ?>
                                                    </a>
                                                <?php endif ?>
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
                <?php if($suppliers->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo  paginateLinks($suppliers) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

    <div class="modal fade" id="cuModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form action="<?php echo e(route('admin.supplier.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                    <input type="text" name="name" class="form-control" autocomplete="off"
                                        value="<?php echo e(old('name')); ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->get('E-Mail'); ?></label>
                                    <input type="email" class="form-control " name="email" value="<?php echo e(old('email')); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->get('Mobile'); ?>
                                        <i class="fa fa-info-circle text--primary" title="<?php echo app('translator')->get('Type the mobile number including the country code. Otherwise, SMS won\'t send to that number.'); ?>">
                                        </i>
                                    </label>
                                    <input type="number" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control "
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Company'); ?></label>
                                    <input type="text" name="company_name" class="form-control" autocomplete="off"
                                        value="<?php echo e(old('company_name')); ?>">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Address'); ?></label>
                                    <input type="text" name="address" class="form-control" value="<?php echo e(old('address')); ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.store')  ? 1 : 0;
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
                    <h4 class="modal-title"><?php echo app('translator')->get('Import supplier'); ?></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form method="post" action="<?php echo e(route('admin.supplier.import')); ?>" id="importForm"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="alert alert-warning p-3" role="alert">
                                <p>
                                    - <?php echo app('translator')->get('Format your CSV the same way as the sample file below.'); ?> <br>
                                    - <?php echo app('translator')->get('The number of columns in your CSV should be the same as the example below.'); ?><br>
                                    - <?php echo app('translator')->get('Valid fields Tip: make sure name of fields must be following: name, email, mobile,company_name, address'); ?><br>
                                    - <?php echo app('translator')->get("Required field's (name, email,mobile), Unique Field's (email, mobile) column cell must not be empty."); ?><br>
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
                                    <a href="<?php echo e(asset('assets/files/sample/supplier.csv')); ?>" title="<?php echo app('translator')->get('Download csv file'); ?>"
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
    <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <button type="button" class="btn btn-outline--primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Supplier'); ?>">
            <i class="la la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </button>
    <?php endif ?>
    <?php
        $params = request()->all();
    ?>
    <?php $hasPermission = App\Models\Role::hasPermission(['admin.supplier.pdf', 'admin.supplier.csv', 'admin.supplier.import'])  ? 1 : 0;
            if($hasPermission == 1): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-outline--success dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php echo app('translator')->get('Action'); ?>
            </button>
            <ul class="dropdown-menu">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.pdf')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.supplier.pdf', $params)); ?>"><i
                                class="la la-download"></i><?php echo app('translator')->get('Export PDF'); ?></a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.csv')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.supplier.csv', $params)); ?>"><i
                                class="la la-download"></i><?php echo app('translator')->get('Export CSV'); ?></a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.import')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li>
                        <a class="dropdown-item importBtn" href="javascript:void(0)">
                            <i class="las la-cloud-upload-alt"></i><?php echo app('translator')->get('Import CSV'); ?></a>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/supplier/index.blade.php ENDPATH**/ ?>