<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Description of Test
 *
 * @author otis
 */
class Test extends Model{
    
    use SoftDeletes;
    
    protected $fillable = ['title', 'numeric'];
    protected $dates = ['delete_at'];
    
}
