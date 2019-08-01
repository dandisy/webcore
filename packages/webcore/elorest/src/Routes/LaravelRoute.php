<?php

namespace Webcore\Elorest\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Webcore\Elorest\Http\Request\IRequest;
use Webcore\Elorest\Http\Response\IResponse;
use Webcore\Elorest\Repository\IRepository;
// use Webcore\Elorest\Route\ARoute;
use Webcore\Elorest\Service\AService;
use Illuminate\Support\Facades\URL;

class LaravelRoute extends ARoute
{
    // public function __construct(IRequest $requestObj, IRepository $repositoryObj, IResponse $responseObj, AService $serviceObj)
    // {
    //     parent::__construct($requestObj, $repositoryObj, $responseObj, $serviceObj);
    // }

    public function get() {
        return Route::get('elorest/{namespaceOrModel}/{idOrModel?}/{id?}', function(Request $request, $namespaceOrModel, $idOrModel = NULL, $id = NULL) {
            return $this->getProcess($request, $namespaceOrModel, $idOrModel, $id);
        });
    }

    public function post() {
        return Route::post('elorest/{namespaceOrModel}/{model?}', function(Request $request, $namespaceOrModel, $model = null) {
            return $this->postProcess($request, $namespaceOrModel, $model);
        });
    }

    public function put() {
        return Route::put('elorest/{namespaceOrModel}/{idOrModel?}/{id?}', function(Request $request, $namespaceOrModel, $idOrModel = null, $id = null) {            
            return $this->putProcess($request, $namespaceOrModel, $idOrModel, $id);
        });
    }

    public function patch() {
        return Route::patch('elorest/{namespaceOrModel}/{idOrModel?}/{id?}', function(Request $request, $namespaceOrModel, $idOrModel = null, $id = null) {
            return $this->patchProcess($request, $namespaceOrModel, $idOrModel, $id);
        });
    }

    public function delete() {
        return Route::delete('elorest/{namespaceOrModel}/{idOrModel?}/{id?}', function(Request $request, $namespaceOrModel, $idOrModel = null, $id = null) {
            return $this->deleteProcess($request, $namespaceOrModel, $idOrModel, $id);
        });
    }

    // 404	Not Found (page or other resource doesn’t exist)
    // 401	Not authorized (not logged in)
    // 403	Logged in but access to requested area is forbidden
    // 400	Bad request (something wrong with URL or parameters)
    // 422	Unprocessable Entity (validation failed)
    // 500	General server error
    protected function getProcess($request, $namespaceOrModel, $idOrModel, $id) {
        // $user = $request->user();

        $modelNameSpace = 'App\\'.$namespaceOrModel;

        if($idOrModel == 'columns') {     
            // if(class_exists($modelNameSpace)) {       
                $data = new $modelNameSpace();
            // } else {
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }

            return $this->repositoryObj->getTableColumns($data);
        }
        if(is_numeric($idOrModel)) {
            // if(class_exists($modelNameSpace)) {
                $data = new $modelNameSpace();
            // } else {
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }

            return $this->repositoryObj->findById($idOrModel, $data);
        }
        if($idOrModel) {
            $modelNameSpace .= '\\'.$idOrModel;
            // if(class_exists($modelNameSpace)) {
                $data = new $modelNameSpace();
            // } else {
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }

            if($id == 'columns') {
                return $this->repositoryObj->getTableColumns($data);
            }
            if(is_numeric($id)) {
                return $this->repositoryObj->findById($id, $data);
            }
        } else {
            // if(class_exists($modelNameSpace)) {
                $data = new $modelNameSpace();
            // } else {
            //     // throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Resource not found');
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }
        }

        $input = $this->requestObj->requestAll($request);
        if(!$input) {
            return $this->repositoryObj->getAll($data);
        }

        // foreach($input as $key => $val) {
        //     if($key === 'paginate') {
        //         $paginate = $val;
        //     }
        //     if($key !== 'page') {
        //         $vals = [];

        //         if(is_array($val)) {
        //             $vals = $val;
        //         } else {
        //             array_push($vals, $val);
        //         }

        //         foreach($vals as $item) {
        //             // if(preg_match('/\[(.*?)\]/', $item, $match)) { // due to whereIn, the $val using [...] syntax
        //             //     $item = str_replace(','.$match[0], '', $item);
        //             //     $item = explode(',', trim($item));
        //             //     array_push($item, explode(',', trim($match[1])));
        //             // } else {
        //             //     $item = explode(',', item($item));
        //             // }

        //             // $data = call_user_func_array(array($data,$key), $item);

        //             $data = getQuery($data, $key, $item);//['data'];

        //         }

        //         if($key === 'paginate') {
        //             $data->appends(['paginate' => $paginate])->links();
        //         }
        //     }
        // }

        // return $data;

        return $this->serviceObj->getQuery($input, $data);
    }

    protected function postProcess($request, $namespaceOrModel, $model) {
        $user = $request->user();

        $modelNameSpace = 'App\\'.$namespaceOrModel;

        if(!$model) {
            // if(class_exists($modelNameSpace)) {
                $data = new $modelNameSpace();
            // } else {
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }
        } else {
            $modelNameSpace .= '\\'.$model;
            // if(class_exists($modelNameSpace)) {
                $data = new $modelNameSpace();
            // } else {
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }
        }

        $request->validate($modelNameSpace::$rules);

        $input = $this->requestObj->requestAll($request);

        // todo : authorization
        if(class_exists($modelNameSpace.'Policy')) {
            if ($user->can('create', $modelNameSpace)) {
                return $this->responseObj->response([
                    "message" => "The entity has been created",
                    "data" => $this->repositoryObj->createData($input, $data),
                    "status" => 201
                ]);
            } else {
                return $this->responseObj->response([
                    "message" => "Not authorized",
                    "error" => [
                        "code" => 102422,
                        "detail" => "User has no authorization to create entity"
                    ],
                    "status" => 422,
                    "params" => $input,
                    "links" => [
                        "self" => URL::current()
                    ]
                ], 422);
            }
        } else {
            return $this->responseObj->response([
                "message" => "The entity has been created",
                "data" => $this->repositoryObj->createData($input, $data),
                "status" => 201
            ]);
        }
    }

    protected function putProcess($request, $namespaceOrModel, $idOrModel, $id) {
        $user = $request->user();

        $modelNameSpace = 'App\\'.$namespaceOrModel;
        // if(class_exists($modelNameSpace)) {
            $data = new $modelNameSpace();
        // } else {
        //     return $this->responseObj->response([
        //         "message" => "Not found",
        //         "error" => [
        //             "code" => 102404,
        //             "detail" => "The resource was not found"
        //         ],
        //         "status" => 404,
        //         "params" => $input,
        //         "links" => [
        //             "self" => URL::current()
        //         ]
        //     ], 404);
        // }

        $request->validate($modelNameSpace::$rules);

        $input = $this->requestObj->requestAll($request);

        if($idOrModel) {
            if(is_numeric($idOrModel)) {
                $data = $this->repositoryObj->findById($idOrModel, $data);
            } else {
                $modelNameSpace .= '\\'.$idOrModel;
                // if(class_exists($modelNameSpace)) {
                    $data = new $modelNameSpace();
                // } else {
                //     return $this->responseObj->response([
                //         "message" => "Not found",
                //         "error" => [
                //             "code" => 102404,
                //             "detail" => "The resource was not found"
                //         ],
                //         "status" => 404,
                //         "params" => $input,
                //         "links" => [
                //             "self" => URL::current()
                //         ]
                //     ], 404);
                // }

                if($id && is_numeric($id)) {
                    $data = $this->repositoryObj->findById($id, $data);
                } else {
                    $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
                }
            }
        } else {
            $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
        }

        if($data) {
            // todo : authorization
            if(class_exists($modelNameSpace.'Policy')) {
                if ($user->can('update', $data)) {
                    // todo : use $this->serviceObj->getFormData() instead $input for responseFormatable REST API
                    $data = $this->repositoryObj->updateData($input, $data);
                    return $this->responseObj->response([
                        "message" => "The entity has been updated",
                        "data" => $data,
                        "status" => 200
                    ]);
                } else {
                    return $this->responseObj->response([
                        "message" => "Not authorized",
                        "error" => [
                            "code" => 102422,
                            "detail" => "User has no authorization to update this entity"
                        ],
                        "status" => 422,
                        "params" => $input,
                        "links" => [
                            "self" => URL::current()
                        ]
                    ], 422);
                }
            } else {
                // todo : use $this->serviceObj->getFormData() instead $input for responseFormatable REST API
                $data = $this->repositoryObj->updateData($input, $data);
                return $this->responseObj->response([
                    "message" => "The entity has been updated",
                    "data" => $data,
                    "status" => 200
                ]);
            }
        }
        
        return $this->responseObj->response([
            "message" => "Not found",
            "error" => [
                "code" => 102422,
                "detail" => "The entity was not found"
            ],
            "status" => 422,
            "params" => $input,
            "links" => [
                "self" => URL::current()
            ]
        ], 422);
    }

    protected function patchProcess($request, $namespaceOrModel, $idOrModel, $id) {
        $user = $request->user();

        $modelNameSpace = 'App\\'.$namespaceOrModel;
        // if(class_exists($modelNameSpace)) {
            $data = new $modelNameSpace();
        // } else {
        //     return $this->responseObj->response([
        //         "message" => "Not found",
        //         "error" => [
        //             "code" => 102404,
        //             "detail" => "The resource was not found"
        //         ],
        //         "status" => 404,
        //         "params" => $input,
        //         "links" => [
        //             "self" => URL::current()
        //         ]
        //     ], 404);
        // }

        $request->validate($modelNameSpace::$rules);

        $input = $this->requestObj->requestAll($request);
        
        if($idOrModel) {
            if(is_numeric($idOrModel)) {
                $data = $this->repositoryObj->findById($idOrModel, $data);
            } else {
                $modelNameSpace .= '\\'.$idOrModel;
                // if(class_exists($modelNameSpace)) {
                    $data = new $modelNameSpace();
                // } else {
                //     return $this->responseObj->response([
                //         "message" => "Not found",
                //         "error" => [
                //             "code" => 102404,
                //             "detail" => "The resource was not found"
                //         ],
                //         "status" => 404,
                //         "params" => $input,
                //         "links" => [
                //             "self" => URL::current()
                //         ]
                //     ], 404);
                // }

                if($id && is_numeric($id)) {
                    $data = $this->repositoryObj->findById($id, $data);
                } else {
                    $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
                }
            }
        } else {
            $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
        }

        if($data) {
            // todo : authorization
            if(class_exists($modelNameSpace.'Policy')) {
                if ($user->can('update', $data)) {
                    $this->repositoryObj->deleteData($data);

                    // todo : use $this->serviceObj->getFormData() instead $input for responseFormatable REST API
                    $data = $this->repositoryObj->insertData($input, $data);
                    return $this->responseObj->response([
                        "message" => "The entity has been updated",
                        "data" => $data,
                        "status" => 201
                    ]);
                } else {
                    return $this->responseObj->response([
                        "message" => "Not authorized",
                        "error" => [
                            "code" => 102422,
                            "detail" => "User has no authorization to update entity"
                        ],
                        "status" => 422,
                        "params" => $input,
                        "links" => [
                            "self" => URL::current()
                        ]
                    ], 422);
                }
            } else {
                $this->repositoryObj->deleteData($data);

                // todo : use $this->serviceObj->getFormData() instead $input for responseFormatable REST API
                $data = $this->repositoryObj->insertData($input, $data);
                return $this->responseObj->response([
                    "message" => "The entity has been updated",
                    "data" => $data,
                    "status" => 201
                ]);
            }
        }
        
        return $this->responseObj->response([
            "message" => "Not found",
            "error" => [
                "code" => 102422,
                "detail" => "The entity was not found"
            ],
            "status" => 422,
            "params" => $input,
            "links" => [
                "self" => URL::current()
            ]
        ], 422);
    }

    protected function deleteProcess($request, $namespaceOrModel, $idOrModel, $id) {
        $user = $request->user();

        $modelNameSpace = 'App\\'.$namespaceOrModel;

        // $request->validate($modelNameSpace::$rules);

        $input = $this->requestObj->requestAll($request);
        
        if($idOrModel) {
            if(is_numeric($idOrModel)) {
                // todo : check if $id exist and numeric
                // if(class_exists($modelNameSpace)) {
                    $data = new $modelNameSpace();
                // } else {
                //     // abort(404); // todo : custom message
                //     return $this->responseObj->response([
                //         "message" => "Not found",
                //         "error" => [
                //             "code" => 102404,
                //             "detail" => "The resource was not found"
                //         ],
                //         "status" => 404,
                //         "params" => $input,
                //         "links" => [
                //             "self" => URL::current()
                //         ]
                //     ], 404);
                // }

                $data = $this->repositoryObj->findById($idOrModel, $data);
            } else {
                $modelNameSpace .= '\\'.$idOrModel;
                // if(class_exists($modelNameSpace)) {
                    $data = new $modelNameSpace();
                // } else {
                //     // abort(404); // todo : custom message
                //     return $this->responseObj->response([
                //         "message" => "Not found",
                //         "error" => [
                //             "code" => 102404,
                //             "detail" => "The resource was not found"
                //         ],
                //         "status" => 404,
                //         "params" => $input,
                //         "links" => [
                //             "self" => URL::current()
                //         ]
                //     ], 404);
                // }

                $ns = explode('\\', $modelNameSpace);
                $nsCount = count($ns);
                $policy = '';
                foreach($ns as $key => $item) {
                    if($key == $nsCount-1) {
                        $policy .= '\Policies\\' . $item . 'Policy';
                    } else {
                        $policy .= '\\' . $item;
                    }
                }

                // todo : authorization
                if(class_exists($policy)) {
                    if ($user->can('delete', $data)) {
                        if($id && is_numeric($id)) {
                            $data = $this->repositoryObj->findById($id, $data);
                        } else {
                            $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
                        }
                    } else {
                        return $this->responseObj->response([
                            "message" => "Not authorized",
                            "error" => [
                                "code" => 102403,
                                "detail" => "User has no authorization to delete entity"
                            ],
                            "status" => 403,
                            "params" => $input,
                            "links" => [
                                "self" => URL::current()
                            ]
                        ], 403);
                    }
                } else {
                    if($id && is_numeric($id)) {
                        $data = $this->repositoryObj->findById($id, $data);
                    } else {
                        $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
                    }
                }
            }
        } else {
            // todo : check if $id exist and numeric
            // if(class_exists($modelNameSpace)) {
                $data = new $modelNameSpace();
            // } else {
            //     // abort(404); // todo : custom message
            //     return $this->responseObj->response([
            //         "message" => "Not found",
            //         "error" => [
            //             "code" => 102404,
            //             "detail" => "The resource was not found"
            //         ],
            //         "status" => 404,
            //         "params" => $input,
            //         "links" => [
            //             "self" => URL::current()
            //         ]
            //     ], 404);
            // }

            $data = $this->serviceObj->getQuery($this->requestObj->requestParamAll($request), $data)->first();
        }

        if($data) {
            $ns = explode('\\', $modelNameSpace);
            $nsCount = count($ns);
            $policy = '';
            foreach($ns as $key => $item) {
                if($key == $nsCount-1) {
                    $policy .= '\Policies\\' . $item . 'Policy';
                } else {
                    $policy .= '\\' . $item;
                }
            }

            // todo : authorization
            if(class_exists($policy)) {
                if ($user->can('delete', $data)) {
                    $data = $this->repositoryObj->deleteData($data);
                    return $this->responseObj->response([
                        "message" => "The entity has been deleted",
                        "data" => $data,
                        "status" => 200
                    ]);
                } else {
                    return $this->responseObj->response([
                        "message" => "Not authorized",
                        "errors" => [
                            "code" => 102403,
                            "detail" => "User has no authorization to delete entity"
                        ],
                        "status" => 403,
                        "params" => $input,
                        "links" => [
                            "self" => URL::current()
                        ]
                    ], 403);
                }
            } else {
                $data = $this->repositoryObj->deleteData($data);
                return $this->responseObj->response([
                    "message" => "The entity has been deleted",
                    "data" => $data,
                    "status" => 200
                ]);
            }
        }
   
        // abort(404);
        return $this->responseObj->response([
            "message" => "Not found",
            "error" => [
                "code" => 102422,
                "detail" => "The entity was not found"
            ],
            "status" => 422,
            "params" => $input,
            "links" => [
                "self" => URL::current()
            ]
        ], 422);
    }
}
