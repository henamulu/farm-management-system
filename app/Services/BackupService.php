<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Support\Facades\Log;

class BackupService
{
    public function createBackup()
    {
        try {
            $backupJob = new BackupJob();
            $backupJob->run();

            Log::info('Backup creado exitosamente');
            return true;
        } catch (\Exception $e) {
            Log::error('Error al crear backup: ' . $e->getMessage());
            return false;
        }
    }

    public function restoreFromBackup($backupFile)
    {
        try {
            // Verificar si el archivo existe
            if (!Storage::disk('backups')->exists($backupFile)) {
                throw new \Exception('Archivo de backup no encontrado');
            }

            // Restaurar la base de datos
            $sql = Storage::disk('backups')->get($backupFile);
            DB::unprepared($sql);

            Log::info('Backup restaurado exitosamente');
            return true;
        } catch (\Exception $e) {
            Log::error('Error al restaurar backup: ' . $e->getMessage());
            return false;
        }
    }

    public function exportData(array $tables)
    {
        try {
            $data = [];
            foreach ($tables as $table) {
                $data[$table] = DB::table($table)->get();
            }

            $fileName = 'export_' . Carbon::now()->format('Y-m-d_H-i-s') . '.json';
            Storage::disk('exports')->put($fileName, json_encode($data));

            return $fileName;
        } catch (\Exception $e) {
            Log::error('Error al exportar datos: ' . $e->getMessage());
            return false;
        }
    }
} 