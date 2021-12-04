<?php
class base64png
{
    function __construct($str)
    {
        $this->str = $str;
        $this->path = 'blob';
        $this->imagePaths=[];
    }

    function imagesArray($str)
    {
        $re = '/src="data:image\/png;base64,(.*?)"/m';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        return array_map(function ($match) {       //names array of files after saving
            return $match[1];
        }, $matches);
    }

    function saveImagesFromArray($imgArray)
    {
        return array_map(function ($png) {       //names array of files after saving
            return $this->base64_to_png_file($png);
        }, $imgArray);
    }


    function base64_to_png_file($base64_string)
    {
        $output_file_path = "$this->path/" . md5($base64_string) . ".png";
        $ifp = fopen($output_file_path, 'wb');
        fwrite($ifp, base64_decode($base64_string));
        fclose($ifp);
        return $output_file_path;
    }


    function splitImgStringForSrc($str)
    {
        $re = '/src="data:image\/png;base64,(.*?)"/m';
        $subst = '_sPlIt_';

        $result = preg_replace($re, $subst, $str);

        return explode("_sPlIt_", $result);
    }

    function insertSrcUrl($array, $fileNames)
    {
        $str2 = "";
        for ($i = 0; $i < (count($array) - 1); $i++) {
            $str2 .= $array[$i] . " src='{$fileNames[$i]}'";
        }

        $str2 .= end($array);

        return $str2;
    }

    function srcHTML(){     
    
        $finalStr = $this->insertSrcUrl(
            $this->splitImgStringForSrc($this->str),
            $this->imagePaths = $this->saveImagesFromArray($this->imagesArray($this->str))
        );
    
        return $finalStr;
    }  

}
