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

class FoodAbbrev extends Model
{
    protected $table = 'ABBREV';
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    public $primaryKey = 'NDB_No';
    
    public $incrementing = false;         
    
}
