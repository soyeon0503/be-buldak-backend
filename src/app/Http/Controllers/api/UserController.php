<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\UserRequest;
use App\Http\Responses\UserResponse;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function register(UserRequest $request): UserResponse
    {
        $userEntity = $this->userService->register($request->validated());
        return new UserResponse($userEntity);
    }

    public function update(UserRequest $request, int $id): UserResponse
    {
        $userEntity = $this->userService->update($id, $request->validated());
        return new UserResponse($userEntity);
    }

    public function index(): array
    {
        $userEntities = $this->userService->index();
        return UserResponse::collection($userEntities);
    }
 
    public function show(int $id): UserResponse
    {
        $userEntity = $this->userService->show($id);
        return new UserResponse($userEntity);
    }

    public function destroy(int $id): Response
    {
        $this->userService->delete($id);
        return response()->noContent();
    }
}
