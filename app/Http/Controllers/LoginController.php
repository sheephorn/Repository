<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\LoginService;
use App\Definitions\FunctionsDefinition;

class LoginController extends BaseController
{
    private $loginService;
    private $code;

    public function __construct(
        LoginService $loginService
        )
    {
        $this->loginService = $loginService;
        $this->code = app('Code');
    }

    /**
     * ログイン画面の表示
     * @param  Object $request Request
     * @return View           ログイン画面
     */
    public function getView(Request $request)
    {
        return view(FunctionsDefinition::VIEW[array_search($request->path(), FunctionsDefinition::URL)]);
    }

    /**
     * ログイン
     * ログイン可能な場合、ログイン先urlを返す
     *
     * @param  Object $request Request
     * @return Array           結果コード、リダイレクト先のurlを含む配列
     */
    public function login(Request $request)
    {
        return $this->loginService->login($request);
    }

    /**
     * 会員登録
     *
     * @param  Object $request Request
     * @return Array           結果コード含む配列
     */
    public function regist(Request $request)
    {
        return $this->loginService->regist($request);
    }
}
