<?php

namespace Webcore\DXDataGrid;

// use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Webcore\DXDataGrid\Utils\Filter;

class DXDataGrid
{
    public static function routes() {
        Route::get('/dx-server/{modelNameSpace}/{model?}', function (Request $request, $modelNameSpace, $model = null) {
            $nameSpace = 'App\Models\\' . $modelNameSpace . ($model ? '\\' . $model : '');
            $model = new $nameSpace();
        
            // $data['request'] = $request->all(); // only for checking request params from dxDataGrid client
        
            if($request->sort) {
                $model = $model->orderBy(
                    (json_decode($request->sort, true))[0]['selector'],
                    (json_decode($request->sort, true))[0]['desc'] ? 'desc' : 'asc'
                );
            }
        
            if($request->filter) {
                $filters = json_decode($request->filter, true);
                // $data['filter'] = $filters;
        
                if(Filter::check($filters)) {
                    $model = Filter::invoke($model, $filters);
                } else {
                    $conjunction = 'and';
                    foreach($filters as $filter) {
                        if(is_array($filter)) {
                            if(Filter::check($filter)) {
                                $model = Filter::invoke($model, $filter, $conjunction);
                            } else {
                                // if($conjunction === 'and') { // due to only $conjunction = 'and' in this level
                                    $model = $model->where(function($query) use ($filter) {
                                        if(Filter::check($filter)) {
                                            // Filter::invoke($query, $filter, $conjunction); // due to always checkFilter($filter) return false this level
                                        } else {
                                            $conjunction = $filter[1];
                                            foreach($filter as $dfilter) {
                                                // if(is_array($dfilter)) { // due to always array $dfilter in this level
                                                    if(Filter::check($dfilter)) {
                                                        Filter::invoke($query, $dfilter, $conjunction);
                                                    }
                                                // } else {
                                                //     $conjunction = $dfilter;
                                                // }
                                            }
                                        }
                                    });
                                // }
                                // if($conjunction === 'or') {
                                //     $model = $model->orWhere(function($query) use ($filter) {
                                //         if(Filter::check($filter)) {
                                //             // Filter::invoke($query, $filter, $conjunction);
                                //         } else {
                                //             $conjunction = $filter[1];
                                //             foreach($filter as $dfilter) {
                                //                 // if(is_array($dfilter)) {
                                //                     if(Filter::check($dfilter)) {
                                //                         Filter::invoke($query, $dfilter, $conjunction);
                                //                     }
                                //                 // } else {
                                //                 //     $conjunction = $dfilter;
                                //                 // }
                                //             }
                                //         }
                                //     });
                                // }
                            }
                        } else {
                            $conjunction = $filter;
                        }
                    }
                }
            }
        
            if($request->group) {
                $data['data'] = [];
        
                $group = json_decode($request->group, true);
                $selector = $group[0]['selector'];
        
                $mOri = $model;
                $totalCount = $mOri->count();
                $gQuery = $model->groupBy($selector);
                $data['groupCount'] = $gQuery->count();
                $gQuery = $gQuery->get();
                foreach($gQuery as $item) {
                    $gData = $mOri->where($selector, $item[$selector]);
                    $gData = $gData->skip($request->skip ? : 0)->take($request->take ? : 1000); // for limit items in group, due to crash
        
                    array_push($data['data'], [
                        'key' => $item[$selector],
                        // 'summary' => [11, 12, 13],
                        'items' => $gData->get(),
                        'count' => $gData->count()
                    ]);
                }
            } else {
                $totalCount = $model->count();
                $data['data'] = $model->skip($request->skip)->take($request->take)->get();
            }
        
            $data['totalCount'] = $totalCount;
            // $data['summary'] = [20,30,40];
        
            return $data;
        });
    }
}

// {
//     data: [{
//         key: "Group 1",
//         // Group summary
//         summary: [30, 20, 40],  // Summary values should be in the same order as items
//                                 // in the summary | groupItems array of the DataGrid configuration
//         items: [{
//             key: "Group 1_1",
//             summary: [12, 5, 19],
//             items: [
//                 key: "Group 1_1_1",
//                 summary: [8, 2, 10],
//                 // This is a group of the deepest hierarchy level,
//                 // therefore, you need to return the following fields
//                 items: null,
//                 count: 3        // The count of data rows in the current group
//             ]
//         }, {
//             key: "Group 1_2",
//             summary: [18, 15, 21],
//             items: [ ... ]
//         }]
//     }, {
//         key: "Group 2",
//         summary: [100, 50, 60],
//         items: [ ... ]
//     },
//         // . . .
//     ],
//     // The total count of records after applying the filter expression (if any was received)
//     // Needed only if requireTotalCount was true (see the previous code)
//     totalCount: 200,
//     // Total summary
//     summary: [170, 20, 20, 1020] // Summary values should be in the same order as items
//                                  // in the summary | totalItems array of the DataGrid configuration
// }
