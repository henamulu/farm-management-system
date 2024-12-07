<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Edit Inventory Item - <?php echo e($farm->name); ?></h2>

                    <form action="<?php echo e(route('farms.stocks.update', [$farm, $stock])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="<?php echo e(old('name', $stock->name)); ?>" 
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                Type
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="type"
                                name="type"
                                required>
                                <option value="">Select a type</option>
                                <option value="semillas" <?php echo e(old('type', $stock->type) == 'semillas' ? 'selected' : ''); ?>>Seeds</option>
                                <option value="fertilizantes" <?php echo e(old('type', $stock->type) == 'fertilizantes' ? 'selected' : ''); ?>>Fertilizers</option>
                                <option value="herramientas" <?php echo e(old('type', $stock->type) == 'herramientas' ? 'selected' : ''); ?>>Tools</option>
                                <option value="maquinaria" <?php echo e(old('type', $stock->type) == 'maquinaria' ? 'selected' : ''); ?>>Machinery</option>
                                <option value="otros" <?php echo e(old('type', $stock->type) == 'otros' ? 'selected' : ''); ?>>Others</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                                Quantity
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="quantity" 
                                type="number" 
                                name="quantity" 
                                value="<?php echo e(old('quantity', $stock->quantity)); ?>"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="unit">
                                Unit of Measure
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="unit"
                                name="unit"
                                required>
                                <option value="">Select a unit</option>
                                <option value="kg" <?php echo e(old('unit', $stock->unit) == 'kg' ? 'selected' : ''); ?>>Kilograms</option>
                                <option value="g" <?php echo e(old('unit', $stock->unit) == 'g' ? 'selected' : ''); ?>>Grams</option>
                                <option value="l" <?php echo e(old('unit', $stock->unit) == 'l' ? 'selected' : ''); ?>>Liters</option>
                                <option value="unidad" <?php echo e(old('unit', $stock->unit) == 'unidad' ? 'selected' : ''); ?>>Units</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                Unit Price
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="price" 
                                type="number" 
                                step="0.01" 
                                name="price" 
                                value="<?php echo e(old('price', $stock->price)); ?>">
                        </div>

                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit">
                                Update Item
                            </button>
                            <a href="<?php echo e(route('farms.stocks.index', $farm)); ?>" 
                                class="text-gray-500 hover:text-gray-700">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?> <?php /**PATH D:\woonde-farm-project\farm-management-system\resources\views/stocks/edit.blade.php ENDPATH**/ ?>