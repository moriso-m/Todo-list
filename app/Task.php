<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['title','description','user_id','date_due','time_due','completed'];

    public function user(){

        return $this->belongsTo(App\User::class);
    }
}
