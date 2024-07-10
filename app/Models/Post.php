<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image(){
        if($this->image){
            return asset($this->image);
        }
        return asset('default.png');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
