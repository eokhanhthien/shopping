<?php 
class JWTOKEN{
    public $key='';
    function CreateToken($array){
        $time = json_encode(['type' => 'jwt','time' => $array['time']]);
        $Base64UrlTime = str_replace(['+','/','='],['-','_',''], base64_encode($time));
        $this->key = $array['keys'];
        $info = json_encode(['id' => $array['info']['id']]);
        $Base64Urlinfo = str_replace(['+','/','='],['-','_',''], base64_encode($info));
        $hash = hash_hmac('sha256',$Base64UrlTime.'.'.$Base64Urlinfo,$this->key,false);
        $jwt = $Base64UrlTime.'.'.$Base64Urlinfo.'.'.'.'.$hash;
        return $jwt;
    }

}