<?php 

namespace App\Repositories\PostRepository;

use App\Repositories\General\AbstractRepository;

use Illuminate\Support\Facades\Auth;
use App\Repositories\General\RepositoryInterface;
use App\Models\Post;
use App\Http\Requests\EditPostRequest;

class PostEloquentRepository extends AbstractRepository {
    function getModel()
    {
        return Post::class;
    }

    public function find($id, $columns = ['*'])
    {
    	$post = $this->model->find($id);
        $post->user;
        return $post;
    }

    public function update(array $input, $id ,$attribute = "id")
    {
        if (isset($input['post-image'])) {
            $image = $input['post-image'];
            $post_image = now()->toDateString() . '_' . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $post_image);
        } else {
            $post_image = $this->model->find($id)->image;
        }
        $this->model->where($attribute, $id)->update(
            [
                'title'   => $input['title'],
                'content' => $input['content'],
                'image' => $post_image,
            ]
        );
        return $this->model->find($id);
    }

    public function create(array $input)
    {
        $post = $this->model->create(
            [
                'title'   => $input['title'],
                'content' => $input['content'],
                'user_id' => Auth::user()->id,
                'image'   => 'NULL',
            ]
        );
        return $this->model->find($post->id);
    }

    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, 'LIKE', '%'. $value .'%');
    }
}