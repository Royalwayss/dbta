<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommitteeMember;
class Committee extends Model
{
    use HasFactory;
   
    public function committee_members(){
    	return $this->hasMany('App\Models\CommitteeMember','committee_id')->orderby('sort','asc');
    }
	
	public function active_committee_members(){
    	return $this->hasMany('App\Models\CommitteeMember','committee_id')->where('status',1)->orderby('sort','asc');
    }
   
}
