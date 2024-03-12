<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainCats = MainCategory::all();
        return view('admin.pages.categories.main.index', compact('mainCats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'image' => 'nullable|mimes:jpg,jpag,png',
            'status' => 'required',
        ]);
        $mainCat = MainCategory::create($request->only('title', 'status'));
        if ($request->has('image')) {
            $mainCat->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainCat = MainCategory::find($id);
        return view('admin.pages.categories.main.edit', compact('mainCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:2',
            'image' => 'nullable|mimes:jpg,jpag,png',
            'status' => 'required',
        ]);

        $mainCat = MainCategory::find($id);
        $mainCat->update($request->except('_method', '_token'));
        if ($request->has('image')) {
            $old = $mainCat->getFirstMedia('images');
            if ($old) {
                $old->delete();
            }
            $mainCat->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return redirect()->route('mainCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MainCategory::where('id', $id)->delete();
        return redirect()->back();
    }
}
