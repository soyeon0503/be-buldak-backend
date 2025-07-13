<?php

namespace App\Repositories;

use App\Models\SideMenu;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SideMenuRepository
{

    public function all(): array
    {
        return SideMenu::all()->toArray();
    }
    
    public function create(array $data): SideMenu
    {
        return SideMenu::create($data);
    }

    public function update(int $id, array $data): SideMenu
    {
        $sideMenu = SideMenu::findOrFail($id);
        $sideMenu->update($data);
        return $sideMenu;
    }

    public function find(int $id): SideMenu
    {
        return SideMenu::findOrFail($id);
    }

    public function delete(int $id): void
    {
        $sideMenu = SideMenu::findOrFail($id);
        $sideMenu->delete();
    }
}