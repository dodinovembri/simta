<?php namespace App\Models;

use App\Models\Dosen_model;
use Illuminate\Database\Eloquent\Model;

class Dosen_pembimbing extends Model {

    public $table ='dosen_pembimbing';
    public $guarded ='[]';

    public function join_dosen()
    {
    	return $this->hasOne('App\Models\Dosen_model', 'nip', 'nip');
    }
}
