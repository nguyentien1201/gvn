<?php


namespace App\Http\Controllers\Front;

use App\Models\EventRegistration;
use Illuminate\Http\Request;
class EventController
{
    public function register(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'name' => 'required|max:255',
        'phone' => 'required|max:30',
        'email' => 'nullable|email',
        'note' => 'nullable|max:1000',
    ]);
    $exists = EventRegistration::where('event_id', $request->event_id)
    ->where('phone', $request->phone)
    ->exists();
    if ($exists) {

        return response()->json([
            'success' => false,
            'message' => 'Số điện thoại này đã đăng ký.'
        ], 422);
    }
    EventRegistration::create([
        'event_id' => $request->event_id,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'note' => $request->note,
        'ip_address' => $request->ip(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Cảm ơn bạn đã đăng ký tham gia sự kiện'
    ]);
}

}
