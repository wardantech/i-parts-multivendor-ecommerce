<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuBuilderController extends Controller
{
    public function index($id)
    {
        $menu = Menu::with('categories')->findOrFail($id);
        return view('backend.menus.builder', compact('menu'));
    }

    public function itemOrder(Request $request, $id)
    {
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parantId)
    {
        foreach ($menuItems as $index => $item) {
            $menuItem = Category::findOrFail($item->id);
            $menuItem->update([
                'order_by' => $index + 1,
                'parent_id' => $parantId
            ]);

            if (isset($item->children)) {
                $this->orderMenu($item->children, $menuItem->id);
            }
        }
    }
}
