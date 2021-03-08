<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penguji_ta_2 extends Model {

    public $table ='penguji_ta_2';
    public $guarded ='[]';

    public function dosen()
    {
        return $this->hasOne('App\Models\Dosen_model', 'nip', 'nip');
    }

    public function ta_2()
    {
        return $this->hasOne('App\Models\Ta_2', 'nim', 'nim');
    }    
}
