<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class HealthController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/health",
     *      description="疎通確認",
     *      operationId="Health",
     *      @OA\Response(
     *          response="200",
     *          description="HTTPステータスを返す",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="status",
     *                  description="ステータス",
     *                  type="integer"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK
        ]);
    }
}
