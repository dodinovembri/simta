<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mhs_model extends Model {

    public $table ='mhs';
    public $guarded ='[]';
    public $fillable = ['status_kkt_file'];

    public function angkatan()
    {
    	return $this->belongsTo('App\Models\Angkatan', 'id_angkatan', 'id');
    }

    public function jurusan()
    {
    	return $this->belongsTo('App\Models\Jurusan', 'id_jurusan', 'id');
    }

    public function nip_dosen()
    {
        # code...
        return $this->hasOne('App\Models\Dosen_model', 'nip', 'nip_pa');        
    }

}
