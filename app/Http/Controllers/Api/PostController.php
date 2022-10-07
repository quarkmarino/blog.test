<?php

namespace App\Http\Controllers\Api;

use App\Enums\PostTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class PostController extends Controller
{

    public function show(Post $post)
    {
        return strpos(request()->headers->get('Content-Type'), 'text/html') === 0
            ? view('partials.posts.table._row')->with('post', $post)
            : $post;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Posts\CreateRequest $request)
    {
        $user = Auth::user();

        $post = new Post($request->input());

        return $user->posts()->save($post)
            ? $post
            : response('Post update failed', 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Posts\UpdateRequest $request, Post $post)
    {
        $this->authorize('manage', $post);

        return $post->fill($request->input())->save()
            ? $post
            : response('Post updated failed', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('manage', $post);

        return $post->delete()
            ? $post
            : response('Post delete failed', 400);
    }
}
