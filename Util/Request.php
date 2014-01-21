<?php
namespace Filix\JpushBundle\Util;

/**
 * Request
 *
 * @author Filix
 * @email syp.syl@gmail.com
 */
class Request
{

    protected $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function post($url, $data)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url); 
        curl_setopt($this->curl, CURLOPT_HEADER, 0); //设置header
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_POST, 1); //post提交方式
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        return curl_exec($this->curl); 
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

}
