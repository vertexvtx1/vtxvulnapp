<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="la la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__main-logo">
                <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
            </a>
        </div>

        <?php
            $admin = auth()
                ->guard('admin')
                ->user();
        ?>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.dashboard')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.dashboard')); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link ">
                        <i class="menu-icon la la-home"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
                    </a>
                </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a class="<?php echo e(menuActive(['admin.staff*', 'admin.roles.*'], 3)); ?>" href="javascript:void(0)">
                            <i class="menu-icon las la-users"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Manage Staff'); ?></span>
                        </a>
                        <div
                            class="sidebar-submenu <?php echo e(menuActive(['admin.staff*', 'admin.roles.*', 'admin.permissions*'], 2)); ?>">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.staff.index')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('All Staff'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.roles.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.roles*')); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.roles.index')); ?>">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Roles'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.product*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.product*', 3)); ?>">
                            <i class="menu-icon lab la-product-hunt"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Manage Product'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.product*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.category.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.product.category.index')); ?> ">
                                        <a href="<?php echo e(route('admin.product.category.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Categories'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.brand.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.product.brand.index')); ?> ">
                                        <a href="<?php echo e(route('admin.product.brand.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Brands'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.unit.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.product.unit.index')); ?> ">
                                        <a href="<?php echo e(route('admin.product.unit.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Units'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.product.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.product.index')); ?> ">
                                        <a href="<?php echo e(route('admin.product.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Products'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.warehouse*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.warehouse.*')); ?>">
                        <a href="<?php echo e(route('admin.warehouse.index')); ?>" class="nav-link ">
                            <i class="menu-icon la la-warehouse"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Warehouse'); ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.customer.payment*', 'admin.customer.notification*'], 'admin.customer.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li
                        class="sidebar-menu-item <?php echo e(menuActive(['admin.customer.index', 'admin.customer.payment.*', 'admin.customer.notification.*'])); ?> ">
                        <a href="<?php echo e(route('admin.customer.index')); ?>" class="nav-link">
                            <i class="menu-icon la la-users"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Customer'); ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.supplier.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive(['admin.supplier.index', 'admin.supplier.payment.*'])); ?> ">
                        <a href="<?php echo e(route('admin.supplier.index')); ?>" class="nav-link">
                            <i class="menu-icon la la-user-friends"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Supplier'); ?></span>
                        </a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.purchase*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.purchase*', 3)); ?>">
                            <i class="menu-icon la la-shopping-bag"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Purchase'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.purchase*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.purchase.index')); ?> ">
                                        <a href="<?php echo e(route('admin.purchase.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('All Purchases'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.purchase.return.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.purchase.return.index')); ?> ">
                                        <a href="<?php echo e(route('admin.purchase.return.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Purchases Return'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.sale*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.sale*', 3)); ?>">
                            <i class="menu-icon la la-shopping-cart"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Sale'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.sale*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.sale.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.sale.index')); ?> ">
                                        <a href="<?php echo e(route('admin.sale.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('All Sales'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.sale.return.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.sale.return.index')); ?> ">
                                        <a href="<?php echo e(route('admin.sale.return.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Sales Return'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.adjustment.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.adjustment.*')); ?>">
                        <a href="<?php echo e(route('admin.adjustment.index')); ?>" class="nav-link ">
                            <i class="menu-icon la la-balance-scale"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Adjustment'); ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.transfer.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.transfer.*')); ?>">
                        <a href="<?php echo e(route('admin.transfer.index')); ?>" class="nav-link ">
                            <i class="menu-icon la la-retweet"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Transfer'); ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.expense*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.expense*', 3)); ?>">
                            <i class="menu-icon la la-wallet"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Expense'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.expense*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.expense.type.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.expense.type.index')); ?> ">
                                        <a href="<?php echo e(route('admin.expense.type.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Type'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.expense.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.expense.index')); ?> ">
                                        <a href="<?php echo e(route('admin.expense.index')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('All Expenses'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.report*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Reports'); ?></li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.report.payment*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.report.payment.*', 3)); ?>">
                            <i class="menu-icon la la-money-check-alt"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Payment Report'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.report.payment.*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.payment.supplier')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.payment.supplier')); ?> ">
                                        <a href="<?php echo e(route('admin.report.payment.supplier')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Supplier Payments'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.payment.customer')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.payment.customer')); ?> ">
                                        <a href="<?php echo e(route('admin.report.payment.customer')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Customer Payments'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.stock.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.stock.index')); ?> ">
                        <a href="<?php echo e(route('admin.report.stock.index')); ?>" class="nav-link">
                            <i class="menu-icon la la-list"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Stock Report'); ?></span>
                        </a>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.report.data.entry*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.report.data.entry*', 3)); ?>">
                            <i class="menu-icon la la-database"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Data Entry Report'); ?></span>
                        </a>

                        <div class="sidebar-submenu <?php echo e(menuActive('admin.report.data.entry*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.product')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.product')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.product')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Product'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.customer')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.customer')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.customer')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Customer'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.supplier')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.supplier')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.supplier')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Supplier'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.purchase')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.purchase')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.purchase')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span pan class="menu-title"><?php echo app('translator')->get('Purchase'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.purchase.return')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li
                                        class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.purchase.return')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.purchase.return')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Purchase Return'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.sale')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.sale')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.sale')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span pan class="menu-title"><?php echo app('translator')->get('Sale'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.sale.return')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.sale.return')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.sale.return')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Sale Return'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.adjustment')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.adjustment')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.adjustment')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Adjustment'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.transfer')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.transfer')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.transfer')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Transfer'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.expense')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.expense')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.expense')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Expense'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.supplier.payment')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li
                                        class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.supplier.payment')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.supplier.payment')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Supplier Payment'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.report.data.entry.customer.payment')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li
                                        class="sidebar-menu-item <?php echo e(menuActive('admin.report.data.entry.customer.payment')); ?> ">
                                        <a href="<?php echo e(route('admin.report.data.entry.customer.payment')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Customer Payment'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>

                            </ul>
                        </div>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.setting*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Settings'); ?></li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.index')); ?>">
                        <a href="<?php echo e(route('admin.setting.index')); ?>" class="nav-link">
                            <i class="menu-icon la la-life-ring"></i>
                            <span class="menu-title"><?php echo app('translator')->get('General Setting'); ?></span>
                        </a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.system.configuration')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.system.configuration')); ?>">
                        <a href="<?php echo e(route('admin.setting.system.configuration')); ?>" class="nav-link">
                            <i class="menu-icon la la-cog"></i>
                            <span class="menu-title"><?php echo app('translator')->get('System Configuration'); ?></span>
                        </a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.logo.icon')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.logo.icon')); ?>">
                        <a href="<?php echo e(route('admin.setting.logo.icon')); ?>" class="nav-link">
                            <i class="menu-icon la la-images"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Logo & Favicon'); ?></span>
                        </a>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.setting.notification*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.setting.notification*', 3)); ?>">
                            <i class="menu-icon la la-bell"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Notification Setting'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.setting.notification*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.global')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.global')); ?> ">
                                        <a href="<?php echo e(route('admin.setting.notification.global')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Global Template'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.email')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.email')); ?> ">
                                        <a href="<?php echo e(route('admin.setting.notification.email')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Email Setting'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.sms')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.sms')); ?> ">
                                        <a href="<?php echo e(route('admin.setting.notification.sms')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('SMS Setting'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.templates')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.templates')); ?> ">
                                        <a href="<?php echo e(route('admin.setting.notification.templates')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Notification Templates'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>

                <?php $hasPermission = App\Models\Role::hasPermission(['admin.system*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar__menu-header"><?php echo app('translator')->get('Extra'); ?></li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.system*', 3)); ?>">
                            <i class="menu-icon la la-server"></i>
                            <span class="menu-title"><?php echo app('translator')->get('System'); ?></span>
                        </a>
                        <div class="sidebar-submenu <?php echo e(menuActive('admin.system*', 2)); ?> ">
                            <ul>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.system.info')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.info')); ?> ">
                                        <a href="<?php echo e(route('admin.system.info')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Application'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.system.server.info')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.server.info')); ?> ">
                                        <a href="<?php echo e(route('admin.system.server.info')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Server'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.system.optimize')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.optimize')); ?> ">
                                        <a href="<?php echo e(route('admin.system.optimize')); ?>" class="nav-link">
                                            <i class="menu-icon la la-dot-circle"></i>
                                            <span class="menu-title"><?php echo app('translator')->get('Cache'); ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.system.update')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.update')); ?> ">
                                    <a href="<?php echo e(route('admin.system.update')); ?>" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title"><?php echo app('translator')->get('Update'); ?></span>
                                    </a>
                                </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.request.report')  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <li class="sidebar-menu-item  <?php echo e(menuActive('admin.request.report')); ?>">
                        <a href="<?php echo e(route('admin.request.report')); ?>" class="nav-link"
                            data-default-url="<?php echo e(route('admin.request.report')); ?>">
                            <i class="menu-icon la la-bug"></i>
                            <span class="menu-title"><?php echo app('translator')->get('Report & Request'); ?> </span>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary"><?php echo e(__(systemDetails()['name'])); ?></span>
                <span class="text--success"><?php echo app('translator')->get('V'); ?><?php echo e(systemDetails()['version']); ?> </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

<?php $__env->startPush('script'); ?>
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/partials/sidenav.blade.php ENDPATH**/ ?>