<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository\UserEloquentRepository;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use Response;

class UsersController extends Controller
{
    private $user;

    public function __construct(UserEloquentRepository $repouser)
    {
        $this->user = $repouser;
        $this->middleware('auth');
    }
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of($this->user->all('*'))
                ->addColumn('action', 'action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('posts.user');
    }

    public function store(UserRequest $request)
    {
        $this->user->create($request->all());

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function update(EditUserRequest $request)
    {
        $this->user->update($request->all(), $request->user_id);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = $this->user->find($where)->first();

        return Response::json($user);
    }

    public function destroy($id)
    {
        $user = $this->user->delete($id);

        return Response::json($user);
    }
}
