<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });

    // Admin Password Reset

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('reset');
        Route::post('reset', 'sendResetCodeEmail');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('ResetPasswordController')->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'reset')->name('password.change');
    });
});


Route::middleware(['admin'])->group(function () {
    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');
        Route::get('banned', 'banned')->name('banned');

        //Report Bugs
        Route::get('request-report', 'requestReport')->name('request.report');
        Route::post('report-store', 'reportSubmit')->name('request.report.store');
        Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');
    });

    Route::middleware('adminPermission')->group(function () {

        Route::controller('StaffController')->prefix('staff')->name('staff.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('switch-status/{id}', 'status')->name('status');
            Route::get('login/{id}', 'login')->name('login');
        });

        Route::controller('RolesController')->prefix('roles')->name('roles.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('add', 'add')->name('add');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('save/{id?}', 'save')->name('save');
        });


        //Category Manage
        Route::controller('CategoryController')->name('product.category.')->prefix('category')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('delete/{id}', 'remove')->name('delete');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('import', 'import')->name('import');
        });

        // Brand Manage
        Route::controller('BrandController')->name('product.brand.')->prefix('brand')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('delete/{id}', 'remove')->name('delete');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('import', 'import')->name('import');
        });

        // Unit Manage
        Route::controller('UnitController')->name('product.unit.')->prefix('unit')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('delete/{id}', 'remove')->name('delete');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('import', 'import')->name('import');
        });

        // Product Manage
        Route::controller('ProductController')->name('product.')->prefix('product')->group(function () {
            Route::get('all/{scope?}', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('store/{id?}', 'store')->name('store');
            Route::get('alert', 'alert')->name('alert');
            Route::get('pdf', 'productPDF')->name('pdf');
            Route::get('csv', 'productCSV')->name('csv');
            Route::post('import', 'import')->name('import');
        });

        // Warehouse Manage
        Route::controller('WarehouseController')->name('warehouse.')->prefix('warehouse')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('import', 'import')->name('import');
        });

        // Manage Purchase
        Route::controller('PurchaseController')->name('purchase.')->prefix('purchase')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::get('pdf', 'purchasePDF')->name('pdf');
            Route::get('csv', 'purchaseCSV')->name('csv');
            Route::get('add-new', 'addNew')->name('new');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('store', 'store')->name('store');
            Route::get('pdf/{id}', 'downloadDetails')->name('invoice.pdf');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('product-search', 'productSearch')->name('product.search');
            Route::get('invoice-check', 'invoiceCheck')->name('invoice.check');
        });

        //Manage Purchase Return
        Route::controller('PurchaseReturnController')->name('purchase.return.')->prefix('purchase-return')->group(function () {
            Route::get('new/{id}', 'newReturn')->name('items');

            Route::get('all', 'index')->name('index');
            Route::get('pdf', 'purchaseReturnPDF')->name('pdf');
            Route::get('csv', 'purchaseReturnCSV')->name('csv');
            Route::post('store/{id}', 'store')->name('store');

            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');

            Route::get('pdf/{id}', 'downloadDetails')->name('invoice.pdf');
            Route::get('search-product', 'searchProduct')->name('search.product');
            Route::get('check-invoice', 'checkInvoice')->name('check.invoice');
        });

        //Manage Sales
        Route::controller('SaleController')->name('sale.')->prefix('sale')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::get('pdf', 'salePDF')->name('pdf');
            Route::get('csv', 'saleCSV')->name('csv');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');

            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('pdf/{id}', 'downloadInvoice')->name('invoice.pdf');
            Route::get('search-product', 'searchProduct')->name('search.product');
            Route::get('search-customer', 'searchCustomer')->name('search.customer');

            Route::get('last-invoice', 'lastInvoice')->name('last.invoice');
        });

        //Manage Sale Return
        Route::controller('SaleReturnController')->name('sale.return.')->prefix('sale-return')->group(function () {

            Route::get('all', 'index')->name('index');
            Route::get('pdf', 'saleReturnPDF')->name('pdf');
            Route::get('csv', 'saleReturnCSV')->name('csv');
            Route::get('new/{id}', 'newReturn')->name('items');
            Route::post('store/{id}', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('pdf/{id}', 'downloadInvoice')->name('invoice.pdf');
            Route::get('search-product', 'searchProduct')->name('search.product');
            Route::get('search-customer', 'searchCustomer')->name('search.customer');
        });


        //Adjustment
        Route::controller('AdjustmentController')->name('adjustment.')->prefix('adjustment')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::get('pdf', 'adjustmentPDF')->name('pdf');
            Route::get('csv', 'adjustmentCSV')->name('csv');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('details/{id}', 'detailsPDF')->name('details.pdf');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('search-product', 'searchProduct')->name('search.product');
        });



        // Supplier
        Route::controller('SupplierController')->name('supplier.')->prefix('supplier')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::post('store/{id?}', 'store')->name('store');
            Route::get('pdf', 'supplierPDF')->name('pdf');
            Route::get('csv', 'supplierCSV')->name('csv');
            Route::post('import', 'import')->name('import');
        });


        // Customer
        Route::controller('CustomerController')->name('customer.')->prefix('customer')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::post('store/{id?}', 'store')->name('store');
            Route::get('pdf', 'customerPDF')->name('pdf');
            Route::get('csv', 'customerCSV')->name('csv');
            Route::post('import', 'import')->name('import');

            Route::get('notification-log/{id}', 'notificationLog')->name('notification.log');
            Route::get('send-notification/{id}', 'showNotificationSingleForm')->name('notification.single');
            Route::post('send-notification/{id}', 'sendNotificationSingle')->name('notification.single');
            Route::get('send-notification', 'showNotificationAllForm')->name('notification.all');
            Route::post('send-notification', 'sendNotificationAll')->name('notification.all.send');
            Route::get('email/detail/{id}', 'emailDetails')->name('email.details');
        });

        //Payment - Supplier
        Route::controller('SupplierPaymentController')->name('supplier.payment.')->prefix('supplier/payment')->group(function () {
            Route::get('index/{id}', 'index')->name('index');
            Route::post('all-payment/{id}', 'clearPayment')->name('clear');
            Route::post('store/{id?}', 'purchasePayment')->name('store');
            Route::post('receive-payment/{id}', 'purchaseReturnPayment')->name('receive.store');
            //download
            Route::get('pdf/{id}', 'customerPayPDF')->name('pdf');
        });


        //Payment - Customer
        Route::controller('CustomerPaymentController')->name('customer.payment.')->prefix('customer/payment')->group(function () {
            Route::post('all-payment/{id}', 'clearPayment')->name('clear');
            //sale
            Route::get('index/{id}', 'index')->name('index');
            Route::post('store/{id?}', 'salePayment')->name('store');
            //sale return
            Route::post('payable/{id}', 'storeCustomerPayablePayment')->name('payable.store');
            //download
            Route::get('pdf/{id}', 'customerPayPDF')->name('pdf');
        });

        //Manage warehouse Transfer
        Route::controller('TransferController')->name('transfer.')->prefix('transfer')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::get('pdf', 'transferPDF')->name('pdf');
            Route::get('csv', 'transferCSV')->name('csv');
            Route::get('create', 'create')->name('create');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('store', 'store')->name('store');
            Route::get('pdf/{id}', 'detailsPDF')->name('details.pdf');
            Route::post('update/{id}', 'update')->name('update');
            Route::get('search-product', 'searchProduct')->name('search.product');
        });


        //Expense
        Route::controller('ExpenseTypeController')->name('expense.type.')->prefix('expense-type')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('delete/{id}', 'remove')->name('delete');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('import', 'import')->name('import');
        });

        Route::controller('ExpenseController')->name('expense.')->prefix('expense')->group(function () {
            Route::get('pdf', 'expensePDF')->name('pdf');
            Route::get('csv', 'expenseCSV')->name('csv');
            Route::get('/{id?}', 'index')->name('index');
            Route::post('store/{id?}', 'store')->name('store');
            Route::post('import', 'import')->name('import');
        });

        Route::controller('GeneralSettingController')->group(function () {
            // General Setting
            Route::get('general-setting', 'index')->name('setting.index');
            Route::post('general-setting', 'update')->name('setting.update');

            //configuration
            Route::get('setting/system-configuration', 'systemConfiguration')->name('setting.system.configuration');
            Route::post('setting/system-configuration/store', 'systemConfigurationSubmit')->name('setting.system.configuration.store');

            // Logo-Icon
            Route::get('setting/logo-icon', 'logoIcon')->name('setting.logo.icon');
            Route::post('setting/logo-icon', 'logoIconUpdate')->name('setting.logo.icon.store');
        });


        //Payment Report
        Route::controller('PaymentReportController')->name('report.payment.')->prefix('reports/payment')->group(function () {
            Route::get('supplier', 'supplierPaymentLogs')->name('supplier');
            Route::get('supplier/pdf', 'supplierPaymentPDF')->name('supplier.pdf');
            Route::get('supplier/csv', 'supplierPaymentCSV')->name('supplier.csv');
            Route::get('customer', 'customerPaymentLogs')->name('customer');
            Route::get('customer/pdf', 'customerPaymentPDF')->name('customer.pdf');
            Route::get('customer/csv', 'customerPaymentCSV')->name('customer.csv');
        });

        //Stock Report
        Route::controller('StockReportController')->name('report.stock.')->prefix('reports/stock')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('pdf', 'stockPDF')->name('pdf');
            Route::get('csv', 'stockCSV')->name('csv');
        });


        Route::get('all-products', 'ProductController@allProducts')->name('product.list');

        Route::controller('DataEntryReportController')->prefix('reports/data-entry')->name('report.data.entry.')->group(function () {
            Route::get('product', 'product')->name('product');
            Route::get('customer', 'customer')->name('customer');
            Route::get('supplier', 'supplier')->name('supplier');
            Route::get('purchase', 'purchase')->name('purchase');
            Route::get('purchase-return', 'purchaseReturn')->name('purchase.return');
            Route::get('sale', 'sale')->name('sale');
            Route::get('sale-return', 'saleReturn')->name('sale.return');
            Route::get('adjustment', 'adjustment')->name('adjustment');
            Route::get('transfer', 'transfer')->name('transfer');
            Route::get('expense', 'expense')->name('expense');
            Route::get('supplier-payment', 'supplierPayment')->name('supplier.payment');
            Route::get('customer-payment', 'customerPayment')->name('customer.payment');
        });

        //Notification Setting
        Route::name('setting.notification.')->controller('NotificationController')->prefix('notification')->group(function () {
            //Template Setting
            Route::get('global', 'global')->name('global');
            Route::post('global/update', 'globalUpdate')->name('global.update');
            Route::get('templates', 'templates')->name('templates');
            Route::get('template/edit/{id}', 'templateEdit')->name('template.edit');
            Route::post('template/update/{id}', 'templateUpdate')->name('template.update');

            //Email Setting
            Route::get('email/setting', 'emailSetting')->name('email');
            Route::post('email/setting', 'emailSettingUpdate')->name('email.update');
            Route::post('email/test', 'emailTest')->name('email.test');

            //SMS Setting
            Route::get('sms/setting', 'smsSetting')->name('sms');
            Route::post('sms/setting', 'smsSettingUpdate')->name('sms.update');
            Route::post('sms/test', 'smsTest')->name('sms.test');
        });

    });
    //System Information
    Route::controller('SystemController')->name('system.')->prefix('system')->group(function () {
        Route::get('info', 'systemInfo')->name('info');
        Route::get('server-info', 'systemServerInfo')->name('server.info');
        Route::get('optimize', 'optimize')->name('optimize');
        Route::get('optimize-clear', 'optimizeClear')->name('optimize.clear');
        Route::get('system-update', 'systemUpdate')->name('update');
        Route::post('update-upload', 'updateUpload')->name('update.upload');
    });
});
