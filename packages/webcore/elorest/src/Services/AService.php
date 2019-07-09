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
    protected function invokeQuery($data, $key, $vals) {
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
                if(preg_match('/\[(.*?)\]/', $param, $arrParamMatch)) { // handling whereIn, due to whereIn params using whereIn('field', ['val_1', 'val_2', 'val_n']) syntax
                    $param = str_replace(','.$arrParamMatch[0], '', $param);
                    $param = explode(',', trim($param));
                    array_push($param, explode(',', trim($arrParamMatch[1])));
                } else {
                    $param = explode(',', trim($param));
                }

                // if($key === 'paginate') {
                //     $data = call_user_func_array(array($data,$key), $param);
                // } else {
                //     $data = call_user_func_array(array($data,$key), count($param) == 1 ? [$param] : $param);
                // }
                $data = $this->processQuery($data, $key, $param);
            }

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
