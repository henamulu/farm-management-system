<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Farm",
 *     description="Modelo de Granja",
 *     @OA\Xml(name="Farm")
 * )
 */
class FarmResource
{
    /**
     * @OA\Property(type="integer", format="int64", example=1)
     */
    private $id;

    /**
     * @OA\Property(type="string", maxLength=255, example="Granja Norte")
     */
    private $name;

    /**
     * @OA\Property(type="string", example="Calle Principal 123")
     */
    private $location;

    /**
     * @OA\Property(type="number", format="float", example=100.5)
     */
    private $size;

    /**
     * @OA\Property(type="string", format="date-time")
     */
    private $created_at;

    /**
     * @OA\Property(type="string", format="date-time")
     */
    private $updated_at;
} 