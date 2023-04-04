<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
   
    use HasFactory;
    use softDeletes;
    protected $primaryKey = 'id';
    protected $table = 'comments';
    protected $fillable = ['animal_id', 'body','created_at','updated_at','deleted_at'];


    public function animal(){
        return $this->belongsTo('App\Models\Animal','categoryid_id');
    }
}
