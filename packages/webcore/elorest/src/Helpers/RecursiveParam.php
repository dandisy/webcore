<?php

namespace Webcore\Elorest\Helper;

class RecursiveParam
{
    public function __construct()
    {
        //
    }

    /*
     * Parsing parentheses in url parameter recursively
     *
     * $param string $param
     * @return Array $arrayParam
     */
    public function invoke($param) {
        $layer = 0;
        $arrayParam = [];
    
        preg_match_all("/\((([^()]*|(?R))*)\)/", $param, $matches);
        if (count($matches) > 1) {
            for ($i = 0; $i < count($matches[1]); $i++) {
                if (is_string($matches[1][$i])) {
                    if (strlen($matches[1][$i]) > 0) {
                        array_push($arrayParam, $matches[1][$i]);
    
                        $res = $this->invoke($matches[1][$i], $layer + 1);
    
                        if(count($res) > 0) {
                            $arrayParam[$i] = $arrayParam[$i].'|'.$res[0];
                        }
                    }
                }
            }
        } else {
            array_push($arrayParam, $param);
        }
    
        return $arrayParam;
    }
}
