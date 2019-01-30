<?php
/**
 * Created by PhpStorm.
 * User: bobka
 * Date: 25.01.2019
 * Time: 15:59
 */

namespace App\Http\Controllers\Auth;

use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

class SteamLogin
{
    public $username = "6orik907";
    public $captcha_gid = -1;
    public $captcha_text;
    public $email_auth;
    public $email_steam_id;
    private $pass = "Innusa9303";
    private $login_url = "https://store.steampowered.com/login/dologin/";

    public function geturl($url, $ref, $cookie, $postdata, $header, &$info, &$output)
    {
        $player_id = auth()->user()->player_id;
        $cookie_file = dirname('tmp');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION	, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
        if ($cookie == 1)
        {
            curl_setopt($ch, CURLOPT_COOKIEJAR,  realpath($cookie_file) . "/tmp/cookie_" . $player_id);
            curl_setopt($ch, CURLOPT_COOKIEFILE, realpath($cookie_file) . "/tmp/cookie_" . $player_id);
        }
        if ($postdata)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            $postStr = "";
            foreach ($postdata as $key => $value)
            {
                if ($postStr)
                    $postStr .= "&";
                $postStr .= $key . "=" . $value;
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
        }
        curl_setopt($ch, CURLOPT_HEADER, $header);
        $info = curl_getinfo($ch);
        $output = curl_exec($ch);
        curl_close($ch);
    }

    public function login($data)
    {
        define('CRYPT_RSA_PKCS15_COMPAT', true);
        $publickey_exp = $data['publickey_exp'];
        $publickey_mod = $data['publickey_mod'];
        $rsa = new RSA();
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
        $n = new BigInteger($publickey_mod, 16);
        $e = new BigInteger($publickey_exp, 16);

        $key = array("modulus"=>$n, "publicExponent"=>$e);
        $rsa->loadKey($key, RSA::PUBLIC_FORMAT_RAW);
        $encryptedPassword = base64_encode($rsa->encrypt($this->pass, false));
        $encryptedPassword = str_replace('/','%2F',$encryptedPassword);
        $encryptedPassword = str_replace('+','%2B',$encryptedPassword);
        $encryptedPassword = str_replace('=','%3D',$encryptedPassword);

        $params = array(
            'username' => $this->username,
            'password' => $encryptedPassword,
            'rsatimestamp' => $data['timestamp'],
            'captcha_gid' => $this->captcha_gid,
            'captcha_text' => $this->captcha_text,
            'emailauth' => $this->email_auth,
            'emailsteamid' => $this->email_steam_id
        );
        $this->geturl($this->login_url, null , 1,  $params, 0, $info, $output);
        $response = json_decode($output, true);
        if ($data['captcha_needed'])
        {
            $captchaGid = $data['captcha_gid'];

            echo "<img src='https://store.steampowered.com/public/captcha.php?gid=$captchaGid'>";
        }
        return $response;
    }
}