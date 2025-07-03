<?php

namespace App\Http\Controllers\Admin\Slides;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Http\Requests\Admin\Slides\SlideRequest;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(SlideRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slides', 'public');
        }
        Slide::create($data);
        return redirect()->route('admin.slides.index')->with('success', 'Thêm slide thành công!');
    }

    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(SlideRequest $request, $id)
    {
        $slide = Slide::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slides', 'public');
        }
        $slide->update($data);
        return redirect()->route('admin.slides.index')->with('success', 'Cập nhật slide thành công!');
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Xoá slide thành công!');
    }
}
