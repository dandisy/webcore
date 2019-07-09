<?php

namespace Webcore\Elorest\Helper;

class RecursiveQuery
{
    public function __construct()
    {
        //
    }

    /*
     * Invoke methods of object model
     *
     * @param Object Model $data
     * @param $key
     * @param $param
     * @param $matches
     * @param $arrayParam
     * @return Collection $data
     */
    public function invoke($data, $key, $param, $matches, $arrayParam) {
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
     * Handling nested query (closure) recursively in object model
     *
     * @param $query
     * @param $items
     * @return void
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
}
