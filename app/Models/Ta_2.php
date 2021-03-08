<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ta_2 extends Model {

    
	public $table ='ta_2';
    public $guarded ='[]';

    protected $appends = ['nama_penguji'];


    public function mahasiswa()
    {
        $this->belongsTo('App\Models\Mhs_model', 'nim', 'nim');
    }

    public function penguji_ta()
    {
        $this->hasMany('App\Models\Penguji_ta_2', 'nim', 'nim');
    }

    
    public function getNamaPengujiAttribute()
    {
        $nim            =  $this->getAttributeValue('nim');
        $pengujis       = \App\Models\Penguji_ta_2::join('dosen', 'dosen.nip', '=', 'penguji_ta_2.nip')->where('penguji_ta_2.nim',$nim)->get();
        $penguji        = [];
        $nama_penguji   ='';

        foreach ($pengujis as $key => $value) {
            if(!empty($value->nama)){
                $penguji[] = $value->nama;
            }
        }
        return $penguji_arr = implode(', ', array_unique($penguji));

    
    }

    public function join_mhs()
    {
        return $this->hasOne('App\Models\Mhs_model', 'nim', 'nim');
    }    

}
