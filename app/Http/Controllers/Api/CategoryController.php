<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of category resources.
     */
    public function index(Request $request)
    {
        $categories = Category::where('user_id', $request->user()->id)->get();

        return $categories->toJson();
    }

    /**
     * Display the category resource.
     */
    public function show(Request $request, string $uuid)
    {
        $category = Category::where('user_id', $request->user()->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        return $category;
    }

     /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $user = $request->user();
        $title = $request->json()->title;
 
        $category = Category::create([
            'title' => $title,
            'user_id' => $user->id,
        ]);
        
        return $category;
    }

    /**
     * Update the category in storage.
     */
    public function update(CategoryRequest $request, string $uuid)
    {
        $user = $request->user();
        $title = $request->json->title();

        $category = Category::where('user_id', $request->user()->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $category->update(['title' => $title]);
        
        return $category;
    }

    /**
     * Remove the category from storage.
     */
    public function destroy(Request $request, string $uuid)
    {
        $category = Category::where('user_id', $request->user()->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $category->delete();

        return response('Ok', 200);
    }
}
