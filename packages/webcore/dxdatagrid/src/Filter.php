<?php

namespace Webcore\DXDataGrid\Utils;

class Filter
{
    public function __construct()
    {
        //
    }

    public static function check($filters) {
        if(
            $filters[1] === 'contains' ||
            $filters[1] === 'not contains' ||
            $filters[1] === 'startswith' ||
            $filters[1] === 'endswith' ||
            $filters[1] === '=' ||
            $filters[1] === '<>' ||
            $filters[1] === '>' ||
            $filters[1] === '>=' ||
            $filters[1] === '<' ||
            $filters[1] === '<=' ||
            $filters[1] === 'isblank' ||
            $filters[1] === 'isnotblank'
        ) {
            return true;
        }
    
        return false;
    }

    public static function invoke($data, $filters, $conjunction = 'and') {
        if($conjunction === 'and') {
            if($filters[1] === 'contains') {
                $data = $data->where($filters[0], 'like', '%'.$filters[2].'%');
            }
            if($filters[1] === 'notcontains') {
                $data = $data->where($filters[0], 'not like', '%'.$filters[2].'%');
            }
            if($filters[1] === 'startswith') {
                $data = $data->where($filters[0], 'like', $filters[2].'%');
            }
            if($filters[1] === 'endswith') {
                $data = $data->where($filters[0], 'like', '%'.$filters[2]);
            }
            if($filters[1] === '=') {
                $data = $data->where($filters[0], '=', $filters[2]);
            }
            if($filters[1] === '<>') {
                $data = $data->where($filters[0], '<>', $filters[2]);
            }
            if($filters[1] === '>') {
                $data = $data->where($filters[0], '>', $filters[2]);
            }
            if($filters[1] === '>=') {
                $data = $data->where($filters[0], '>=', $filters[2]);
            }
            if($filters[1] === '<') {
                $data = $data->where($filters[0], '<', $filters[2]);
            }
            if($filters[1] === '<=') {
                $data = $data->where($filters[0], '<=', $filters[2]);
            }
            if($filters[1] === 'isblank') {
                $data = $data->whereNull($filters[0]);
            }
            if($filters[1] === 'isnotblank') {
                $data = $data->whereNotNull($filters[0]);
            }
        } else {
            if($filters[1] === 'contains') {
                $data = $data->orWhere($filters[0], 'like', '%'.$filters[2].'%');
            }
            if($filters[1] === 'not contains') {
                $data = $data->orWhere($filters[0], 'not like', '%'.$filters[2].'%');
            }
            if($filters[1] === 'startswith') {
                $data = $data->orWhere($filters[0], 'like', $filters[2].'%');
            }
            if($filters[1] === 'endswith') {
                $data = $data->orWhere($filters[0], 'like', '%'.$filters[2]);
            }
            if($filters[1] === '=') {
                $data = $data->orWhere($filters[0], '=', $filters[2]);
            }
            if($filters[1] === '<>') {
                $data = $data->orWhere($filters[0], '<>', $filters[2]);
            }
            if($filters[1] === '>') {
                $data = $data->orWhere($filters[0], '>', $filters[2]);
            }
            if($filters[1] === '>=') {
                $data = $data->orWhere($filters[0], '>=', $filters[2]);
            }
            if($filters[1] === '<') {
                $data = $data->orWhere($filters[0], '<', $filters[2]);
            }
            if($filters[1] === '<=') {
                $data = $data->orWhere($filters[0], '<=', $filters[2]);
            }
            if($filters[1] === 'isblank') {
                $data = $data->orWhereNull($filters[0]);
            }
            if($filters[1] === 'isnotblank') {
                $data = $data->orWhereNotNull($filters[0]);
            }
        }
    
        return $data;
    }
}
