<?php

namespace Webcore\Elorest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Webcore\Elorest\ElorestService;

class Elorest
{
    static function routes(array $middleware = null) {
        /*
        |--------------------------------------------------------------------------
        | EloREST - Using Password Grant
        |--------------------------------------------------------------------------
        |
        | Borrowing laravel eloquent commands syntax (methodes name & params),
        | including laravel pagination.
        |
        | Please, check again laravel documentation
        |
        | Example API query :
        | https://your-domain-name/api/elorest/Models/Post?leftJoin=comments,posts.id,comments.post_id&whereIn=category_id,[2,4,5]&select=*&get=
        | https://your-domain-name/api/elorest/Models/Post?join[]=authors,posts.id,authors.author_id&join[]=comments,posts.id,comments.post_id&whereIn=category_id,[2,4,5]&select=posts.*,authors.name as author_name,comments.title as comment_title&get=
        | https://your-domain-name/api/elorest/Models/Post?&with=author,comment&get=*
        | https://your-domain-name/api/elorest/Models/Post?&with=author(where=name,like,%dandisy%),comment&get=*
        | multi first nested closure deep
        | https://your-domain-name/api/elorest/Models/Post?&with=author(where=name,like,%dandisy%)(where=nick,like,%dandisy%),comment&get=*
        | second nested closure deep
        | https://your-domain-name/api/elorest/Models/Post?&with=author(with=city(where=name,like,%jakarta%)),comment&get=*
        | https://your-domain-name/api/elorest/Models/Post?&with[]=author(where=name,like,%dandisy%)&with[]=comment(where=title,like,%test%)&get=*
        | https://your-domain-name/api/elorest/Models/Post?paginate=10&page=1
        | class at App namespace
        | https://your-domain-name/api/elorest/User?paginate=10&page=1
        |
        */
        $get = Route::get('elorest/{model}/{id?}/{identity?}', function(Request $request, $model, $id = NULL, $identity = NULL) {
            $paginate = null;
            $query = $request->all();
            $modelNameSpace = 'App\\'.$model;

            if($id == 'columns') {
                $data = new $modelNameSpace();
                return $data->getTableColumns();
            }
            if(is_numeric($id)) {
                $data = new $modelNameSpace();
                return $data->find($id);
            }
            if($id) {
                $modelNameSpace .= '\\'.$id;
                $data = new $modelNameSpace();

                if($identity == 'columns') {
                    return $data->getTableColumns();
                }
                if(is_numeric($identity)) {
                    return $data->find($id);
                }
            } else {
                $data = new $modelNameSpace();
            }

            if(!$query) {
                return $data->get();
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

            //             $data = getDataQuery($data, $key, $item);//['data'];

            //         }

            //         if($key === 'paginate') {
            //             $data->appends(['paginate' => $paginate])->links();
            //         }
            //     }
            // }

            // return $data;

            $service = new ElorestService();
            return $service->getDataQuery($query, $data);
        });//->middleware('auth:api', 'throttle:60,1');

        $post = Route::post('elorest/{model}', function(Request $request, $model) {
            $modelNameSpace = 'App\\'.$model;
            $data = new $modelNameSpace();

            if($request->all()) {
                // return $data->insert($request->all());
                return $data->create($request->all());
            }

            return response(json_encode([
                "status" => "error",
                "message" => "data input not valid"
            ], 200))
                ->header('Content-Type', 'application/json');
        });//->middleware('auth:api', 'throttle:60,1');

        $put = Route::put('elorest/{model}/{id}', function(Request $request, $model, $id) {
            $modelNameSpace = 'App\\'.$model;
            $data = new $modelNameSpace();

            if($request->all()) {
                if($id) {
                    $data = $data->find($id);
                } else {
                    $service = new ElorestService();
                    $data = $service->getDataQuery($request->all(), $data)->first();
                }

                if($data) {
                    return $data->update($request->all());
                }
            }

            return response(json_encode([
                "status" => "error",
                "message" => "data input not valid"
            ], 200))
                ->header('Content-Type', 'application/json');
        });//->middleware('auth:api', 'throttle:60,1');

        $patch = Route::patch('elorest/{model}/{id}', function(Request $request, $model, $id) {
            $modelNameSpace = 'App\\'.$model;
            $data = new $modelNameSpace();

            if($request->all()) {
                if($id) {
                    $data = $data->find($id);
                } else {
                    $service = new ElorestService();
                    $data = $service->getDataQuery($request->all(), $data)->first();
                }

                if($data) {
                    $data->delete();

                    return $data->insert($request->all());
                }
            }

            return response(json_encode([
                "status" => "error",
                "message" => "data input not valid"
            ], 200))
                ->header('Content-Type', 'application/json');
        });//->middleware('auth:api', 'throttle:60,1');

        $delete = Route::delete('elorest/{model}/{id}', function(Request $request, $model, $id) {
            $modelNameSpace = 'App\\'.$model;
            $data = new $modelNameSpace();

            if($request->all()) {
                if($id) {
                    $data = $data->find($id);
                } else {
                    $service = new ElorestService();
                    $data = $service->getDataQuery($request->all(), $data)->first();
                }

                if($data) {
                    return $data->delete();
                }
            }

            return response(json_encode([
                "status" => "error",
                "message" => "data input not valid"
            ], 200))
                ->header('Content-Type', 'application/json');
        });//->middleware('auth:api', 'throttle:60,1');

        if($middleware) {
            $routes = ['get', 'post', 'put', 'patch', 'delete'];

            if(isset($middleware['only']))
            {
                foreach($middleware['only'] as $route) {
                    if(in_array($route, $routes)) {
                        ${$route}->middleware($middleware['middleware']);
                    }
                }
            } 
            else if(isset($middleware['except'])) 
            {
                $routes = array_diff($routes, $middleware['except']);
                foreach($routes as $route) {
                    ${$route}->middleware($middleware['middleware']);
                }
            }
            else
            {
                foreach($routes as $route) {
                    ${$route}->middleware($middleware['middleware']);
                }
            }
        }
    }
}
