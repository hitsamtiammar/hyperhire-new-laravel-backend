<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
use App\Models\Menu;
use Validator;

class MenuController extends Controller
{

    private function validateInput(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required']
        ]);
        return $validated;
    }

    public function index($id)
    {
        $menu = Menu::find($id);
        return [
            'status' => 1,
            'data' => new MenuResource($menu)
        ];

    }
    public function viewRoot()
    {
        $menus = Menu::where('parent', null)->orderBy('created_at', 'desc')->get();

        return [
            'status' => 1,
            'menus' => new MenuResource($menus)
        ];
    }

    public function create(Request $request)
    {
        $validated = $this->validateInput($request);

        if ($validated->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validated->errors()
            ], 400);
        }
        $name = $request->input('name');
        $parent = $request->input('parent', null);

        $new_menu = Menu::create([
            'name' => $name,
            'parent' => $parent
        ]);

        return [
            'status' => 1,
            'menu' => new MenuResource($new_menu)
        ];
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateInput($request);
        if ($validated->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validated->errors()
            ], 400);
        }

        $name = $request->input('name');
        $menu = Menu::find($id);

        if (empty($menu)) {
            return response([
                'status' => 0,
                'message' => 'Data not found'
            ], 404);
        }

        $menu->name = $name;

        $menu->save();

        return [
            'status' => 1,
            'updated_menu' => $menu
        ];
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (empty($menu)) {
            return response([
                'status' => 0,
                'message' => 'Data not found'
            ], 404);
        }

        $menu->delete();

        return [
            'status' => 1
        ];

    }
}
