<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AjaxTagController extends Controller
{
    // public function __construct(){
    //     Gate::authorize('admin-control');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('id','DESC')->paginate(5);

        return View("ajax-tags.index",compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View("ajax-tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3'
        ]);

        Tag::create($request->all());

        return response()->json(['status' => 'success','message' => 'data added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return View("ajax-tags.edit", ['tag'=> $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'name'=>'required|string|min:3'
        ]);

        Tag::where('id',$id)->update($data);

        return response()->json(['status' => 'success','message' => 'data Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $ajax_tag)
    {
        $ajax_tag->delete();

        return response()->json(['status' => 'success','message' => 'data Deleted successfully']);
    }
}
