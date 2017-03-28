<?php

namespace App\Services;

use App\Repositories\MemberRepository;
use App\Repositories\MemberAuthRepository;

/**
 * ログイン機能の管理クラス
 */
class LoginService
{
    protected $memberRepository;
    protected $memberAuthRepository;
    protected $code;

    public function __construct(
        MemberRepository $memberRepository,
        MemberAuthRepository $memberAuthRepository
        )
    {
        $this->memberRepository = $memberRepository;
        $this->memberAuthRepository = $memberAuthRepository;
        $this->code = app('Code');
    }

    /**
     * Login機能
     * @param  Object $condition Request
     * @return Array            リダイレクト先を含む配列
     */
    public function login($condition)
    {
        $attr = [
            'email' => $condition['email'],
        ];
        $member = $this->memberAuthRepository->find($attr)->first();
        if (isset($member)) {
            $correct = password_verify($condition['password'], $member->password);
            if ($correct) {
                $ret = [
                    'code' => '0',
                    'url' => '',
                ];
                session(json_decode(json_encode($member), true));
            } else {
                $ret = [
                    'code' => '1',
                ];
            }
        } else {
            $ret = [
                'code' => '1',
            ];
        }
        return $ret;
    }

    /**
     * ハッシュ化する
     * @param  String $str 文字列
     * @return String      ハッシュ化文字列
     */
    private function getPasswordHash($str)
    {
        $options = [
            'cost' => 15,
        ];
        $str = password_hash($str,  PASSWORD_DEFAULT, $options);
        return $str;
    }

    public function regist($condition)
    {
        try {
            $ret = \DB::transaction(function() use ($condition){
                $password = $this->getPasswordHash($condition['password']);
                $memberAttr = [
                    'name' => 'sosuke',
                ];
                $member = $this->memberRepository->save(['member_id' => 'create'], $memberAttr);
                $memberAuthAttr = [
                    'member_id' => $member->member_id,
                    'email' => $condition['email'],
                    'password' => $password,
                ];
                $memberAuth = $this->memberAuthRepository->save(['member_id' => $member->member_id], $memberAuthAttr);
                return [
                    'code' => $this->code::RESULT['OK'],
                    'message' => '',
                    'accessTime' => getAccessTime(),
                ];
            });
            session(['DEBUG-HEI' => 'OK']);

        } catch (\Exception $e) {
            createErrorLog($e, $condition);
            $ret = [
                'code' => $this->code::RESULT['NG'],
                'message' => '',
                'accessTime' => getAccessTime(),
            ];
        }
        return $ret;
    }
}
