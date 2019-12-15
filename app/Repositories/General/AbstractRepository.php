<?php

namespace App\Repositories\General;

use App\Repositories\General\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface {

    protected $model;

    public function __construct() {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        return $this->model = app()->make($this->getModel());
    }

    public function all($columns = array('*')){

    	  return $this->model->get($columns);
    }

    public function find($id, $columns = ['*'])
    {
    	return $this->model->findOrFail($id, $columns);
    }

    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function paginate($perPage = 9, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }
    
    public function create(array $input)
    {
    	return $this->model->create($input);
    }

    public function update(array $input, $id ,$attribute = "id")
    {
        $this->model->where($attribute, "=", $id)->update($input);
        return $this->model->find($id);
    }
    
    public function delete($id)
    {
        $data = $this->model->find($id);
        $this->model->destroy($id);
        return $data;
    }
}
