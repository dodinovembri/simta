<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mhs_topik_ta extends Model {

    public $table ='mhs_topik_ta';
    public $guarded ='[]';
    public $fillable = ['id_topik_ta', 'judul_ta', 'id_status_agree_topik', 'file_konsultasi', 'updated_by', 'created_by', 'created_at', 'updated_at'];

    public function topik_ta()
    {
    	return $this->hasOne('App\Models\Topik_ta', 'id', 'id_topik_ta');
    }

}
