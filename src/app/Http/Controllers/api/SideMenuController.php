<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\SideMenu\SideMenuRequest;
use App\Http\Responses\SideMenuResponse;
use App\Http\Controllers\Controller;
use App\Services\SideMenuService;
use Illuminate\Http\Response;

class SideMenuController extends Controller
{
    public function __construct(private SideMenuService $sideMenuService) {}

    public function register(SideMenuRequest $request): SideMenuResponse
    {
        $sideMenuEntity = $this->sideMenuService->register($request->validated());
        return new SideMenuResponse($sideMenuEntity);
    }

    public function update(SideMenuRequest $request, int $id): SideMenuResponse
    {
        $sideMenuEntity = $this->sideMenuService->update($id, $request->validated());
        return new SideMenuResponse($sideMenuEntity);
    }

    public function index()
    {
        $sideMenuEntities = $this->sideMenuService->index();

        return response()->json([
            'data' => $sideMenuEntities,
        ]);
    }
 
    public function show(int $id): SideMenuResponse
    {
        $sideMenuEntity = $this->sideMenuService->show($id);
        return new SideMenuResponse($sideMenuEntity);
    }

    public function destroy(int $id): Response
    {
        $this->sideMenuService->delete($id);
        return response()->noContent();
    }
}
