<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Receipt\ReceiptRequest;
use App\Http\Responses\ReceiptResponse;
use App\Http\Controllers\Controller;
use App\Services\ReceiptService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;

class ReceiptController extends Controller
{
    public function __construct(
        private ReceiptService $receiptService
    ) {}

    /**
     * 레시피 등록
     * POST /api/receipt/{user}/
     */
    public function register(ReceiptRequest $request, int $user): ReceiptResponse
    {
        $receiptEntity = $this->receiptService->register($user, $request->validated());
        return new ReceiptResponse($receiptEntity);
    }

    /**
     * 레시피 수정
     * PUT /api/receipt/{id}/{user}
     */
    public function update(ReceiptRequest $request, int $receipt, int $user): ReceiptResponse
    {
        $receiptEntity = $this->receiptService->update($user, $receipt, $request->validated());
        return new ReceiptResponse($receiptEntity);
    }
    

    /**
     * 전체 레시피 조회
     * GET /api/receipts
     */
    public function index(): JsonResponse
    {
        $receiptEntities = $this->receiptService->index();

        return response()->json([
            'data' => $receiptEntities,
        ]);
    }

    /**
     * 단일 레시피 조회
     * GET /api/receipts/{id}
     */
    public function show(int $id): ReceiptResponse
    {
        $receiptEntity = $this->receiptService->show($id);

        return new ReceiptResponse($receiptEntity);
    }

    /**
     * 레시피 삭제
     * DELETE /api/receipts/{id}
     */
    public function destroy(int $id): Response
    {
        $this->receiptService->delete($id);

        return response()->noContent();
    }

    /**
     * 레시히 조회수 증가
     * PATCH /api/receipts/{id}/views
     */
    public function incrementViews(int $id): Response
    {
        $this->receiptService->incrementViews($id);

        return response()->noContent(); // 또는 조회된 뷰 수를 리턴해도 됨
    }
}
