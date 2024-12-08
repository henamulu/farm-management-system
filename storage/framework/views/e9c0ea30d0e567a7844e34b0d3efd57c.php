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
                    <!-- Encabezado con acciones -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold"><?php echo e($farm->name); ?></h2>
                        <div class="space-x-2">
                            <a href="<?php echo e(route('farms.edit', $farm)); ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Editar Granja
                            </a>
                            <form action="<?php echo e(route('farms.destroy', $farm)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Eliminar Granja
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Grid de información -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Detalles de la Granja -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">General Information</h3>
                            <div class="bg-gray-50 p-4 rounded">
                                <p><span class="font-semibold">Location:</span> <?php echo e($farm->location); ?></p>
                                <p><span class="font-semibold">Size:</span> <?php echo e($farm->size); ?> hectares</p>
                                <p><span class="font-semibold">Description:</span></p>
                                <p class="mt-1"><?php echo e($farm->description); ?></p>
                            </div>
                        </div>

                        <!-- Employee Summary -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Employees</h3>
                                <a href="<?php echo e(route('farms.employees.create', $farm)); ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    New Employee
                                </a>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                <?php if($farm->employees->isEmpty()): ?>
                                    <p class="text-gray-500">No employees registered</p>
                                <?php else: ?>
                                    <div class="space-y-3">
                                        <?php $__currentLoopData = $farm->employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="font-semibold"><?php echo e($employee->name); ?></p>
                                                    <p class="text-sm text-gray-600"><?php echo e($employee->position); ?></p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-semibold">$<?php echo e(number_format($employee->salary, 2)); ?></p>
                                                    <p class="text-sm text-gray-600"><?php echo e($employee->hire_date->format('d/m/Y')); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Inventory</h3>
                                <a href="<?php echo e(route('farms.stocks.create', $farm)); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    New Item
                                </a>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                <?php if($farm->stocks->isEmpty()): ?>
                                    <p class="text-gray-500">No items in inventory</p>
                                <?php else: ?>
                                    <div class="space-y-3">
                                        <?php $__currentLoopData = $farm->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="font-semibold"><?php echo e($stock->name); ?></p>
                                                    <p class="text-sm text-gray-600"><?php echo e($stock->type); ?></p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-semibold"><?php echo e($stock->quantity); ?> <?php echo e($stock->unit); ?></p>
                                                    <p class="text-sm text-gray-600">$<?php echo e(number_format($stock->price, 2)); ?>/unit</p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Machinery -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Machinery</h3>
                                <a href="<?php echo e(route('farms.machinery.create', $farm)); ?>" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                    New Machine
                                </a>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                <?php if($farm->machinery->isEmpty()): ?>
                                    <p class="text-gray-500">No machinery registered</p>
                                <?php else: ?>
                                    <div class="space-y-3">
                                        <?php $__currentLoopData = $farm->machinery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex justify-between items-center p-3 bg-white rounded shadow-sm">
                                                <div>
                                                    <p class="font-semibold"><?php echo e($machine->name); ?></p>
                                                    <p class="text-sm text-gray-600"><?php echo e($machine->type); ?></p>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        <?php if($machine->status === 'operational'): ?> bg-green-100 text-green-800
                                                        <?php elseif($machine->status === 'maintenance'): ?> bg-yellow-100 text-yellow-800
                                                        <?php elseif($machine->status === 'repair'): ?> bg-red-100 text-red-800
                                                        <?php else: ?> bg-gray-100 text-gray-800
                                                        <?php endif; ?>">
                                                        <?php echo e(ucfirst($machine->status)); ?>

                                                    </span>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm text-gray-600">Next Maint: <?php echo e($machine->next_maintenance ? $machine->next_maintenance->format('d/m/Y') : 'Not scheduled'); ?></p>
                                                    <div class="flex space-x-2 mt-2">
                                                        <a href="<?php echo e(route('farms.machinery.edit', [$farm, $machine])); ?>" 
                                                           class="text-yellow-600 hover:text-yellow-900">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                        </a>
                                                        <form action="<?php echo e(route('farms.machinery.destroy', [$farm, $machine])); ?>" method="POST" class="inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                                    onclick="return confirm('Are you sure you want to delete this machine?')">
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Back Link -->
                    <div class="mt-6">
                        <a href="<?php echo e(route('farms.index')); ?>" class="text-blue-500 hover:text-blue-700">
                            ← Back to farm list
                        </a>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold mb-4">Plans</h3>
                            <a href="<?php echo e(route('farms.plans.index', $farm)); ?>" 
                               class="text-blue-600 hover:text-blue-900">
                                View Plans
                            </a>
                        </div>
                    </div>
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
<?php endif; ?> <?php /**PATH D:\woonde-farm-project\farm-management-system\resources\views/farms/show.blade.php ENDPATH**/ ?>