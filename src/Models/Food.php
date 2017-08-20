<?php

#
#
# G3N1US - Laravel USDA Nutrition Data
#
# (c) Sean Bethel
# http://bewarerobots.com
#
# For the full license information, view the LICENSE file that was distributed
# with this source code.
#
#

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
