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
| Global API for direct model class under Models directory
|--------------------------------------------------------------------------
|
| URL encode :
| %3D for =
| %3E for >
| %3C for <
| %21 for !
| %25 for %
|
| Example :
| api/JSON/Page?query[a][function]=where&query[a][field]=name&query[a][operator]=%3D&query[a][value]=arrival&query[b][function]=get
|
*/
Route::get('JSON/{model}/{id?}', function(Request $request, $model, $id = NULL) {
    $modelNameSpace = 'App\Models\\'.$model;
    $data = new $modelNameSpace();

    if($id) {
        return $data->find($id);
    }

    foreach($request->all()['query'] as $query) {
        $queryFunc = $query['function'];

        if($queryFunc === 'latest') {
            $data = $data->latest();
        } else if(
                $queryFunc === 'select' || 
                $queryFunc === 'addSelect' || 
                $queryFunc === 'groupBy' || 
                $queryFunc === 'whereNull' || 
                $queryFunc === 'whereNotNull' || 
                $queryFunc === 'avg' || 
                $queryFunc === 'max'
            ) {
            $data = $data->$queryFunc(explode(',', $query['field']));
        } else if(
                $queryFunc === 'where' || 
                $queryFunc === 'orWhere' ||  
                $queryFunc === 'whereDate' ||  
                $queryFunc === 'whereMonth' ||  
                $queryFunc === 'whereDay' ||  
                $queryFunc === 'whereYear' ||  
                $queryFunc === 'whereTime' ||  
                $queryFunc === 'whereColumn' || 
                $queryFunc === 'having'
            ) {
            $data = $data->$queryFunc($query['field'], $query['operator'], $query['value']);
        }  else if($queryFunc === 'orderBy') {
            $data = $data->$queryFunc($query['field'], $query['value']);
        } else if(
                $queryFunc === 'selectRaw' || 
                $queryFunc === 'offset' || 
                $queryFunc === 'limit' || 
                $queryFunc === 'with' || 
                $queryFunc === 'whereIn' || 
                $queryFunc === 'whereNotIn' || 
                $queryFunc === 'whereBetween' || 
                $queryFunc === 'whereNotBetween' ||
                $queryFunc === 'whereRaw' ||
                $queryFunc === 'orWhereRaw' ||
                $queryFunc === 'orderByRaw' ||
                $queryFunc === 'havingRaw' ||
                $queryFunc === 'join' ||
                $queryFunc === 'leftJoin'
            ) {
            $data = $data->$queryFunc($query['value']);
        }
    }

    $lastQuery = end($request->all()['query'])['function'];

    if($lastQuery === 'first') {
        $data = $data->first();
    } else if($lastQuery === 'inRandomOrder') {
        $data = $data->inRandomOrder();
    } else if($lastQuery === 'count') {
        $data = $data->count();
    } else if($lastQuery === 'max') {
        $data = $data->max(explode(',', end($request->all()['query'])['field']));
    } else if($lastQuery === 'avg') {
        $data = $data->avg(explode(',', end($request->all()['query'])['field']));
    } else {
        $data = $data->get();
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