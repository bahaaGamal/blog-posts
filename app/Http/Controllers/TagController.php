<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
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

        return View("tags.index",compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View("tags.create");
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

        return to_route('tags.index');
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
        Gate::authorize('view',$tag);
        return View("tags.edit", ['tag'=> $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);
        Gate::authorize('view',$tag);
        
        $data = $request->validate([
            'name'=>'required|string|min:3'
        ]);

        Tag::where('id',$id)->update($data);

        return to_route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return to_route('tags.index');
    }
}
