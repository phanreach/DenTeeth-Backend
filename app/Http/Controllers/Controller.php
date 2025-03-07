<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="DenTeeth API Documentation",
 *     version="1.0.0",
 *     description="API Documentation for DenTeeth"
 * )
 * 
 * @OA\Server(
 *     url="http://localhost",
 *     description="Development server"
 * )
 * 
 * @OA\Server(
 *     url="https://www.example.com",
 *     description="Production server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer"
 * )
 */
abstract class Controller
{
    //
}
