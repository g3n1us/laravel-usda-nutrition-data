<?php

namespace G3n1us\Lund\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'FOOD_DES';
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    public $primaryKey = 'NDB_No';
    
    public $incrementing = false; 
    
    public function data(){
	    return $this->hasMany(FoodData::class, 'NDB_No');
    }        
    
}
