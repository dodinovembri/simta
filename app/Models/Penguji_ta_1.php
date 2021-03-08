<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penguji_ta_1 extends Model {

    public $table ='penguji_ta_1';
    public $guarded ='[]';


    // public function dosen()
    // {
    //     $this->belongsTo('App\Models\Dosen', 'nip', 'nip');
    // }

    public function dosen()
    {
        return $this->hasOne('App\Models\Dosen_model', 'nip', 'nip');
    }

    public function ta_1()
    {
        return $this->hasOne('App\Models\Ta_1_model', 'nim', 'nim');
    }

}
