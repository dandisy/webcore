<?php

namespace Webcore\Elorest\Service;

use Webcore\Elorest\Helper\RecursiveParam;
use Webcore\Elorest\Helper\RecursiveQuery;

abstract class AService
{
    /*
     * Call methods to object model
     *
     * @param Object Model $data
     * @param $key
     * @param $param
     * @return Object query result
     */
    protected function callUserFuncArray($data, $key, $param) {
        return call_user_func_array(array($data,$key), $param);
    }

    /*
     * Invoke query of object model
     *
     * @param Object Model $data
     * @param $key
     * @param $vals
     * @return Object query result
     */
    protected function invokeQuery($data, $key, $vals, $gValue) {
        // for "with" of eloquent command
        if($key == 'with') {
            $params = explode(',', $vals);

            foreach($params as $param) {
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
                //                 $closureParam = $this->getQuery($closureQuery, $closureParams[0], $closureParams[1])['param'];

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
                    $recursiveParam = new RecursiveParam();
                    $arrayParam = $recursiveParam->invoke($param);
                    if(count($arrayParam) > 0) {
                        $recursiveQuery = new RecursiveQuery();
                        $data = $recursiveQuery->invoke($data, $key, $param, $closureMatch, $arrayParam);//['data'];
                    }
                } else {
                    $data = $this->processQuery($data, $key, $param);
                }
            }
        } else {
            if(preg_match('/\[(.*?)\]/', $vals, $arrParamMatch)) { // handling whereIn, due to whereIn params using whereIn('field', ['val_1', 'val_2', 'val_n']) syntax
                $params = str_replace(','.$arrParamMatch[0], '', $vals);
                $params = explode(',', trim($params));
                array_push($params, explode(',', trim($arrParamMatch[1])));
            } else {
                $params = explode(',', trim($vals));

                if($gValue) {
                    $params = array_map(function($valsVal) use ($gValue) {
                        if(substr($valsVal, 0, 6) === '$this.') {
                            $v = substr($valsVal, 6);

                            return $gValue->$v;
                        } else {
                            return $valsVal;
                        }
                    }, $params);
                }

                // if($key == 'get' || $key == 'count') {
                //     $vals = [$vals];
                // } else {
                //     $vals = $vals;
                // }
            }

            $data = $this->processQuery($data, $key, $params);
        }

        return $data;
    }

    /*
     * Get query result
     *
     * @param Object Request $input
     * @param Object Model $data
     * @return Object query result
     */
    abstract public function getQuery($input, $data);

    abstract protected function appendsPaginateLinks($input, $data);

    /*
     * Call pagination method of object model
     *
     * @param Object Model $data
     * @param $key
     * @param $param
     * @return Object query result
     */
    abstract protected function paginate($data, $key, $param);

    /*
     * Procesing queries including pagination to object model
     *
     * @param Object Model $data
     * @param $key
     * @param $param
     * @return Object query result
     */
    abstract protected function processQuery($data, $key, $param);
}
