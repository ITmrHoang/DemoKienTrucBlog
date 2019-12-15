<?php 

namespace App\Repositories\CommentRepository;

use App\Repositories\General\AbstractRepository;
use App\Repositories\General\RepositoryInterface;

class CommentEloquentRepository extends AbstractRepository {
    function getModel()
    {
        return \App\Models\Comment::class;
    }

}