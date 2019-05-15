<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Overtrue\LaravelWeChat\Facade as EasyWechat;

class UserController extends ApiController
{
    public function auth(Request $request)
    {
        $code = $request->input('code');
        $name = $request->input('nickName');
        $avatar = $request->input('avatarUrl');

        $miniProgram = EasyWechat::miniProgram();
        $session = $miniProgram->auth->session($code);

        if (!$openid = $session['openid']) {
            return $this->error([], '授权失败');
        }


        $user = User::query()->where('openid', $openid)->first();

        if (!$user) {
            $user = new User();
            $user->openid = $openid;
            $user->password = bcrypt(mt_rand(pow(10, 5), pow(10, 6) - 1));
        }

        $user->name = $name;
        $user->avatar = $avatar;
        $user->api_token = Str::random(64);
        $user->save();

        return $this->success($user->api_token);
    }
}
