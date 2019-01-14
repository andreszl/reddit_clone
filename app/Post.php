<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    //the next line is only for sqlite :
    //protected $casts = ['user_id' => 'integer'];
    
    protected $fillable = ['title' ,'description', 'url', 'user_id'];

    public function user()
    {

    	return $this->belongsTo(User::class);		

    }
    public function wasCreatedBy($user)
    {
    	if(is_null($user)){

    		return false;

    	}
        //return (int)$this->user_id === $user->id;
        return $this->user_id === $user->id;
    }

 
}
