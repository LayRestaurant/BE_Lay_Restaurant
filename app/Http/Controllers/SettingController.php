<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Lấy tất cả các cài đặt
    public function index()
    {
        $settings = Setting::all();
        return response()->json($settings);
    }

    // Tạo mới một cài đặt
    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|string',
            'language' => 'required|string',
            'notifications_enabled' => 'required|boolean',
            'max_items' => 'required|integer',
        ]);

        $setting = Setting::create($request->all());
        return response()->json($setting, 201);
    }

    // Lấy một cài đặt theo ID
    public function show($id)
    {
        $setting = Setting::findOrFail($id);
        return response()->json($setting);
    }

    // Cập nhật một cài đặt theo ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'theme' => 'sometimes|required|string',
            'language' => 'sometimes|required|string',
            'notifications_enabled' => 'sometimes|required|boolean',
            'max_items' => 'sometimes|required|integer',
        ]);

        $setting = Setting::findOrFail($id);
        $setting->update($request->all());
        return response()->json($setting);
    }

    // Xóa một cài đặt theo ID
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return response()->json(null, 204);
    }
}
