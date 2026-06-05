<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {

         $events = Event::withCount('registrations')
        ->orderBy('sort_order')
        ->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {

            $path = $request->file('thumbnail')
                ->store('events', 'public');

            $data['thumbnail'] = $path;
        }

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Tạo sự kiện thành công');
    }

    public function edit($id)
    {
        $event =  Event::where('id', $id)->firstOrFail();

        return view('admin.events.edit', compact('event'));
    }

    // public function edit($id)
    // {
    //     $event = Event::findOrFail($id);

    //     return view(
    //         'admin.events.form',
    //         compact('event')
    //     );
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

            $data = $request->all();
         $event =  Event::where('id', $id)->firstOrFail();
        if ($request->hasFile('thumbnail')) {

            $path = $request->file('thumbnail')
                ->store('events', 'public');

            $data['thumbnail'] = $path;
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Cập nhật thành công');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return back()->with('success', 'Xóa thành công');
    }
    public function registrations($id)
        {
            $event = Event::findOrFail($id);

            $registrations = EventRegistration::where(
                'event_id',
                $id
            )
            ->latest()
            ->paginate(20);

            return view(
                'admin.events.registrations',
                compact(
                    'event',
                    'registrations'
                )
            );
        }
}
