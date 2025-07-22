<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Collection;

class CommentRepository
{
    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);
        return $comment;
    }

    public function find(int $id): Comment
    {
        return Comment::with('user', 'recipe')->findOrFail($id);
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }

    public function getByUserId(int $userId): Collection
    {
        return Comment::with('recipe')->where('user_id', $userId)->latest()->get();
    }

    public function getByRecipeId(int $recipeId): Collection
    {
        return Comment::with('user')->where('recipe_id', $recipeId)->latest()->get();
    }
}
