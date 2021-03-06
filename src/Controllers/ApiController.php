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

namespace G3n1us\Lund\Controllers;	
	
use Illuminate\Http\Request;	
use App\Http\Controllers\Controller as BaseController;
use G3n1us\Lund\Models\Food;
use G3n1us\Lund\Models\FoodAbbrev;
use G3n1us\Lund\Models\FoodData;

	
class ApiController extends BaseController{
	// API parameters are public properties of controller
	public $abbreviated = false;
	public $search = false;
	public $model = null;
	public $eager_load = [];
	
	public function __construct(Request $request){
		$this->abbreviated = !!$request->input('abbreviated', $this->abbreviated);
		$this->search = $request->input('search', $this->search);
		$this->model = $this->abbreviated ? FoodAbbrev::class : Food::class;
		if(!$this->abbreviated)
			$this->eager_load = ['data', 'data.nutrient'];
		
	}
	
	public function search(){
		if(empty($this->search))
			throw new \Exception('Search term cannot be empty');
			
		return $this->get_search_results($this->search)->take(250);
	}
	
	private function get_search_results($query = null){
		$query = $query ?: $this->search;
		$table = $this->lookup_table();
		return $table->sortBy(function($v, $k) use($query){
			$search = strtolower($query);
			$v = strtolower($v);
			$lev = levenshtein($v, $search);
			if(str_contains($v, $search))
				$lev = $lev - 100;
			if(str_is("$search,*", $v))
				$lev = $lev - 500;
			if(str_is("*$search,*", $v))
				$lev = $lev - 200;
			if(str_is("* $search,*", $v))
				$lev = $lev - 200;
				
			return $lev;
		});
	}
	
	public function get(Request $request, $id = '01001'){
		return response($this->model::with($this->eager_load)->findOrFail($id))
			->header('Access-Control-Allow-Origin', '*')
			->header('Cache-Control', 'max-age=3600');
	}
	
	public function lookup(Request $request){
		$cachetime = 30 * 24 * 60 * 60;
		return response($this->lookup_table())
			->header('Access-Control-Allow-Origin', '*')
			->header('Cache-Control', "max-age=$cachetime,public,private");
	}
	
	private function lookup_table(){
		return cache()->rememberForever('lookup', function(){
			return Food::get()->pluck('Long_Desc', 'NDB_No');
		});
	}
	
}

