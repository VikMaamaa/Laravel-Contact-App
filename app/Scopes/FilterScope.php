<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterScope implements Scope
{
    protected $filterColumns  = [];
    public function apply(Builder $builder, Model $model)
    {

    //    $columns = property_exists($model, 'filterColumns')? $model->filterColumns : $this->filterColumns;

       $columns = [];

            if(property_exists($model, 'filterColumns')){
                $columns = $model->filterColumns ?? [];

            }else{
                $columns = $this->filterColumns ?? [];
            }
       foreach ($columns as $column) {
        if($value = request($column))  {
            $builder->where($column, $value);
        }
       }

        // if($search = request('search')){
        //     $builder->where('first_name', 'LIKE', "%{$search}");
        //     $builder->orWhere('last_name', 'LIKE', "%{$search}");
        //     $builder->orWhere('email', 'LIKE', "%{$search}");
        // }
    }
}
