<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(
        protected CommentService $commentService
    ) {}

    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $comment = $this->commentService->create($data);
        return response()->json($comment, 201);
    }

    public function update(CommentRequest $request, int $id)
    {
        $comment = $this->commentService->get($id);

        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => '수정 권한이 없습니다.'], 403);
        }

        $updated = $this->commentService->update($comment, $request->validated());
        return response()->json($updated);
    }

    public function show(int $id)
    {
        $comment = $this->commentService->get($id);
        return response()->json($comment);
    }

    public function destroy(int $id)
    {
        $comment = $this->commentService->get($id);

        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => '삭제 권한이 없습니다.'], 403);
        }

        $this->commentService->delete($comment);
        return response()->json(['message' => '댓글이 삭제되었습니다.'], 204);
    }

    public function userComments(int $userId)
    {
        $comments = $this->commentService->getUserComments($userId);
        return response()->json($comments);
    }

    public function recipeComments(int $recipeId)
    {
        $comments = $this->commentService->getRecipeComments($recipeId);
        return response()->json($comments);
    }
}
