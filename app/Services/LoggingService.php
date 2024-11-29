<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoggingService
{
    public function log($action, $modelType = null, $modelId = null, $description = '', $properties = [], $level = 'info')
    {
        try {
            $log = ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'model_type' => $modelType,
                'model_id' => $modelId,
                'description' => $description,
                'properties' => $properties,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'level' => $level
            ]);

            // Log también en el sistema
            Log::channel('activity')->$level($description, [
                'user_id' => Auth::id(),
                'action' => $action,
                'properties' => $properties
            ]);

            return $log;
        } catch (\Exception $e) {
            Log::error('Error creating activity log: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSystemMetrics()
    {
        return [
            'memory_usage' => memory_get_usage(true),
            'cpu_load' => sys_getloadavg(),
            'disk_space' => disk_free_space('/'),
            'error_count' => ActivityLog::where('level', 'error')
                ->where('created_at', '>=', now()->subDay())
                ->count()
        ];
    }
} 