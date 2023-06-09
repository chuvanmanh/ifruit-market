<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $banner = Banner::orderBy('id', 'DESC')->paginate(10);
        return view('backend.banner.index')->with('banners', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = Banner::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $status = Banner::create($data);
        if ($status) {
            request()->session()->flash('success', 'Banner successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred while adding banner');
        }

        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit')->with('banner', $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $banner = Banner::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        $status = $banner->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Banner successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred while updating banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $status = $banner->delete();
        if ($status) {
            request()->session()->flash('success', 'Banner successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
