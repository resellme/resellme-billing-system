<?php

namespace Modules\CP\CWP;

use Modules\CP\CPInterface;
use Illuminate\Support\Str;
use App\Models\Hosting;
use Illuminate\Support\Facades\Crypt;

class CWPCP implements CPInterface
{
    /**
     * Create a hosting account.
     *
     * @return array 
     */
    public function create(Hosting $hosting)
    {
        $hostname = env('CWP_HOSTNAME');
        $server = env('CWP_IP');
        $key = env('CWP_KEY');
        $url = "https://" . $hostname . ":2304/v1/account";
        $username = strtolower(Str::random(6));
        $password = Str::random(10);
        $hosting->username = $username;
        $hosting->password = Crypt::encryptString($password);
        $hosting->save();
        $data = [
            "key"=> $key,
            "action" =>"add", 
            "domain" => 'instantlyagelessaustralia.net', 
            "user" => $username,
            "pass" => $password, 
            "email" => $hosting->user->email,
            "package" => $hosting->package,
            "inode" => "0",
            "limit_nproc" => "40",
            "limit_nofile" => "0",
            "server_ips" => $server,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt ($ch, CURLOPT_POST, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if ($response->status == 'Error') {
            throw new Exception($response->msj, 1);
        }

        return true;
    }
}