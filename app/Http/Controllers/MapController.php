<?php

namespace App\Http\Controllers;

use App\Http\Requests\Map\CreateRequest;
use App\Http\Resources\MapResource;
use App\UseCases\Map\CreateAction;
use App\UseCases\Map\IndexAction;
use App\UseCases\Map\ShowAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class MapController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/maps/",
     *      description="マップ一覧",
     *      operationId="Map Index",
     *      @OA\Parameter(
     *          name="title",
     *          in="query",
     *          description="マップタイトル",
     *          @OA\Schema(
     *             type="string",
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="マップ一覧",
     *          @OA\JsonContent(
     *              property="maps",
     *              description="マップ一覧",
     *              type="object",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="id",
     *                      description="マップのID",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *              　      property="title",
     *              　      description="マップのタイトル",
     *              　      type="string"
     *              　  ),
     *                  @OA\Property(
     *              　      property="description",
     *              　      description="マップの概要",
     *              　      type="string"
     *              　  ),
     *                  @OA\Property(
     *                      property="pins",
     *                      description="ピン",
     *                      type="object",
     *  　　　　　　　　　     @OA\Property(
     *                          property="title",
     *                          description="ピンのタイトル",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          description="ピンの概要",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="lat",
     *                          description="ピンの緯度",
     *                          type="number",
     *                          format="double"
     *                      ),
     *                      @OA\Property(
     *                          property="lon",
     *                          description="ピンの経度",
     *                          type="number",
     *                          format="double"
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="center_lat",
     *                      description="中心の緯度",
     *                      type="number",
     *                      format="double"
     *                  ),
     *                  @OA\Property(
     *                      property="center_lon",
     *                      description="中心の経度",
     *                      type="number",
     *                      format="double"
     *                  ),
     *                  @OA\Property(
     *                      property="zoom_level",
     *                      description="ズームレベル",
     *                      type="integer"
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request, IndexAction $action): ResourceCollection
    {
        return MapResource::collection($action($request->get('title')));
    }

     /**
     * @OA\Get(
     *      path="/api/maps/{mapId}",
     *      description="マップ詳細",
     *      operationId="Map Details",
     *      @OA\Parameter(
     *          name="pin",
     *          in="query",
     *          description="ピン名",
     *          @OA\Schema(
     *             type="string",
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="マップ詳細",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="id",
     *                  description="マップのID",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="title",
     *                  description="マップのタイトル",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  description="マップの概要",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="pins",
     *                  description="ピン",
     *                  type="object",
     *  　　　　　　　　　 @OA\Property(
     *                      property="title",
     *                      description="ピンのタイトル",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      description="ピンの概要",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="lat",
     *                      description="ピンの緯度",
     *                      type="number",
     *                      format="double"
     *                  ),
     *                  @OA\Property(
     *                      property="lon",
     *                      description="ピンの経度",
     *                      type="number",
     *                      format="double"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="center_lat",
     *                  description="中心の緯度",
     *                  type="number",
     *                  format="double"
     *              ),
     *              @OA\Property(
     *                  property="center_lon",
     *                  description="中心の経度",
     *                  type="number",
     *                  format="double"
     *              ),
     *              @OA\Property(
     *                  property="zoom_level",
     *                  description="ズームレベル",
     *                  type="integer"
     *              )
     *          )
     *      )
     * )
     */
    public function show(int $mapId, Request $request, ShowAction $action): MapResource
    {
        return new MapResource($action($mapId, $request->get('pin')));
    }

    /**
     * @OA\Post(
     *      path="/api/maps/create",
     *      tags={"マップの作成処理"},
     *      description="マップを新規登録する",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                 property="title",
     *                 description="マップのタイトル",
     *                 type="string"
     *              ),
     *              @OA\Property(
     *                 property="description",
     *                 description="マップの詳細",
     *                 type="string"
     *              ),
     *              @OA\Property(
     *                 property="center_lat",
     *                 description="中心の緯度",
     *                 type="double"
     *              ),
     *              @OA\Property(
     *                 property="center_lon",
     *                 description="中心の軽度",
     *                 type="double"
     *              ),
     *              @OA\Property(
     *                 property="zoom_level",
     *                 description="ズームレベル",
     *                 type="integer"
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
     *              )
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
            $action($request->validated());
            return new JsonResponse([
                'message' => 'マップを作成しました',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'マップの作成に失敗しました'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
