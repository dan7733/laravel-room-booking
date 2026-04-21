<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Hiển thị danh sách phòng
    public function index()
    {
        $rooms = Room::paginate(10); // Thay vì Room::all()
        return view('admin.rooms.index', compact('rooms'));
    }

    // Form thêm phòng
    public function create()
    {
        return view('admin.rooms.create');
    }

    // Xử lý lưu phòng mới (BƯỚC 2: VALIDATION NẰM Ở ĐÂY)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1',
            'description' => 'nullable|string',
        ], [
            // Tùy chỉnh câu thông báo lỗi
            'name.required' => 'Tên phòng không được để trống.',
            'capacity.required' => 'Sức chứa không được để trống.',
            'capacity.numeric' => 'Sức chứa phải là một số.',
        ]);

        Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0 // Checkbox trạng thái
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Thêm phòng thành công!');
    }

    // Form sửa phòng
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    // Xử lý cập nhật phòng
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1',
        ]);

        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Cập nhật phòng thành công!');
    }

    // Xóa phòng
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Đã xóa phòng!');
    }
}
