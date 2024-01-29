<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($general->siteName($pageTitle ?? '')); ?></title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo e(getImage(getFilePath('logoIcon') . '/favicon.png')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/pdf.css')); ?>">
</head>

<body>
    <main>
        <div class="list--row">
            <div class="address-to float-left">
                <h5 class="page-title"><?php echo e(@$pageTitle); ?></h5>
                <?php if(request()->date): ?>
                    <p class="text-small"><?php echo app('translator')->get('Date'); ?>: <?php echo e(request()->date); ?></p>
                <?php endif; ?>

                <?php if(request()->search): ?>
                    <p class="text-small"><?php echo app('translator')->get('Search Key'); ?>: <?php echo e(request()->search); ?></p>
                <?php endif; ?>
            </div>

            <div class="address-form float-right">
                <ul class="text-center">
                    <li>
                        <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo_2.png')); ?>" class="logo" alt="Logo">
                    </li>
                </ul>
            </div>
        </div>

        <div class="body">
            <?php echo $__env->yieldContent('main-content'); ?>
        </div>
    </main>

    <footer>
        <div class="d-block text-center">
            <?php echo app('translator')->get('Powered by'); ?> <?php echo e(__(@$general->site_name)); ?>

        </div>
    </footer>
</body>

</html>
<?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/pdf/layouts/master.blade.php ENDPATH**/ ?>