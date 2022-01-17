<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Jobs\TestJob;
use App\Models\Post;
use App\Service\TestInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();

        return response()->json(
            new PostCollection($post)
        );
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create($request->all());
        return response()->json([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json(
            new PostResource($post)
        );
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([]);
    }

    public function userIdOnly(Post $post)
    {
        return response()->json([
            'user_id' => $post->user_id,
        ]);
    }

    public function serviceContainer()
    {
        $client = resolve(TestInterface::class);
        $client->sendReq();
        $client = resolve(TestInterface::class);
        $client->sendReq();
        return response()->json([
            'count' => $client->getCount(),
        ]);
    }

    public function event(Post $post)
    {
        event(new TestEvent($post));
        return response()->json([]);
    }

    public function queue(Post $post)
    {
        TestJob::dispatch($post);
        return response()->json([]);
    }
}
