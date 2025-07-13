<?php
namespace App\Services;

use App\Entities\SideMenuEntity;
use App\Repositories\SideMenuRepository;

class SideMenuService
{
    public function __construct(private SideMenuRepository $sideMenuRepository) {}

    public function index(): array
    {
        $sideMenu = $this->sideMenuRepository->all();
        return array_map(fn($entity) => $this->toEntity($entity), $sideMenu);
    }
    
    public function register(array $data): SideMenuEntity
    {
        $sideMenu = $this->sideMenuRepository->create($data);

        return $this->toEntity($sideMenu);
    }

    public function update(int $id, array $data): SideMenuEntity
    {
        $sideMenu = $this->sideMenuRepository->update($id, $data);
        return $this->toEntity($sideMenu);
    }

    public function show(int $id): SideMenuEntity
    {
        $sideMenu = $this->sideMenuRepository->find($id);
        return $this->toEntity($sideMenu);
    }

    public function delete(int $id): void
    {
        $this->sideMenuRepository->delete($id);
    }

    private function toEntity($sideMenu): SideMenuEntity
    {
        return new SideMenuEntity(
            id: $sideMenu["id"],
            title: $sideMenu["title"],
            description: $sideMenu["description"] ?? '' ,
            image_path: $sideMenu["image_path"] ?? null,
        );
    }
}