<?php $__env->startSection('main-content'); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('S.N.'); ?></th>
                <th><?php echo app('translator')->get('SKU'); ?></th>
                <th><?php echo app('translator')->get('Name'); ?></th>
                <th><?php echo app('translator')->get('Brand'); ?></th>
                <th><?php echo app('translator')->get('Stock'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td> <?php echo e($product->sku); ?> </td>
                    <td>
                        <?php echo e(__($product->name)); ?>

                    </td>
                    <td><?php echo e(__(@$product->brand->name)); ?> </td>
                    <td>
                        <?php echo e($product->totalInStock() . ' ' . $product->unit->name); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/pdf/product/list.blade.php ENDPATH**/ ?>