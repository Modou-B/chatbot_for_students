<?php

namespace App\Controller;

class TestDatei
{

    public function Test()
    {
        $var = [
            "netPrice" => 10,
            "grossPrice" => 16,
            "newTotal" => 25,
            "grossTotal" => 30
        ];

        $result = 0;

        foreach ($var as $key => $price) {
            if (strpos('Price',$key) !== false) {
                $result = $result + $price;
            }
        }
        dd($result);

        echo $result;
    }
}