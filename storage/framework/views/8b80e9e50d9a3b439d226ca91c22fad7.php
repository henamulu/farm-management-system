<div class="flex h-screen">
    <!-- Sidebar Navigation -->
    <nav class="bg-white w-64 min-h-screen border-r">
        <!-- Logo -->
        <div class="p-4 border-b">
            <div class="flex items-center">
                <img src="/logo.png" alt="Wonde Farm" class="h-8 w-8">
                <span class="ml-2 text-lg font-semibold text-green-600">Wonde Farm</span>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="p-4">
            <!-- Dashboard Section -->
            <div class="mb-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                    DASHBOARD
                </div>
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center text-gray-700 hover:text-green-600 py-2 <?php echo e(request()->routeIs('dashboard') ? 'text-green-600' : ''); ?>">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="<?php echo e(route('farms.index')); ?>" class="flex items-center text-gray-700 hover:text-green-600 py-2 <?php echo e(request()->routeIs('farms.*') ? 'text-green-600' : ''); ?>">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Farms
                </a>
                <?php if($farms->isNotEmpty()): ?>
                    <a href="<?php echo e(route('farms.employees.create', $farms->first())); ?>" 
                       class="flex items-center text-gray-700 hover:text-green-600 py-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Add Employee
                    </a>
                <?php endif; ?>
            </div>

            <!-- Messaging Section -->
            <div class="mb-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                    MESSAGING
                </div>
                <a href="#" class="flex items-center text-gray-700 hover:text-green-600 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    Message
                    <span class="ml-auto bg-green-500 text-white rounded-full text-xs px-2">2</span>
                </a>
            </div>

            <!-- Project Section -->
            <div class="mb-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                    PROJECT
                </div>
                <a href="#" class="flex items-center text-gray-700 hover:text-green-600 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Plan
                </a>
                <a href="#" class="flex items-center text-gray-700 hover:text-green-600 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Execution
                </a>
                <a href="#" class="flex items-center text-gray-700 hover:text-green-600 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Reportings
                </a>
            </div>

            <!-- Purchase Section -->
            <div class="mb-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                    PURCHASE
                </div>
                <a href="#" class="flex items-center text-gray-700 hover:text-green-600 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Supplier
                </a>
                <a href="#" class="flex items-center text-gray-700 hover:text-green-600 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Purchase Order
                </a>
            </div>
        </div>
    </nav>
</div> <?php /**PATH D:\woonde-farm-project\farm-management-system\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>