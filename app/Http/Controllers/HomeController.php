<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository\PostEloquentRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $post;

    public function __construct(PostEloquentRepository $repo)
    {
        $this->post = $repo;
    }

    public function index(Request $request)
    {
        if (request()->ajax())
        {
            $data['posts'] = $this->post->findBy('title', $request->search)->paginate(9);
            $search_post = view('post_paragraph', $data)->render();
            return response()->json([
                'html' => $search_post,
            ]);
        } else {
            if (isset($request->search)) {
                $data['posts'] = $this->post->findBy('title', $request->search)->paginate(9);
            } else {
                $data['posts'] = $this->post->paginate();
            }
            return view('posts/index', $data);
        }
    }

    public function show($id)
    {
        $post = $this->post->find($id);
        return view('posts.view_post',['post' => $post]);
    }
    public function getManagerUser()
    {
        return view('posts/user');
    }
}
