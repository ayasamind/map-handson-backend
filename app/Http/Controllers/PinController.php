<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pin\CreateRequest;
use App\Http\Resources\PinResource;
use App\UseCases\Pin\CreateAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PinController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/pins/create",
     *      tags={"ピンの作成処理"},
     *      description="ピンを新規登録する",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                 property="map_id",
     *                 description="マップのID",
     *                 type="integer"
     *              ),
     *              @OA\Property(
     *                   property="pins",
     *                   type="array",
     *                   @OA\Items(
     *                       @OA\Property(
     *                         property="title",
     *                         description="ピンのタイトル",
     *                         type="string"
     *                       ),
     *                       @OA\Property(
     *                         property="description",
     *                         description="ピンの概要",
     *                         type="string",
     *                         nullable=true
     *                       ),
     *                       @OA\Property(
     *                         property="lat",
     *                         description="ピンの緯度",
     *                         type="number",
     *                         format="double"
     *                       ),
     *                       @OA\Property(
     *                         property="lon",
     *                         description="ピンの経度",
     *                         type="number",
     *                         format="double"
     *                       ),
     *                   )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *         response="200",
     *         description="Items created successfully",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  description="メッセージ",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="pins",
     *                  description="ピンのリスト",
     *                  type="array",
     *                  @OA\Items(
     *                       @OA\Property(
     *                         property="title",
     *                         description="ピンのタイトル",
     *                         type="string"
     *                       ),
     *                       @OA\Property(
     *                         property="description",
     *                         description="ピンの概要",
     *                         type="string"
     *                       ),
     *                       @OA\Property(
     *                         property="lat",
     *                         description="ピンの緯度",
     *                         type="number",
     *                         format="double"
     *                       ),
     *                       @OA\Property(
     *                         property="lon",
     *                         description="ピンの経度",
     *                         type="number",
     *                         format="double"
     *                       ),
     *                   )
     *              ),
     *        )
     *      ),
     *      @OA\Response(
     *         response="422",
     *         description="Invalid input"
     *      ),
     * )
     */
    public function create(CreateRequest $request, CreateAction $action)
    {
        try {
            $pins = $action($request->getMap(), $request->validated());
            return new JsonResponse([
                'message' => 'ピンを作成しました',
                'pins' =>  PinResource::collection($pins),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'ピンの作成に失敗しました'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
