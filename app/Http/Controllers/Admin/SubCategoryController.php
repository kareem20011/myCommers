<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainCats = MainCategory::all();
        $subCats = SubCategory::with('mainCategory')->get();
        return view('admin.pages.categories.sub.index')->with(['mainCats' => $mainCats, 'subCats' => $subCats]);
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
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'main_category_id' => 'required',
        ]);

        $subCat = SubCategory::create($request->only('title', 'main_category_id', 'status'));
        if ($request->has('image')) {
            $subCat->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return redirect()->route('subCategories.index', compact('subCat'));
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
        $subCat = SubCategory::with('mainCategory')->find($id);
        $mainCats = MainCategory::all();
        // return $subCat->mainCategory;

        return view('admin.pages.categories.sub.edit', compact('subCat', 'mainCats'));
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
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'main_category_id' => 'required',
        ]);
        $subCat = SubCategory::find($id);
        if ($request->has('image')) {

            $old = $subCat->getFirstMedia('images');
            if ($old) {
                $old->delete();
            }
            $subCat->addMediaFromRequest('image')->toMediaCollection('images');
        }
        $subCat->update($request->except('_token', '_method'));
        return redirect()->route('subCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::where('id', $id)->delete();
        return redirect()->back();
    }
}
