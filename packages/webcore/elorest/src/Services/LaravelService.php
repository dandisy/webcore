<?php

namespace Webcore\Elorest\Service;

// use Webcore\Elorest\Service\AService;

class LaravelService extends AService
{
    private $formData = [];

    public function __construct()
    {
        //
    }

    public function getFormData() {
        return $this->formData;
    }

    public function getQuery($input, $data) {
        // $model = new \App\User();
        $model = $data;

        $resFormat = false;
        foreach($input as $key => $val) {
            if(substr($key, 0, 1) === "$") {
                $resFormat = true;
            } else {
                array_push($this->formData, [$key => $val]);
            }
        }

        $i = 0;
        $result = [];
        foreach($input as $key => $val) { // first level $input, ie : $data, $totalCount and any form data serialized
            if(substr($key, 0, 1) === "$") {
                $k = substr($key, 1);

                // todo : forach must included in processQueryRecursive() for suporting array many method, in second level like $totalCount = {...,...,......} 
                // foreach($val as $q1k => $q1v) { // second level
                    $this->processQueryRecursive($model, $val, $k, $result);
                // }
            } else {
                if(!$resFormat) {
                    // for Http GET verb
                    // if $key is not a method exist in $model, system will be error
                    $model = $this->runInvokeQuery($model, $key, $val);
    
                    $i++;
                    if(count($input) == $i) {
                        $result = $model;
                    }
                }
            }
        }

        return $result;
        // return $data;
    }

    protected function processQueryRecursive($model, $val, $k, &$result) {
        // this start in second level http request
        $result[$k] = [];
        foreach($val as $q1k => $q1v) { // second level
            // this check is_numeric($q1k) not change with check array indexed using array_values($q1k) === $q1k
            // for avoid foreach again in else clause of this conditional if clause
            if(is_numeric($q1k)) { // like in $data and $summary
                foreach($q1v as $q2k => $q2v) {
                    // if(is_numeric($q2k)) {
                    if(array_values($q1v) === $q1v) { // check array indexed not array associative, like in $data = [[{...},{...}]]
                        // start grouping
                        foreach($q1v[0] as $q3k => $q3v) { // $q1v[0] as parent (grouping)
                            $group = $this->runInvokeQuery($model, $q3k, $q3v);
                        }

                        foreach($group->get() as $idx => $value) {
                            $result[$k][$idx] = [];

                            foreach($q1v[1] as $q4k => $q4v) { // $q1v[1] as childs / contents (grouping)
                                if(substr($q4k, 0, 1) === "$") { // for seceond deep variable, like $key, $count, $items, etc in $data
                                    $kq1 = substr($q4k, 1);

                                    if(is_array($q4v)) { // for like "$count": {"count": "*"} and $items... and etc in $data
                                        // todo : change check count($q4v) > 1) with check array associative using array_values($q4v) !== $q4v
                                        if(count($q4v) > 1) { // for array many method, like in $items and $summary in $data
                                            $m = $model;
                                            foreach($q4v as $q5k => $q5v) {
                                                // if(is_numeric($q5k)) {
                                                if(array_values($q4v) === $q4v) { // check array indexed not array associative, like $summary in $data
                                                    $m6 = $model;
                                                    foreach($q5v as $q6k => $q6v) {        
                                                        $m6 = $this->runInvokeQuery($m6, $q6k, $q6v, $value);
                                                    }

                                                    $result[$k][$idx][$kq1][$q5k] = $m6;
                                                } else { // for array associative, like $items (1 level) in $data
                                                    $m = $this->runInvokeQuery($m, $q5k, $q5v, $value);
                                                }
                                            }

                                            // todo : this check array_values($q4v) !== $q4v may be over coding with check is_numeric($q5k)
                                            if(array_values($q4v) !== $q4v) { // check array $q4v is array associative
                                                $result[$k][$idx][$kq1] = $m;
                                            }
                                        } else { // for like "$count": {"count": "*"} and $items (multi level) like $items = [[{...},{...}]] in $data
                                            foreach($q4v as $q5k => $q5v) {
                                                // if(substr($q5k, 0, 1) === "$") {
                                                //     $result[$k][$idx][$kq1][substr($q5k, 1)] = [];

                                                //     //reqursive foreach
                                                // } else {
                                                //     $result[$k][$idx][$kq1] = $this->runInvokeQuery($model, $q5k, $q5v);
                                                // }
                                                $this->processQueryRecursive($model, $q4v, $kq1, $result[$k][$idx]);
                                            }
                                        }
                                    } else { // for like "$key" = "$this.name"
                                        if(substr($q4v, 0, 6) === '$this.') {
                                            $v = substr($q4v, 6);
                    
                                            $result[$k][$idx][$kq1] = $value->$v;
                                        } else {
                                            // string in value in group can only begin with $this.
                                        }
                                    }
                                } else {
                                    // in group can only variable with $ at the begining string of key name
                                }
                            }
                        }
                        // end grouping
                    } else {
                        if(substr($q2k, 0, 1) === "$") { // for like first level variable like $summary but with value = [{$var1: {...},...,......}]
                            $kq2 = substr($q2k, 1);

                            $result[$k][$q1k] = [];
                            $this->processQueryRecursive($model, $q1v, $kq2, $result[$k][$q1k]);
                        } else { // for array numeric index content array associative, like in $summary = [{...},{...},......]
                            $result[$k][$q1k] = $this->runInvokeQuery($model, $q2k, $q2v);
                        }
                    }
                }
            } else {
                if(count($val) > 1) { // if array many method, like {...,...,......}
                    $m1 = $model;
                    foreach($val as $q1k => $q1v) {
                        if(substr($q1k, 0, 1) === "$") {
                            $kq3 = substr($q1k, 1);

                            $this->processQueryRecursive($m1, $q1v, $kq3, $result[$k]);
                        } else {
                            $m1 = $this->runInvokeQuery($m1, $q1k, $q1v);
                        }
                    }

                    $result[$k] = $m1;

                    // if(substr($q1k, 0, 1) === "$") {
                    //     $kq3 = substr($q1k, 1);

                    //     $this->processQueryRecursive($m1, $q1v, $kq3, $result[$k]);
                    // } else {
                    //     $m1 = $this->runInvokeQuery($m1, $q1k, $q1v);
                    // }
                } else { //  // for object with one key value pair, {...}, like $totalCount
                    // $result[$k] = $this->runInvokeQuery($model, $q1k, $q1v);
                    if(substr($q1k, 0, 1) === "$") {
                        $kq4 = substr($q1k, 1);

                        $this->processQueryRecursive($model, $q1v, $kq4, $result[$k]);
                    } else {
                        $result[$k] = $this->runInvokeQuery($model, $q1k, $q1v);
                    }
                }
            }
        }

        // $result[$k] = $m1;

        return $result;
    }

    protected function runInvokeQuery($data, $key, $val, $gValue = null) {
        if($key !== 'page') {
            // $vals = explode(',', $val);

            // if($gValue) {
            //     $vals = array_map(function($valsVal) use ($gValue) {
            //         if(substr($valsVal, 0, 6) === '$this.') {
            //             $v = substr($valsVal, 6);

            //             return $gValue->$v;
            //         } else {
            //             return $valsVal;
            //         }
            //     }, $vals);
            // }

            // if($key == 'get' || $key == 'count') {
            //     $vals = [$vals];
            // } else {
            //     $vals = $vals;
            // }

            $data = $this->invokeQuery($data, $key, $val, $gValue);
            // $data = $this->invokeQuery($data, $key, $vals);
            // $data = $this->callUserFuncArray($data, $key, $vals);
        }

        if($key === 'paginate') {
            $this->appendsPaginateLinks($val, $data);
        }

        return $data;
    }

    protected function appendsPaginateLinks($input, $data) {
        // return $data->appends(['paginate' => $input])->links();
        $data->appends(['paginate' => $input])->links();
    }

    protected function paginate($data, $key, $param) {
        return $this->callUserFuncArray($data, $key, $param);
    }

    protected function processQuery($data, $key, $param) {
        if($key === 'paginate') {
            $data = $this->paginate($data, $key, $param);
        } else {
            if(is_array($param)) {
                $data = $this->callUserFuncArray($data, $key, count($param) == 1 ? [$param] : $param);
            } else {
                $data = $this->callUserFuncArray($data, $key, [$param]);
            }
        }

        return $data;
    }
}
