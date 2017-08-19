<?php

namespace G3n1us\Lund\Models;

use Illuminate\Database\Eloquent\Model;

class FoodAbbrev extends Model
{
    protected $table = 'ABBREV';
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    public $primaryKey = 'NDB_No';
    
    public $incrementing = false;         
    
}
