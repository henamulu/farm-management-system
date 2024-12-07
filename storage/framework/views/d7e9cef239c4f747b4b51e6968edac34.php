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
                    <h2 class="text-2xl font-bold mb-4">Editar Maquinaria - <?php echo e($farm->name); ?></h2>

                    <form action="<?php echo e(route('farms.machinery.update', [$farm, $machinery])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Nombre
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="<?php echo e(old('name', $machinery->name)); ?>" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                    Tipo
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="type" 
                                    type="text" 
                                    name="type" 
                                    value="<?php echo e(old('type', $machinery->type)); ?>" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                                    Estado
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="status"
                                    name="status"
                                    required>
                                    <option value="operational" <?php echo e($machinery->status == 'operational' ? 'selected' : ''); ?>>Operativo</option>
                                    <option value="maintenance" <?php echo e($machinery->status == 'maintenance' ? 'selected' : ''); ?>>En Mantenimiento</option>
                                    <option value="repair" <?php echo e($machinery->status == 'repair' ? 'selected' : ''); ?>>En Reparación</option>
                                    <option value="retired" <?php echo e($machinery->status == 'retired' ? 'selected' : ''); ?>>Retirado</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="purchase_date">
                                    Fecha de Compra
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="purchase_date" 
                                    type="date" 
                                    name="purchase_date" 
                                    value="<?php echo e(old('purchase_date', $machinery->purchase_date->format('Y-m-d'))); ?>" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="purchase_price">
                                    Precio de Compra
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="purchase_price" 
                                    type="number" 
                                    step="0.01" 
                                    name="purchase_price" 
                                    value="<?php echo e(old('purchase_price', $machinery->purchase_price)); ?>" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_maintenance">
                                    Último Mantenimiento
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="last_maintenance" 
                                    type="date" 
                                    name="last_maintenance" 
                                    value="<?php echo e(old('last_maintenance', optional($machinery->last_maintenance)->format('Y-m-d'))); ?>">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="next_maintenance">
                                    Próximo Mantenimiento
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="next_maintenance" 
                                    type="date" 
                                    name="next_maintenance" 
                                    value="<?php echo e(old('next_maintenance', optional($machinery->next_maintenance)->format('Y-m-d'))); ?>">
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit">
                                Actualizar Maquinaria
                            </button>
                            <a href="<?php echo e(route('farms.show', $farm)); ?>" 
                                class="text-gray-500 hover:text-gray-700">
                                Cancelar
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
<?php endif; ?> <?php /**PATH D:\woonde-farm-project\farm-management-system\resources\views/machinery/edit.blade.php ENDPATH**/ ?>