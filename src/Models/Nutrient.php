<?php

namespace G3n1us\Lund\Models;

use Illuminate\Database\Eloquent\Model;

class Nutrient extends Model
{
    protected $table = 'NUTR_DEF';
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    public $primaryKey = 'Nutr_No';
    
    public $incrementing = false;         
    
}
