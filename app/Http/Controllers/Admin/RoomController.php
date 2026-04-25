<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Nếu checkbox bật thì status = 1, tắt thì = 0
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Thêm phòng mới thành công!');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Nếu checkbox bật thì status = 1, tắt thì = 0
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Cập nhật thông tin phòng thành công!');
    }

    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Đã xóa phòng thành công!');
    }

    // ĐÃ SỬA: Chuyển đổi trạng thái bằng số 1 và 0
    public function toggleStatus(Room $room)
    {
        // Nếu đang là 1 thì đổi thành 0, và ngược lại
        $newStatus = $room->status == 1 ? 0 : 1;
        $room->update(['status' => $newStatus]);

        $message = $newStatus == 1 ? 'Đã mở cửa phòng thành công!' : 'Đã khóa phòng để bảo trì!';
        return back()->with('success', $message);
    }
}