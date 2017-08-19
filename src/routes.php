<?php
	
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use G3n1us\Lund\Models\Food;
use G3n1us\Lund\Models\FoodData;
use G3n1us\Lund\Controllers\ApiController;

Route::get('/get/{id?}', 'G3n1us\Lund\Controllers\ApiController@get');
	
Route::get('/lookup', 'G3n1us\Lund\Controllers\ApiController@lookup');
	
Route::get('/search', 'G3n1us\Lund\Controllers\ApiController@search');
	
/*
Route::get('/api/{id?}', function(Request $request, $id = null){
	$id = $id ?: '01001';
	// API parameters
	$abbreviated = $request->input('abbreviated', false);
	dd($abbreviated);
	return response(Food::with(['data', 'data.nutrient'])->find($id))
		->header('Access-Control-Allow-Origin', '*')
		->header('Cache-Control', 'max-age=3600');
});	
*/
	
	
	
	
// Console Commands
	

Artisan::command('abbrev', function(){
	$filesystem = new Filesystem(new ZipArchiveAdapter(storage_path('usda_abbreviated_data.zip')));
	$stream = $filesystem->readStream('ABBREV.txt');
	$count = 0;
	$keys = config('lund.table_keys.ABBREV');
	if ($stream) {
	    while (($buffer = fgetcsv($stream, 100000, '^', '~')) !== false) {
		    $count++;
		    $row = array_combine($keys, $buffer);
// 		    dd($row);
			FoodAbbrev::firstOrCreate(
			    ['NDB_No' => $row['NDB_No']], $row
			);		    
	    }
	    if (!feof($stream)) {
	        die( "Error: unexpected stream_get_line() fail" );
	    }
	    fclose($stream);
	    
	    $this->comment($count);
	    
	}
	

})->describe('Load abbreviated data');	
	
	
Artisan::command('get_file', function(){
	$endpoint = config('lund.usda_endpoint');
	//file_put_contents(storage_path('usda_data.zip'), file_get_contents($endpoint)); 
	
	$filesystem = new Filesystem(new ZipArchiveAdapter(storage_path('usda_data.zip')));
	
/*
	$food = Food::first();
	$keys = array_keys($food->toArray());
	$stream = $filesystem->readStream('FOOD_DES.txt');
	if ($stream) {
	    while (($buffer = fgetcsv($stream, 100000, '^', '~')) !== false) {
		    $row = array_combine($keys, $buffer);
// 		    if($row['NDB_No'] == '09520' ) dd($row['SciName']);
			$fooditem = Food::firstOrCreate(
			    ['NDB_No' => $row['NDB_No']], $row
			);		    
	    }
	    if (!feof($stream)) {
	        die( "Error: unexpected stream_get_line() fail" );
	    }
	    fclose($stream);
	}
*/
// 	dd($contents);
// FoodData::where('id', '>', 0)->delete();
	$fooddata = FoodData::first();
	$keys = array_keys($fooddata->toArray());
	$keys = array_except($keys, 0);
	$stream = $filesystem->readStream('NUT_DATA.txt');
	$count = 0;
	if ($stream) {
	    while (($buffer = fgetcsv($stream, 100000, '^', '~')) !== false) {
		    $count++;
		    $row = array_combine($keys, $buffer);
// 		    dd($row);
			FoodData::firstOrCreate(
			    ['NDB_No' => $row['NDB_No'], 'Nutr_No' => $row['Nutr_No']], $row
			);		    
	    }
	    if (!feof($stream)) {
	        die( "Error: unexpected stream_get_line() fail" );
	    }
	    fclose($stream);
	    
	    $this->comment($count);
	    
	}
// 	dd($contents);
})->describe('Load data from text file');
	

	