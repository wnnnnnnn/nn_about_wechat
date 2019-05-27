<?php
/**
 * Created by PhpStorm.
 * User: Mr wang
 * Date: 2019-05-24
 * Time: 10:50
 */
namespace Wn\Lib;

class Fun{
    public static function url_connect($url,...$param){
        if(count($param)<1){
            return $url;
        }
        foreach($param as $key => $value){
            $key == 0 ? $sign = '?' : $sign = '&';
            $url .= $sign.$value['key'].'='.$value['v'];
            return $url;
        }
    }
}