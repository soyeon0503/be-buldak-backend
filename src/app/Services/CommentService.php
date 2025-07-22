<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Support\Collection;

class CommentService
{
    public function __construct(
        protected CommentRepository $commentRepository
    ) {}

    public function create(array $data): Comment
    {
        return $this->commentRepository->create($data);
    }

    public function update(Comment $comment, array $data): Comment
    {
        return $this->commentRepository->update($comment, $data);
    }

    public function get(int $id): Comment
    {
        return $this->commentRepository->find($id);
    }

    public function delete(Comment $comment): void
    {
        $this->commentRepository->delete($comment);
    }

    public function getUserComments(int $userId): Collection
    {
        return $this->commentRepository->getByUserId($userId);
    }

    public function getRecipeComments(int $recipeId): Collection
    {
        return $this->commentRepository->getByRecipeId($recipeId);
    }
}
