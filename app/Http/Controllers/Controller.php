<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Automattic\WooCommerce\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function woocommerce()
    {
        $woocommerce = new Client(
            'https://workethicstudio.com/',
            'ck_d0af19fdc508051a34b90ba681635e0b4bcc882a',
            'cs_4aea9aeb04000260238cdaa19995fe8ffdac2c80',
            [
                'version' => 'wc/v3',
            ]
        );

        return $woocommerce;
    }

    public function cart(){
        $data = cart::whereStatus('0')->get();

        return $data;
    }
    public function total(){
        $data = cart::whereStatus('0')->whereUserId(Auth::user()->id)->get();

        $tmp = 0;
        foreach ($data as $a){
            $tmp = $tmp + $a->subTotal;
        }
        return $tmp;
    }
}
