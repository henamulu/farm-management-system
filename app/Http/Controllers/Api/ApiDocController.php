<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Gestión Agrícola",
 *     description="Documentación de la API del sistema de gestión agrícola",
 *     @OA\Contact(
 *         email="soporte@sistema-agricola.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="/api/v1",
 *     description="Servidor Principal"
 * )
 * 
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth"
 * )
 */
class ApiDocController extends Controller
{
} 