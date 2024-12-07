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
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Messages</h2>
                        <a href="<?php echo e(route('messages.create')); ?>" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            New Message
                        </a>
                    </div>

                    <!-- Search and Filters -->
                    <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input type="text" 
                                   name="search" 
                                   value="<?php echo e(request('search')); ?>"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="Search messages...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                            <select name="priority" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="all">All Priorities</option>
                                <?php $__currentLoopData = App\Models\Message::PRIORITIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(request('priority') === $key ? 'selected' : ''); ?>>
                                        <?php echo e($value); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="all">All Status</option>
                                <option value="unread" <?php echo e(request('status') === 'unread' ? 'selected' : ''); ?>>Unread</option>
                                <option value="read" <?php echo e(request('status') === 'read' ? 'selected' : ''); ?>>Read</option>
                            </select>
                        </div>

                        <div class="flex items-end space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                            <a href="<?php echo e(route('messages.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Clear
                            </a>
                        </div>
                    </form>

                    <!-- Messages List -->
                    <div class="space-y-4">
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="border rounded-lg p-4 <?php echo e($message->status === 'unread' ? 'bg-blue-50' : 'bg-white'); ?>">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold">
                                            <a href="<?php echo e(route('messages.show', $message)); ?>" class="hover:text-blue-600">
                                                <?php echo e($message->subject); ?>

                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600"><?php echo e($message->farm->name); ?></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            <?php if($message->priority === 'high'): ?> bg-red-100 text-red-800
                                            <?php elseif($message->priority === 'normal'): ?> bg-green-100 text-green-800
                                            <?php else: ?> bg-gray-100 text-gray-800
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($message->priority)); ?>

                                        </span>
                                        <p class="text-sm text-gray-500 mt-1"><?php echo e($message->created_at->diffForHumans()); ?></p>
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-600"><?php echo e(Str::limit($message->content, 150)); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-500 text-center py-4">No messages found</p>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        <?php echo e($messages->links()); ?>

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
<?php endif; ?> <?php /**PATH D:\woonde-farm-project\farm-management-system\resources\views/messages/index.blade.php ENDPATH**/ ?>