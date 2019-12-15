<?php

namespace App\Repositories\UserRepository;

use App\Repositories\General\AbstractRepository;
use App\Repositories\General\RepositoryInterface;
use App\User;
use Hash;

class UserEloquentRepository extends AbstractRepository
{

    function getModel()
    {
        return User::class;
    }

    public function find($id, $columns = ['*'])
    {
        $user = $this->model->find($id);
        return $user;
    }

    public function update(array $input, $id ,$attribute = "id")
    { 
        if (isset($input['avatar'])) {

            $image = $input['avatar'];
            $avatar = now()->toDateString() . '_' . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $avatar);
        } else {
            $avatar = $this->model->find($id)->image;
        }
        $this->model->where($attribute, $id)->update(
            [
            'email'     => $input['email'],
            'username'  => $input['username'],
            'full_name' => $input['full_name'],
            'age'       => $input['age'],
            'avatar'    => $avatar,
            ]
        );
        return $this->model->find($id);
    }
    public function create(array $input)
    {
       if (isset($input['avatar'])) {
            $image = $input['avatar'];

            $image_name = now()->toDateString() . '_' . rand() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $image_name);

            $form_data = array(
                'username'  => $input['username'],
                'password'  => Hash::make('123456789'),
                'full_name' => $input['full_name'],
                'email'     => $input['email'],
                'age'       => $input['age'],
                'avatar'    => $image_name,
            );
        } else {
            $form_data = array(
                'username'  => $input['username'],
                'password'  => Hash::make('123456789'),
                'full_name' => $input['full_name'],
                'age'       => $input['age'],
                'email'     => $input['email'],
            );
        }

       return $this->model->create($form_data);
    }
}
