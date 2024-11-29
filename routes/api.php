<?php

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