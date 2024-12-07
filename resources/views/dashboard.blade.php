<x-app-layout>
    <div class="space-y-6">
        <!-- Farm Stats Card -->
        <div class="bg-green-600 rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                <img src="/images/tractor.png" alt="Tractor" class="w-16 h-16">
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-white">Farm one</h2>
                        <div class="flex gap-6 text-white mt-2">
                            <div>
                                <span class="text-sm opacity-75">Plan:</span>
                                <span class="font-bold ml-1">10M</span>
                            </div>
                            <div>
                                <span class="text-sm opacity-75">Actual:</span>
                                <span class="font-bold ml-1">50k</span>
                            </div>
                            <div>
                                <span class="text-sm opacity-75">Today</span>
                            </div>
                            @if($currentFarm)
                                <div>
                                    <span class="text-sm opacity-75">Employees:</span>
                                    <span class="font-bold">{{ $currentFarm->employees_count }}</span>
                                </div>
                            @else
                                <div class="text-white mt-2">
                                    <p>No farms available. <a href="{{ route('farms.create') }}" class="underline">Create one</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chart Area with Grid Lines -->
            <div class="h-32 px-6 pb-6">
                <div class="relative h-full">
                    <!-- Grid Lines -->
                    <div class="absolute inset-0 grid grid-cols-5 gap-4">
                        <div class="border-l border-white/20"></div>
                        <div class="border-l border-white/20"></div>
                        <div class="border-l border-white/20"></div>
                        <div class="border-l border-white/20"></div>
                        <div class="border-l border-white/20"></div>
                    </div>
                    <!-- Chart Canvas -->
                    <canvas id="farmChart" class="relative z-10"></canvas>
                </div>
            </div>

            <!-- Chart Labels -->
            <div class="flex justify-between px-6 py-2 bg-green-700/20 text-white text-sm">
                <span>Plan</span>
                <span>Actual</span>
                <span>Maintenance</span>
                <span>Permission</span>
                <span>Machine</span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Daily Execution Card -->
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Daily Execution</h3>
                    <span class="text-2xl font-bold text-green-600">92.6k</span>
                </div>
                <div class="h-24">
                    <canvas id="executionChart"></canvas>
                </div>
            </div>

            <!-- Total Purchase Card -->
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Total Purchase</h3>
                    <span class="text-2xl font-bold text-orange-500">97.5K</span>
                </div>
                <div class="h-24">
                    <canvas id="purchaseChart"></canvas>
                </div>
            </div>

            <!-- Machinery Status -->
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Machinery</h3>
                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold">163</span>
                    <div class="w-32 h-32">
                        <canvas id="machineryGauge"></canvas>
                    </div>
                </div>
            </div>

            <!-- Employees Card -->
            <div class="bg-white rounded-lg p-6 shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Employees</h3>
                    <span class="text-2xl font-bold text-blue-600">{{ $totalEmployees }}</span>
                </div>
                <div class="space-y-3">
                    @foreach($recentEmployees as $employee)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $employee->name }}</p>
                                <p class="text-sm text-gray-500">{{ $employee->position }}</p>
                            </div>
                            <span class="text-sm text-gray-600">
                                {{ $employee->hire_date->diffForHumans() }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">By Position:</span>
                    </div>
                    <div class="space-y-2 mt-2">
                        @foreach($employeesByPosition as $position => $count)
                            <div class="flex justify-between text-sm">
                                <span>{{ $position }}</span>
                                <span class="font-medium">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Farm Chart
        const farmCtx = document.getElementById('farmChart').getContext('2d');
        new Chart(farmCtx, {
            type: 'line',
            data: {
                labels: ['10k', '8.8k', '1k', '2k', '1k'],
                datasets: [{
                    label: 'Plan',
                    data: [10, 8.8, 1, 2, 1],
                    borderColor: 'rgba(255, 255, 255, 0.8)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true
                    },
                    x: {
                        display: false
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }
            }
        });

        // Execution Chart (Area Chart)
        const executionCtx = document.getElementById('executionChart').getContext('2d');
        new Chart(executionCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [65, 78, 66, 89, 76, 85],
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { display: false }
                },
                elements: { point: { radius: 0 } }
            }
        });

        // Purchase Chart (Area Chart)
        const purchaseCtx = document.getElementById('purchaseChart').getContext('2d');
        new Chart(purchaseCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [45, 82, 58, 75, 62, 79],
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { display: false }
                },
                elements: { point: { radius: 0 } }
            }
        });

        // Machinery Gauge
        const gaugeCtx = document.getElementById('machineryGauge').getContext('2d');
        new Chart(gaugeCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [75, 25],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.2)',
                        'rgba(34, 197, 94, 0.05)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                cutout: '80%',
                plugins: { legend: { display: false } }
            }
        });
    </script>
    @endpush
</x-app-layout> 