<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('index');
        }
        return view('access.login');
    }

    public function postLogin(Request $request)
    {
       

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 200);
            // return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $username = $request->input('username');
            $password = $request->input('password');

            if (Auth::attempt(['username' => $username, 'password' => $password], $request->has('remember'))) {
                // return response()->json([
                //     'error' => false,
                //     'message' => 'success'
                // ], 200);
                // return redirect()->intended('/');
                if(auth()->user()->level == 'admin'){
                       return response()->json([
                    'error' => false,
                    'url'   => action('UsersController@index'),
                ], 200);
                  
                }
                else{
                    return response()->json([
                        'error' => false,
                        'url'   => action('HomeController@index'),
                    ], 200);
                }
            } else {
                $errors = new MessageBag(['errorlogin' => 'tên đăng nhập hoặc mật khẩu không đúng']);
                return response()->json([
                    'error'   => true,
                    'message' => $errors
                ], 200);
                // return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'username' => 'required|string|max:25',
                'password' => 'required|string|min:8',
            ],
            [
                'username.required' => 'Username là trường bắt buộc',
                'username.max' => 'Username không quá 25 ký tự',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            ]
        );
    }
}
