<?php

namespace Webcore\Elorest;

class ElorestService
{
    /*
    |--------------------------------------------------------------------------
    | EloREST - Halpers
    |--------------------------------------------------------------------------
    |
    | getDataQuery
    |
    */
    function getDataQuery($query, $data) {
        foreach($query as $key => $val) {
            if($key === 'paginate') {
                $paginate = $val;
            }
    
            if($key !== 'page') {
                $vals = [];
    
                if(is_array($val)) {
                    $vals = $val;
                } else {
                    array_push($vals, $val);
                }
    
                foreach($vals as $param) {
                    // if(preg_match_all('/\((.*?)\)/', $request->test, $match)) { // multi occurence
                    //     return $match;
                    // }
    
                    // if(preg_match('/(.*?)\((.*?)\)/', $param, $closureMatch)) { // handling closure, this only support once nested closure
                    //     $param = str_replace('('.$closureMatch[2].')', '', $param);
                    //     $param = explode(',', $param);
    
                    //     foreach($param as $par) {
                    //         if($par == $closureMatch[1]) {
                    //             $data = $data->$key([$closureMatch[1] => function($closureQuery) use ($closureMatch) {
                    //                 $closureParams = explode('=', trim($closureMatch[2]));
                    //                 $closureParam = $this->getDataQuery($closureQuery, $closureParams[0], $closureParams[1])['param'];
    
                    //                 call_user_func_array(array($closureQuery,$closureParams[0]), $closureParam);
                    //             }]);
                    //         } else {
                    //             $data = $data->$key($par);
                    //         }
                    //     }
                    if(preg_match_all("/\((([^()]*|(?R))*)\)/", $param, $closureMatch)) { // handling closure, support multiple nested closure deep
                        // $closureMatch[1] = [
                        //     "contactPerson(with=phone(where=city_code,021))(where=first_name,like,%test%)",
                        //     "organization(where=name,like,%test%)",
                        //     "product"
                        // ]
                        $arrayParam = $this->recursiveParam($param);
                        if(count($arrayParam) > 0) {
                            $data = $this->recursiveQuery($data, $key, $param, $closureMatch, $arrayParam);//['data'];
                        }
                    } else {
                        if(preg_match('/\[(.*?)\]/', $param, $arrParamMatch)) { // handling whereIn, due to whereIn params using whereIn('field', ['val_1', 'val_2', 'val_n']) syntax
                            $param = str_replace(','.$arrParamMatch[0], '', $param);
                            $param = explode(',', trim($param));
                            array_push($param, explode(',', trim($arrParamMatch[1])));
                        } else {
                            $param = explode(',', trim($param));
                        }
    
                        $data = call_user_func_array(array($data,$key), count($param) == 1 ? [$param] : $param);
                    }
    
                }
    
                if($key === 'paginate') {
                    $data->appends(['paginate' => $paginate])->links();
                }
            }
        }
    
        // return [
        //     'param' => $param,
        //     'data' => $data
        // ];
        return $data;
    }
    
    /*
    |--------------------------------------------------------------------------
    | EloREST - Halpers
    |--------------------------------------------------------------------------
    |
    | recursiveQuery
    |
    */
    protected function recursiveQuery($data, $key, $param, $matches, $arrayParam) {
        // $arr = [
        //     "with=phone(where=city_code,021),where=city_code,021",
        //     "where=first_name,like,%test%"
        // ]
        foreach($matches[1] as $item) {
            $param = str_replace('('.$item.')', '|', $param); // signing using '|' for closure
        }
    
        $params = explode(',', $param);
        foreach($params as $i => $param) {
            if (strpos($param, '|')) {
                $param = rtrim($param, '|');
                $items = explode('|', $arrayParam[$i]);
    
                if(count($items) > 1) {
                    $data = $data->$key([$param => function($query) use ($items) {
                        $this->recursiveClosure($query, $items);
                        // this, only support second nested closure deep
                        // foreach($items as $idx => $val) {
                        //     if($idx < count($items)-1) {
                        //         $closureParam = $items[$idx+1];
                        //         $closure = str_replace('('.$closureParam.')', '', $val);
    
                        //         $closureData = explode('=', trim($closure));
    
                        //         $query = $query->$closureData[0]([$closureData[1] => function($query) use ($closureParam) {
                        //             $closureParams = explode('=', trim($closureParam));
    
                        //             call_user_func_array(array($query,$closureParams[0]), explode(',', trim($closureParams[1])));
                        //         }]);
                        //     }
                        // }
                    }]);
                } else {
                    $item = $matches[1][$i];
    
                    $data = $data->$key([$param => function($query) use ($item) {
                        $params = explode('=', trim($item));
    
                        call_user_func_array(array($query,$params[0]), explode(',', trim($params[1])));
                    }]);
                }
            } else {
                $data = call_user_func_array(array($data,$key), [$param]);
            }
        }
    
        // return [
        //     'param' => $param,
        //     'data' => $data
        // ];
        return $data;
    }
    
    /*
    |--------------------------------------------------------------------------
    | EloREST - Halpers
    |--------------------------------------------------------------------------
    |
    | recursiveClosure
    |
    */
    protected function recursiveClosure($query, $items) {
        foreach($items as $idx => $val) {
            if($idx < count($items)-2) {
                $closureParam = $items[$idx+1];
                $closure = str_replace('('.$closureParam.')', '', $val);
                $closureData = explode('=', trim($closure));
    
                $query = $query->$closureData[0]([$closureData[1] => function($query) use ($items) {
                    $this->recursiveClosure($query, array_shift($items));
                }]);
            } else {
                if($idx < count($items)-1) {
                    $closureParam = $items[$idx+1];
                    $closure = str_replace('('.$closureParam.')', '', $val);
                    $closureData = explode('=', trim($closure));
    
                    $query = $query->$closureData[0]([$closureData[1] => function($query) use ($closureParam) {
                        $closureParams = explode('=', trim($closureParam));
    
                        call_user_func_array(array($query,$closureParams[0]), explode(',', trim($closureParams[1])));
                    }]);
                }
            }
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | EloREST - Halpers
    |--------------------------------------------------------------------------
    |
    | recursiveParam
    |
    */
    protected function recursiveParam($param) {
        $layer = 0;
        $arrayParam = [];
    
        preg_match_all("/\((([^()]*|(?R))*)\)/", $param, $matches);
        if (count($matches) > 1) {
            for ($i = 0; $i < count($matches[1]); $i++) {
                if (is_string($matches[1][$i])) {
                    if (strlen($matches[1][$i]) > 0) {
                        array_push($arrayParam, $matches[1][$i]);
    
                        $res = $this->recursiveParam($matches[1][$i], $layer + 1);
    
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
