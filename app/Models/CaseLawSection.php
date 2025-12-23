<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MediaImage;
class CaseLawSection extends Model
{
    use HasFactory;
   
    public function pdf_files(){
    	return $this->hasMany('App\Models\CaseLawSectionFiles','section_id')->orderby('sort','asc');
    }
	
	public function active_media_images(){
    	return $this->hasMany('App\Models\CaseLawSectionFiles','section_id')->where('status','1')->orderby('sort','asc');
    }
   
}
