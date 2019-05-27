<?php
/**
 * Created by PhpStorm.
 * User: Mr wang
 * Date: 2019-05-24
 * Time: 10:34
 */
namespace Wn\Logic;

use Wn\Lib\Fun;
class Login{
    private static $url = 'https://api.weixin.qq.com/sns/jscode2session';
    /**
     * @param string $code
     * @param array $conf
     * @return bool|string
     */
    public static function Login($code = '',array $conf=[]){
        if (empty($code)){
            return ['code'=>false,'msg'=>'code错误'];;
        }
        $param_array = [
            ['key'=>'appid','v'=>$conf['appid']],
            ['key'=>'secret','v'=>$conf['secret']],
            ['key'=>'js_code','v'=>$code],
            ['key'=>'grant_type','v'=>'authorization_code'],
        ];
        $url = Fun::url_connect(self::$url,$param_array);

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $wechat_encode = curl_exec($curl);
        curl_close($curl);
        // var_dump($wechat_encode);
        $wechat = json_decode($wechat_encode,true);
        if(isset($wechat['errcode'])){
            return ['code'=>false,'msg'=>'登录失败'];
        }else {
            return ['code' => true, 'msg' => '登录成功', 'openid' => $wechat['openid']];
        }
    }
}