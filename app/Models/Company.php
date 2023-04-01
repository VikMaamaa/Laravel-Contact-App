<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address','email', 'website'];

    public $searchColumns = ['name', 'address','email', 'website'];

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function userCompanies() {
        return  self::where('user_id', auth()->id())->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
    }

    public static function booted(){
        static::addGlobalScope(new SearchScope);
    }
}
