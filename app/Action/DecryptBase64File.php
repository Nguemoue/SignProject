<?php

namespace App\Action;
use stdClass;
class DecryptBase64File {

    /**
     * fonction qui permet de retourner une blob d'une image
     * @param mixed $stream
     * @return stdClass<string,string>
     */
    public static function decrypt($stream):stdClass{
        $result = new stdClass;
        $image_parts = explode(";base64,", $stream);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $filename = uniqid() . '.' . '.jpg';
        $result->name = $filename;
        $result->content = $image_base64;
        return $result;
    }
}