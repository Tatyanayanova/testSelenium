<?php

namespace App\Http\Controllers;

use App\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
/**
 * Description of TestController
 *
 * @author otis
 */
class TestController extends Controller{
    
        public function create(Request $request){ 
            if(Test::create($request->all())){
                return response()->json(['created' =>true]);
            }else{
                return response()->json(['created' =>false]);
            }
	}
 
        public function read(){             
            $test = Test::all(); 
            return response()->json($test);
 
	}
        
	public function update(Request $request, $id, $key){ 
            var_dump('update');
            $user = new User();
            if($user->authkey($key)){                
                $test  = Test::find($id);                
                $test->update($request->all());             
                return response()->json($test);
             }
            return 'OK :)!';
	}  
 
	public function delete($id){
            $test  = Test::find($id);            
            $test->delete();
            return response()->json('Removed successfully.');
	}
 
	
 
	
}
