<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeline;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::orderBy('sort_order')
            ->paginate(20);

        return view('admin.timeline.index', compact('timelines'));
    }

    public function create()
    {
        return view('admin.timeline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|max:50',
            'title' => 'required|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048'
        ]);
        $icon = null;
        if ($request->hasFile('icon')) {

            $icon = $request->file('icon')
                ->store('timeline-icons', 'public');
        }
        Timeline::create([
            'year' => $request->year,
            'title' => $request->title,
            'description' => $request->description,
            'icon' =>  $icon,
            'color' => $request->color,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.timeline.index')
            ->with('success', 'Created successfully');
    }

    public function edit($id)
    {
        $timeline = Timeline::findOrFail($id);

        return view('admin.timeline.edit', compact('timeline'));
    }

    public function update(Request $request, $id)
    {
        $timeline = Timeline::findOrFail($id);

        $request->validate([
            'year' => 'required|max:50',
            'title' => 'required|max:255',
        ]);
        $icon = null;
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon')
                ->store('timeline-icons', 'public');
        }
        $timeline->update([
            'year' => $request->year,
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $icon,
            'color' => $request->color,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.timeline.index')
            ->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        Timeline::findOrFail($id)->delete();

        return redirect()
            ->route('admin.timeline.index')
            ->with('success', 'Deleted successfully');
    }
}

