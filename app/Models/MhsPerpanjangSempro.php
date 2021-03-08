<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MhsPerpanjangSempro extends Model {

    public $table ='mhs_perpanjang_sempro';
    public $guarded ='[]';

    public function join_mhs()
    {
        # code...
        return $this->hasOne('App\Models\Mhs_model', 'nim', 'nim');        
    }

    public function join_dosen()
    {
        # code...
        return $this->hasOne('App\Models\Dosen_model', 'nip', 'nip_pa');        
    }    
}
