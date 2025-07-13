<?php

namespace App\Services;

use App\Entities\ReceiptEntity;
use App\Repositories\ReceiptRepository;
use App\Models\User;
use App\Models\Receipt;

class ReceiptService
{

    public function __construct(private ReceiptRepository $receiptRepository) {}

    public function index(): array
    {
        $receipt = $this->receiptRepository->all();
        return array_map(fn($entity) => $this->toEntity($entity), $receipt);
    }
    
    public function register(int $user_id, array $data): ReceiptEntity
    {
        $user = User::find($user_id);
        if (!$user) {
            abort(404, '작성자 정보를 찾을 수 없습니다.');
        }

        $data['writer'] = $user->id;
        $data['views'] = 0;
        $data['saved']= 0;
        $data['rate']= 0;

        $receipt = $this->receiptRepository->create($data);

        return $this->toEntity($receipt);
    }

    public function update(int $user_id, int $id, array $data): ReceiptEntity
    {
        $user = User::find($user_id);
        if (!$user) {
            abort(404, '작성자 정보를 찾을 수 없습니다.');
        }

        unset($data['writer'], $data['views'], $data['saved'], $data['rate']); // 보호 필드 제거

        $receipt = $this->receiptRepository->update($id, $data);

        return $this->toEntity($receipt);
    }

    public function show(int $id): ReceiptEntity
    {
        $receipt = $this->receiptRepository->find($id);
        return $this->toEntity($receipt);
    }

    public function delete(int $id): void
    {
        $this->receiptRepository->delete($id);
    }

    public function incrementViews(int $id): void
    {
        $receipt = $this->receiptRepository->find($id);

        $receipt->increment('views'); // Eloquent에서 자동 증가 처리
    }

    public function getByUser(int $user_id): array
    {
        $user = User::find($user_id);

        if (!$user) {
            abort(404, '해당 유저를 찾을 수 없습니다.');
        }

        $receipts = $this->receiptRepository->getByUserId($user_id);

        return array_map(fn($entity) => $this->toEntity($entity), $receipts);
    }

    private function toEntity($receipt): ReceiptEntity
    {
        return new ReceiptEntity(
            id: $receipt["id"],
            title: $receipt["title"],
            image_path: $receipt["image_path"] ?? null,
            description: $receipt["description"],
            ingredients: $receipt["ingredients"],
            steps: $receipt["steps"],
            servings: $receipt["servings"],
            cooking_time: $receipt["cooking_time"],
            spicy: $receipt["spicy"],
            saved: $receipt["saved"],
            views: $receipt["views"],
            rate: $receipt["rate"],
            recommend_side_menus: $receipt["recommend_side_menus"],
            writer: $receipt["writer"],
            comments: $receipt["comments"] ?? null,
            created_at: $receipt["created_at"],
            updated_at: $receipt["updated_at"]
        );
    }

}