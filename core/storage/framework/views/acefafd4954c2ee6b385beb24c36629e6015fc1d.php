<?php $__env->startSection('panel'); ?>
    <div class="row gy-3">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form
                        action="<?php if(isset($purchase)): ?> <?php echo e(route('admin.purchase.update', @$purchase->id)); ?> <?php else: ?> <?php echo e(route('admin.purchase.store')); ?> <?php endif; ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row mb-3">
                            <div class="col-xl-3 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Invoice No:'); ?></label>
                                    <input type="text" name="invoice_no"
                                        value="<?php echo e(old('invoice_no', @$purchase->invoice_no)); ?>" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="form-group" id="supplier-wrapper">
                                    <label class="form-label"><?php echo app('translator')->get('Supplier'); ?></label>
                                    <select name="supplier_id" class="select2-basic form-control" required>
                                        <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($supplier->id); ?>" <?php if($supplier->id == @$purchase->supplier_id): echo 'selected'; endif; ?>>
                                                <?php echo e($supplier->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Date'); ?></label>
                                    <input name="purchase_date" type="text" data-language="en"
                                        class="datepicker-here form-control bg--white" data-position='bottom left'
                                        autocomplete="off"
                                        value="<?php echo e(old(date('m/d/Y'), showDateTime(@$purchase->purchase_date, 'm/d/Y'))); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->get('Warehouse'); ?></label>
                                    <select name="warehouse_id" class="form-control " required>
                                        <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                        <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($warehouse->id); ?>" <?php if($warehouse->id == @$purchase->warehouse_id): echo 'selected'; endif; ?>>
                                                <?php echo e(__($warehouse->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group products-container position-relative">
                                    <label> <?php echo app('translator')->get('Product'); ?><span class="text--danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="las la-search"></i></span>
                                            <input type="search" class="form-control keyword"
                                                placeholder="<?php echo app('translator')->get('Product Name or SKU'); ?>">
                                        </div>
                                    </div>
                                    <ul class="products">
                                        <!-- Product data will append here after search -->
                                    </ul>
                                    <span class="text--danger error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="table-responsive table-responsive--lg">
                                <table class="productTable table border">
                                    <thead class="border bg--dark">
                                        <tr>
                                            <th><?php echo app('translator')->get('Name'); ?></th>
                                            <th><?php echo app('translator')->get('Quantity'); ?><span class="text--danger">*</span></th>
                                            <th><?php echo app('translator')->get('Price'); ?><span class="text--danger">*</span></th>
                                            <th><?php echo app('translator')->get('Total'); ?></th>
                                            <th><?php echo app('translator')->get('Action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(isset($purchase)): ?>
                                            <?php $__currentLoopData = $purchase->purchaseDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr data-product_id="<?php echo e($item->product->id); ?>" class="product-row">

                                                    <td class="fw-bold">
                                                        <input type="text" class="form-control"
                                                            value="<?php echo e($item->product->name); ?>" readonly required>
                                                        <input type="hidden" name="products[<?php echo e($loop->index); ?>][product_id]"
                                                            value="<?php echo e($item->product->id); ?>" />
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number"
                                                                name="products[<?php echo e($loop->index); ?>][quantity]"
                                                                value="<?php echo e($item->quantity); ?>" class="form-control quantity"
                                                                data-id="<?php echo e($item->product->id); ?>" required>

                                                            <span
                                                                class="input-group-text"><?php echo e($item->product->unit->name); ?></span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                            <input type="number" name="products[<?php echo e($loop->index); ?>][price]"
                                                                class="form-control purchase-price"
                                                                data-id="<?php echo e($item->product->id); ?>" value="<?php echo e($item->price); ?>"
                                                                step="any" required>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                            <input type="number" value="<?php echo e($item->price * $item->quantity); ?>"
                                                                class="form-control total" readonly>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline--danger disabled h-45">
                                                            <i class="la la-trash"></i> <?php echo app('translator')->get('Remove'); ?>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Note'); ?></label>
                                    <textarea name="note" class="form-control"><?php echo e(old('note', @$purchase->note)); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label> <?php echo app('translator')->get('Total Price'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                <input type="number" class="form-control total_price"
                                                    value="<?php echo e(@$purchase->payable_amount); ?>" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label> <?php echo app('translator')->get('Discount'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                <input type="number" name="discount" class="form-control"
                                                    value="<?php echo e(old('discount', getAmount(@$purchase->discount_amount))); ?>"
                                                    step="any">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Payable Amount'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                <input type="number" class="form-control payable_amount"
                                                    value="<?php echo e(getAmount(@$purchase->payable_amount)); ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(isset($purchase)): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo app('translator')->get('Paid Amount'); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                    <input type="number" name="paid_amount" class="form-control"
                                                        value="<?php echo e(getAmount(@$purchase->paid_amount)); ?>" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo app('translator')->get('Due Amount'); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                    <input type="number" class="form-control due_amount"
                                                        value="<?php echo e(getAmount(@$purchase->due_amount)); ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                        <?php if(isset($purchase) && $purchase->return_status == 1): ?>
                            <div class="alert alert-danger p-3 d-flex flex-column" role="alert">
                                <h4 class="text--danger text-center"> <i class="fa fa-exclamation-circle"
                                        aria-hidden="true"></i> <?php echo app('translator')->get('Some products has returned from this purchase'); ?></h4>

                                <p class="text--danger text-center">
                                    <?php echo app('translator')->get('You can\'t edit a purchase after return any quantity from it.'); ?>
                                    <a href="<?php echo e(route('admin.purchase.return.edit', $purchase->purchaseReturn->id)); ?>"
                                        class="text--primary text-decoration-underline"><?php echo app('translator')->get('View Return Details'); ?></a>
                                </p>
                            </div>
                        <?php endif; ?>

                       
                            <button type="submit" class="btn btn--primary w-100 h-45"
                                <?php if(isset($purchase) && $purchase->return_status == 1): ?> disabled <?php endif; ?>><?php echo app('translator')->get('Submit'); ?></button>
                     

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.purchase.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.purchase.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .table td {
            padding: 15px 6px !important;
        }

        #supplier-wrapper {
            position: relative;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            'use strict';

            $('.select2-basic').select2({
                dropdownParent: $('#supplier-wrapper')
            });

            let productArray = [];
            <?php if(@$purchase): ?>
                productArray = <?php echo json_encode($purchase->purchaseDetails->pluck('product_id')->toArray(), 15, 512) ?>;
            <?php endif; ?>

            calculateGrandTotal();

            $(".keyword").on('input', function() {
                $('.products-container .error-message').empty();
                let data = {};
                data.keyword = $(this).val();

                if (data.keyword) {
                    $.ajax({
                        url: "<?php echo e(route('admin.purchase.product.search')); ?>",
                        method: 'GET',
                        data: data,
                        success: function(response) {
                            var products = '';
                            $(".products").html('');
                            if (response.data.length) {

                                $.each(response.data, function(key, product) {
                                    products +=
                                        `<li class="products__item productItem" data-id="${product.id}" data-name="${product.name}" data-unit="${product.unit.name}">
                                        <h6>${product.name}</h6>
                                        <small>SKU: ${product.sku}</small>
                                    </li>`;
                                });
                            } else {
                                $('.products-container .error-message').text("<?php echo app('translator')->get('No product found'); ?>");
                            }

                            $(".products").html(products);
                        },
                    });
                } else {
                    $(".products").empty();
                    $('.products-container .error-message').empty();
                }

            });

            $('body').on('click', '.productItem', function() {
                let index = $('.product-row ').length + 1;

                $(".no-data").addClass('d-none');
                var data = $(this).data();
                let productId = data.id;


                if (!productArray.includes(productId)) {
                    productArray.push(productId);

                    $(".productTable tbody").append(`
                        <tr data-product_id="${data.id}" class="product-row">
                            <td data-label="<?php echo app('translator')->get('Name'); ?>" class="fw-bold">
                                <input type="text" class="form-control" value="${data.name}" readonly required>
                                <input type="hidden" class="product_id" name="products[${index}][product_id]" value="${data.id}"/>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Quantity'); ?>">
                                <div class="input-group">
                                    <input type="number" name="products[${index}][quantity]" value="1"  class="form-control quantity" data-id="${data.id}" required>
                                    <span class="input-group-text">${data.unit}</span>

                                </div>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Price'); ?>">
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                    <input type="number" name="products[${index}][price]" class="form-control purchase-price" data-id="${data.id}" value="0" step="any" required>
                                </div>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Total'); ?>">
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                    <input type="number" value="0" class="form-control total" step="any" readonly>
                                </div>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <button type="button" class="btn btn-outline--danger removeBtn h-45" >
                                    <i class="la la-trash"></i> <?php echo app('translator')->get('Remove'); ?>
                                </button>
                            </td>
                        </tr>
                    `);

                } else {
                    let quantityField = $(`[data-product_id=${productId}]`).find('.quantity');
                    quantityField.val(Number(quantityField.val()) + 1);
                    let target = $(`[data-product_id=${productId}]`).find('.quantity');
                    calculateProductData(target)
                }

                $(".products").empty();
                $('.keyword').val("");
            });


            $("[name=discount]").on('input', function() {
                calculateGrandTotal();
            });

            // Remove the product row from table
            $(".productTable").on('click', '.removeBtn', function() {
                let productId = Number($(this).parents('tr').find('.product_id').val());
                let indexToRemove = productArray.indexOf(productId);
                productArray.splice(indexToRemove, 1)
                $(this).parents('tr').remove();
                calculateGrandTotal();
            });

            $(".productTable").on('input', '.quantity', function() {
                calculateProductData($(this));
            });

            $(".productTable").on('input', '.purchase-price', function() {
                calculateProductData($(this));
            });

            function calculateProductData($this) {
                let qty = $this.parents('tr').find('.quantity').val();
                let purchasesPrice = $this.parents('tr').find('.purchase-price').val();

                let total = qty * purchasesPrice;
                $this.parents('tr').find('.total').val(total.toFixed(2))
                calculateGrandTotal();
            }

            $('[name=paid_amount]').on('input', function() {
                calculateGrandTotal();
                let payableAmount = Number($('.payable_amount').val());
                let payingAmount = Number($(this).val());

                if (payableAmount < payingAmount) {
                    $(this).val(payableAmount);
                    $(".due_amount").val(0);
                }
            });

            function calculateGrandTotal() {
                var total = 0;
                $(".productTable .total").each(function(index, element) {
                    total = total + parseFloat($(element).val());
                });

                var discount = parseFloat($("[name=discount]").val() * 1);
                $(".total_price").val(total.toFixed(2));
                var payableAmount = total - discount;

                $(".payable_amount").val(payableAmount.toFixed(2));
                let payingAmount = $('[name=paid_amount]').val();
                $(".due_amount").val(payableAmount - payingAmount);
            }



        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kenziy/Documents/vertex/vulnApps/core/resources/views/admin/purchase/form.blade.php ENDPATH**/ ?>