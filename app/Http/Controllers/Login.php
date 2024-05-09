<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    /**
     * 登录
     * @param Request $request
     * @return JsonResponse
     */
    public function loginIn(Request $request): JsonResponse
    {
        $input = $request->only(['account', 'password']);
        # 验证数据
        $validator = Validator::make(
            $input,
            [
                'account' => ['required'],
                'password' => ['required']
            ],
            [
                'account' => '账号为必填',
                'password' => '密码为必填'
            ],
        );
        # 验证失败直接返回
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(create_response_data($errors->first(), false));
        }
        # 验证用户登录信息是否匹配
        $uid = User::verifyUserLogin($input['account'], $input['password']);
        if (!$uid) {
            return response()->json(create_response_data('用户名或者密码错误', false));
        }
        # 仅存入用户的id
        # 生成Token
        $token = new Token();
        $token_str = $token->createToken(['id' => $uid]);
        # 返回token
        return response()->json(create_response_data('登录成功', true, ['token' => $token_str]));
    }


    /**
     *  获取用户登录权限信息
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserAuth(Request $request): JsonResponse
    {
        $user_id = $request->input('token_uid');
        $login_info = User::getUserLoginInfo($user_id);
        return response()->json(create_response_data('成功', true, $login_info));
    }

    // 注册
    public function register(Request $request): JsonResponse
    {
        # 获取用户注册信息
        $input = $request->only(['account', 'password', 're_password', 'name']);
        # 验证数据
        $validator = Validator::make(
            $input,
            [
                'account' => ['required', 'regex:/^\w+$/'],
                'password' => ['required'],
                're_password' => ['required', 'same:password'],
                'name' => ['required'],
            ],
            [
                'account.required' => '账号为必填',
                'account.regex' => '账号需要由字母、数字、_下划线组成',
                'password.required' => '密码为必填',
                're_password.required' => '请确认密码',
                're_password.same' => '两次密码不一致',
                'name.required' => '请输入名字',
            ],
        );
        # 验证失败直接返回
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(create_response_data($errors->first(), false));
        }
        # 确定账号是否被注册
        $hv_account = User::hvAccount($input['account']);
        if ($hv_account) {
            return response()->json(create_response_data('该账号已被注册', false));
        }
        # 处理一下重复密码
        unset($input['re_password']);
        # 注册账号
        $res = User::register($input);
        if ($res) {
            return response()->json(create_response_data('注册成功'));
        } else {
            return response()->json(create_response_data('注册失败，请重试', false));
        }
    }


}
