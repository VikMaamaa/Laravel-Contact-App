<?php

namespace App\Models;

use App\Scopes\ContactFilterScope;
use App\Scopes\ContactSearchScope;
use App\Scopes\FilterScope;
// use App\Scopes\SearchScope;
// use App\Scopes\SearcherScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use SearcherScope;

class Contact extends Model
{
     use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id', 'user_id'];

    // protected $filterColumns = ['company_id'];

    public function company()
    {
       return $this->belongsTo(Company::class)->withoutGlobalScopes();
    }

    public function scopeLatestFirst($query){
        return $query->orderBy('id','desc');
    }

    public static function booted(){
        static::addGlobalScope(new ContactFilterScope);
        static::addGlobalScope(new ContactSearchScope);
    }


    public function user() {
        return $this->belongsTo(User::class);
    }
    // public function scopeFilter($query){
    //     if($companyId = request('company_id'))  {
    //         $query->where('company_id', $companyId);
    //     }

    //     if($search = request('search')){
    //         $query->where('first_name', 'LIKE', "%{$search}");
    //     }

    //     return $query;
    // }

    // public function getRouteKeyName()
    // {
    //     return  'first_name';
    // }
}
