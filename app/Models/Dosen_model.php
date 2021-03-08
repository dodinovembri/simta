<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen_model extends Model {

    public $table ='dosen';
    public $guarded ='[]';


    public function bidang_ilmu()
    {
    	# code...
        return $this->hasOne('App\Models\Bidang_ilmu', 'id', 'id_bidang_ilmu');    	    	
    }
}
