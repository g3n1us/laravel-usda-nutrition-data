<?php

namespace G3n1us\Lund\Models;

use Illuminate\Database\Eloquent\Model;

class FoodData extends Model
{
    protected $table = 'NUT_DATA';
    
    protected $guarded = [];
    
    public $timestamps = false;   
    
    public $primaryKey = 'NDB_No';
    
    public $incrementing = false; 
    
    public function nutrient(){
	    return $this->hasOne(Nutrient::class, 'Nutr_No', 'Nutr_No');
    }        
    
    
}
