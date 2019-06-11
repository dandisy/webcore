<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


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
| https://your-domain-name/JSON/Post?leftJoin=comments,posts.id,comments.post_id&whereIn=category_id,[2,4,5]&select=*&get=
| https://your-domain-name/JSON/Post?join[]=authors,posts.id,authors.author_id&join[]=comments,posts.id,comments.post_id&whereIn=category_id,[2,4,5]&select=posts.*,authors.name as author_name,comments.title as comment_title&get=
| https://your-domain-name/JSON/Post?&with=author,comment&select=*&get=
| https://your-domain-name/JSON/Post?paginate=10&page=1
|
*/
Route::get('JSON/{model}/{id?}', function(Request $request, $model, $id = NULL) {
    $paginate = null;
    $query = $request->all();
    $modelNameSpace = 'App\Models\\'.$model;
    $data = new $modelNameSpace();

    if($id == 'columns') {
        return $data->getTableColumns();
    }

    if($id) {
        return $data->find($id);
    }
    if(!$query) {
        return $data->get();
    }

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

            foreach($vals as $item) {                    
                if(preg_match('/\[(.*?)\]/', $item, $match)) { // due to whereIn, the $val using [...] syntax
                    $item = str_replace(','.$match[0], '', $item);
                    $item = explode(',', $item);
                    array_push($item, explode(',',$match[1]));
                } else {
                    $item = explode(',', $item);
                }

                $data = call_user_func_array(array($data,$key), $item);
            }

            if($key === 'paginate') {
                $data->appends(['paginate' => $paginate])->links();
            }
        }
    }
    
    return $data;
})->middleware('auth:api');

Route::post('JSON/{model}', function(Request $request, $model) {
    $modelNameSpace = 'App\Models\\'.$model;
    $data = new $modelNameSpace();

    if($request->all()) {
        // return $data->insert($request->all());
        return $data->create($request->all());
    }
})->middleware('auth:api');

Route::put('JSON/{model}/{id}', function(Request $request, $model, $id) {
    $modelNameSpace = 'App\Models\\'.$model;
    $data = new $modelNameSpace();

    $data = $data->find($id);

    if($data && $request->all()) {
        return $data->update($request->all());
    }
})->middleware('auth:api');

Route::patch('JSON/{model}/{id}', function(Request $request, $model, $id) {
    $modelNameSpace = 'App\Models\\'.$model;
    $data = new $modelNameSpace();

    $data = $data->find($id);

    if($data && $request->all()) {
        $data->delete();

        return $data->insert($request->all());
    }
})->middleware('auth:api');

Route::delete('JSON/{model}/{id}', function($model, $id) {
    $modelNameSpace = 'App\Models\\'.$model;
    $data = new $modelNameSpace();

    $data = $data->find($id);

    if($data) {
        return $data->delete();
    }
})->middleware('auth:api');
// End global API for direct model class under Models directory

// using client credentials
Route::group(['middleware' => 'client_credentials'], function () {
    // your public route resource here!
});
