<?php

namespace App\Repositories\General;

interface RepositoryInterface
{
    public function all();

    public function find($id, $columns = ['*']);

    public function findBy($field, $value, $columns = array('*'));

    public function paginate($limit = null, $columns = array('*'));

    public function create(array $input);

    public function update(array $input, $id);
    
    public function delete($id);
}