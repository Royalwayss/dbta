<?php 
use App\Models\MeetingType;

    function meta(){
        return [];
    }
    

   
   
	function pd($data=[]){
		echo "<pre>"; print_r($data);die(); exit; 
	}

    function findPreviousId($id, $model) {
        // Dynamically construct the model class
        $modelClass = "\\App\\Models\\" . $model;

        // Ensure $id is an integer
        $id = (int) $id;

        // Check if the table is empty
        if ($modelClass::count() == 0) {
            return 0; // No records exist in the table
        }

        if ($id <= 1) {
            return 0; // No valid previous ID
        }

        $prevCount = $modelClass::where('id', $id-1)->count();
        if ($prevCount > 0) {
            return $id-1; // Found a valid previous ID
        }

        // Recursively check the next lower ID
        return findPreviousId($id - 1, $model);
    }

    function findNextId($id, $model) {
        // Dynamically construct the model class
        $modelClass = "\\App\\Models\\" . $model;

        $lastId = $modelClass::orderby('id','Desc')->first();

        // Check if the table is empty
        if ($modelClass::count() == 0 || $id==0 || $id>$lastId->id) {
            return 0; // No records exist in the table
        }

        $nextCount = $modelClass::where('id', $id+1)->count();
        if ($nextCount > 0) {
            return $id+1; // Found a valid next ID
        }

        // Recursively check the next higher ID
        return findNextId($id + 1, $model);
    }

    // for Widgets

  
  

	
	function from_input_error_message($field=''){
		return '<p class="error_message" id="input-error-'.$field.'"></p>';
	}
	
	function meeting_types(){
		$meeting_types = MeetingType::where('status',1)->orderby('sort','asc')->get()->toArray(); 
		
		return $meeting_types;
	}