<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope
{
    protected $searchColumns = [];

    public function apply(Builder $builder, Model $model)
    {

        if($search = request('search')){
            foreach ($this->searchColumns as $column) {
                $arr = explode('.', $column);
                if(count($arr) == 2){
                    list($relationship, $col) = $arr;

                    $builder->orWhereHas($relationship, function($query) use ($search, $col){
                        $query->where($col, 'LIKE', "%{$search}%");
                    });
                }
               else{
                $builder->orWhere($column, 'LIKE', "%{$search}");
               }
            }
            // $builder->where('first_name', 'LIKE', "%{$search}");


        }
    }
}
