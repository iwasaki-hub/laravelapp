<?php

namespace App\Models;

use App\Scopes\ScopePerson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150',
    );



    // グローバルスコープ
    // protected static function boot(){
    //     parent::boot();
    //     static::addGlobalScope('age', function (Builder $builder){
    //         $builder->where("age", ">", 20);
    //     });
    // }

    // Scopeクラス
    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new ScopePerson);
    }

    // メソッド
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }

    public function scopeNameEqual($query, $str){
        return $query->where("name", $str);
    }

    public function scopeAgeGreaterThan($query, $n){
        return $query->where('age', '>=', $n);
    }

    public function scopeAgeLessThan($query, $n){
        return $query->where('age', '<=', $n);
    }

    // has One 結合
    public function board(){
        return $this->hasOne('App\Models\Board');
    }

    // has Many 結合
    public function boards(){
        return $this->hasMany('App\Models\Board');
    }




}
