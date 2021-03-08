<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ta_1_model extends Model {

    public $table ='ta_1';
    public $guarded ='[]';
    protected $appends = ['nama_penguji'];


    public function mahasiswa()
    {
        $this->belongsTo('App\Models\Mhs_model', 'nim', 'nim');
    }

    public function penguji_ta()
    {
        $this->hasMany('App\Models\Penguji_ta_1', 'nim', 'nim');
    }

    
    public function getNamaPengujiAttribute()
    {
        $nim            =  $this->getAttributeValue('nim');
        $pengujis       = \App\Models\Penguji_ta_1::join('dosen', 'dosen.nip', '=', 'penguji_ta_1.nip')->where('penguji_ta_1.nim',$nim)->get();
        $penguji        = [];
        $nama_penguji   ='';

        foreach ($pengujis as $key => $value) {
            if(!empty($value->nama)){
                $penguji[] = $value->nama;
            }
        }
        return $penguji_arr = implode(', ', array_unique($penguji));

    
    }

    public function join_pembimbing()
    {
        return $this->hasMany('App\Models\Dosen_pembimbing', 'nim', 'nim');
    }

    public function join_mhs()
    {
        return $this->hasOne('App\Models\Mhs_model', 'nim', 'nim');
    }
}
