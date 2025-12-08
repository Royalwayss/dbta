<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MediaImage;
class Media extends Model
{
    use HasFactory;
   
    public function media_images(){
    	return $this->hasMany('App\Models\MediaImage','media_id')->orderby('media_sort','asc');
    }
	
	 public function active_media_images(){
    	return $this->hasMany('App\Models\MediaImage','media_id')->where('status','1')->orderby('media_sort','asc');
    }
   
}
