<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.product.store', @$product->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="background-image: url(<?php echo e(getImage(getFilePath('product') . '/' . @$product->image, getFileSize('product'))); ?>)">
                                                    <button type="button" class="remove-image"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success"><?php echo app('translator')->get('Upload Image'); ?></label>
                                                <small class="mt-2"><?php echo app('translator')->get('Supported files'); ?>: <b><?php echo app('translator')->get('jpeg'); ?>,
                                                        <?php echo app('translator')->get('jpg'); ?>.</b> <?php echo app('translator')->get('Image will be resized into 400x400px'); ?> </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label><?php echo app('translator')->get('Name'); ?></label>
                                            <input type="text" name="name" class="form-control"
                                                value="<?php echo e(old('name', @$product->name)); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label class="form-label"><?php echo app('translator')->get('Category'); ?></label>
                                            <select name="category" class="form-control " required>
                                                <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($category->id == @$product->category_id): echo 'selected'; endif; ?> value="<?php echo e($category->id); ?>">
                                                        <?php echo e(__($category->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Brand'); ?></label>
                                            <select name="brand" class="form-control" required>
                                                <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($brand->id == @$product->brand_id): echo 'selected'; endif; ?> value="<?php echo e($brand->id); ?>">
                                                        <?php echo e(__($brand->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label class="form-label"><?php echo app('translator')->get('SKU'); ?></label>
                                            <input type="text" class="form-control " name="sku"
                                                value="<?php echo e(old('sku', @$product->sku)); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Unit(UoM)'); ?></label>
                                            <select name="unit" class="form-control " required>
                                                <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($unit->id == @$product->unit_id): echo 'selected'; endif; ?> value="<?php echo e($unit->id); ?>">
                                                        <?php echo e(__($unit->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Alert Quantity'); ?></label>
                                            <input type="number" name="alert_quantity" class="form-control"
                                                value="<?php echo e(old('alert_quantity', @$product->alert_quantity)); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Note'); ?></label>
                                            <textarea name="note" class="form-control"><?php echo e(old('note', @$product->note)); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $hasPermission = App\Models\Role::hasPermission('admin.product.store')  ? 1 : 0;
            if($hasPermission == 1): ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.product.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.product.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/product/form.blade.php ENDPATH**/ ?>