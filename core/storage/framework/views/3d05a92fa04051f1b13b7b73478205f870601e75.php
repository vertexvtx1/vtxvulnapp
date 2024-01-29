<?php $__env->startSection('panel'); ?>
    <form action="<?php echo e(route('admin.roles.save', @$role->id)); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name', @$role->name)); ?>">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?php echo app('translator')->get('Set Permissions'); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="">

                            <div class="row gy-4">
                                <?php $__currentLoopData = $permissionGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permissionGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12">
                                        <div class="permission-item">
                                            <div class="row gy-2 justify-content-center align-items-center">
                                                <div class="col-sm-3">
                                                    <span><?php echo e(Str::replaceLast('Controller', '', $key)); ?></span>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <?php $__currentLoopData = $permissionGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="custom-control custom-checkbox form-check-primary">
                                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="<?php echo e($permission->id); ?>" id="customCheck<?php echo e($permission->id); ?>">
                                                                <label class="custom-control-label" for="customCheck<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .permission-item {
            background: #fafafa;
            border: 1px solid #f7f7f7;
            padding: 1rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <?php $__env->startPush('script'); ?>
        <script>
            (function($) {
                "use strict";
                <?php if(isset($permissions)): ?>
                    $('input[name="permissions[]"]').val(<?php echo json_encode($permissions, 15, 512) ?>);
                <?php endif; ?>
            })(jQuery);
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/roles/add.blade.php ENDPATH**/ ?>