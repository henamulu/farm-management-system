<?php

use App\Http\Controllers\API\StockController;
use App\Http\Controllers\API\WeatherController;
use App\Http\Controllers\API\NotificationController;

/**
 * @OA\Get(
 *     path="/weather/current",
 *     summary="Get current weather",
 *     tags={"Weather"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="latitude",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="number")
 *     ),
 *     @OA\Parameter(
 *         name="longitude",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="number")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Current weather data"
 *     )
 * )
 */
Route::get('/weather/current', [WeatherController::class, 'getCurrentWeather']);

/**
 * @OA\Get(
 *     path="/weather/forecast",
 *     summary="Get weather forecast",
 *     tags={"Weather"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Weather forecast data"
 *     )
 * )
 */
Route::get('/weather/forecast', [WeatherController::class, 'getForecast']);

/**
 * @OA\Get(
 *     path="/stocks",
 *     summary="Get stock items",
 *     tags={"Stock"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of stock items"
 *     )
 * )
 */
Route::apiResource('stocks', StockController::class);

/**
 * @OA\Get(
 *     path="/farms",
 *     summary="Obtener lista de granjas",
 *     tags={"Granjas"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de granjas exitosa",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Farm")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado"
 *     )
 * )
 */
Route::get('/farms', [FarmController::class, 'index']);

/**
 * @OA\Post(
 *     path="/farms",
 *     summary="Crear nueva granja",
 *     tags={"Granjas"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/FarmRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Granja creada exitosamente",
 *         @OA\JsonContent(ref="#/components/schemas/Farm")
 *     )
 * )
 */
Route::post('/farms', [FarmController::class, 'store']);

// Add farm-specific routes with middleware
Route::middleware(['auth:sanctum', 'check.farm.access'])->group(function () {
    Route::get('farms/{farm}/stocks', [StockController::class, 'index']);
    Route::get('farms/{farm}/weather', [WeatherController::class, 'getCurrentWeather']);
});

// Notification routes
Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount']);
Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']); 