<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository\PostEloquentRepository;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    public function __construct(PostEloquentRepository $repo)
    {   
        // $this->middleware('auth');
        // $this->middleware('admin')->only('index'); 
        $this->post = $repo;
    }

    public function index(Request $request)
    {
        if (request()->ajax())
        {
            $data['posts'] = $this->post->findBy('title', $request->search)->paginate(9);
            $search_post = view('post_table', $data)->render();
            return response()->json(['html' => $search_post]);
        } else {
            if (isset($request->search)) {
                $data['posts'] = $this->post->findBy('title', $request->search)->paginate(9);
            } else {
                $data['posts'] = $this->post->paginate();
            }
            return view('posts.posts', $data);
        }
    }

    // public function create(Request $request)
    // {
    //     $this->post->create($request->all());
    //     return response()->json(['success'=>'Create a successful Post!']);
    // }

    public function store(CreatePostRequest $request)
    {
        $post = $this->post->create($request->all());
        return response()->json(['success' => 'Create a successful Post!', 'post' => $post]);
    }

    public function show($id)
    {
        return $this->post->find($id);
    }

    public function edit(EditPostRequest $request)
    {
        return $this->post->update($request->all(), $request->id);
    }

    public function destroy($id)
    {
        return $this->post->delete($id);
    }
}
