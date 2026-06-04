<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembersDirectory;
use App\Models\AdminsRole;
use Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class MembersdirectoryController extends Controller
{
	public function members_directory(){ 
		Session::put('page','members-directory');
		$rows = MembersDirectory::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.members_directory.members_directory')->with(compact('rows','module'));    
	}
	
	public function addedit_member_directory (request $request,$id=null){
		
		if($id==""){
			$title = "Add Members Directory";
			$row = new MembersDirectory;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Member's Directory";
			$row = MembersDirectory::find($id);
			$model = "MembersDirectory"; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				
				'designation_prefix' => 'required',
				'member_name' => 'required',
				'serial_no' => 'required',
				
				
			];
			$customMessages = [
				
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all(); 
			if(isset($data['id']) && $data['id']!=""){
				$row = MembersDirectory::find($data['id']);
				$message = "Member's Directory updated successfully!";
			}else{
				$row = new MembersDirectory;
				$message = "Member's Directory added successfully!";    
			}
			
			$row->role = $data['role'];
			$row->designation_prefix = $data['designation_prefix'];
			$row->member_name = $data['member_name'];
			$row->serial_no = $data['serial_no'];
			
			$row->contact_no = $data['contact_no'];
			$row->address = $data['address'];
			$row->email = $data['email'];
			
			
			if($request->file('profile')){ 
					$file = $request->file('profile');     
					$extension = $file->getClientOriginalExtension();
					$allowed_extension = array('jpg','jpeg','png','JPG','JPEG','PNG'); 
					if(in_array($extension, $allowed_extension)){
						$imageName = time().''.rand(100,999).'.'.$extension; 
						$destinationPath = 'uploads/members-directory/profile/';
						$file->move($destinationPath, $imageName);
						$row->profile = $imageName; 
					}
				}
			
			
			
			
			$row->sort = $data['sort'];
			if(!empty( $data['status'])){
			   $row->status = 1;
			}else{
				$row->status = 1;
			}
			$row->save();
			
			
			
			
			
			return redirect('admin/members-directory')->with('success_message',$message);
		}
		$designation_list = MembersDirectory::select('designation_prefix')->where('designation_prefix','!=','')->groupby('designation_prefix')->orderby('designation_prefix','asc')->get()->toArray(); 
		return view('admin.members_directory.add_edit_members_directory')->with(compact('title','row','designation_list','prevId','nextId')); 
	}
	
	public function getNextSerial(Request $request)
		{
			$letter = strtoupper($request->letter);

			$count = MembersDirectory::whereRaw('UPPER(SUBSTR(TRIM(member_name), 1, 1)) = ?', [$letter])
						->count();

			return response()->json([
				'status'      => true,
				'next_serial' => $letter . ($count + 1),
			]);
		}
	
	 public function update_member_directory (request $request){
		 $title = 'Update Member Directory';
		 return view('admin.members_directory.update_member_directory')->with(compact('title')); 
	 }
	
	 public function export_member_directory (request $request){
		 $filter = $request->all();
		
		 // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Get the active sheet (first sheet)
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
         
                $sheet->setCellValue('A1', 'SERIAL NO')
					  ->setCellValue('B1', 'PHONE(editable)')
					  ->setCellValue('C1', 'EMAIL(editable)')
					  ->setCellValue('D1', 'ADDRESS(editable)')
					  ->setCellValue('E1', 'Profile(editable)');
			  
		$sheet->getStyle('A1:E1')->getFont()->setBold(true); // Make text bold
        $sheet->getStyle('A1:E1')->getFont()->setSize(14);  // Set font size to 14
        //$sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Center align text
        $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // Solid fill
        $sheet->getStyle('A1:E1')->getFill()->getStartColor()->setRGB('007bff'); // Set background color to green (change the color as needed)	  
			  
			  
			  
			  
			  
	   $membersdirectory = MembersDirectory::query()
			->select('id', 'serial_no', 'contact_no', 'email', 'address', 'profile');

		if (!empty($filter['from_serial_no'])) {
			$membersdirectory->where('serial_no', '>=', $filter['from_serial_no']);
		}

		if (!empty($filter['to_serial_no'])) {
			$membersdirectory->where('serial_no', '<=', $filter['to_serial_no']);
		}

		$membersdirectory = $membersdirectory
			->orderBy('serial_no', 'asc')
			->get()->toArray();

        // Add the user data to the spreadsheet starting from row 2
        $row = 2; // Start adding data from row 2 (since row 1 has headers)
        $total_amount = 0;
		foreach ($membersdirectory as $member) {
           
		
			$sheet->setCellValue('A' . $row, $member['serial_no'])
                  ->setCellValue('B' . $row, $member['contact_no'])
                  ->setCellValue('C' . $row, $member['email'])
                  ->setCellValue('D' . $row, $member['address'])
                  ->setCellValue('E' . $row, $member['profile']);
            $row++;
        }
		
	
		 $sheet->getStyle('A1:E' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set the response headers for downloading the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'DTBA_Members_Directory .xlsx';

        // Output the file directly to the browser
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
		
		
		 
		 
		 
		 
		 
		 
		 
	 }
	 
	 
	
public function import_member_directory(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx',
    ]);

    $file = $request->file('file');
    
    // Load the spreadsheet
    $spreadsheet = IOFactory::load($file->getPathname());
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Start from row 2 (assuming row 1 is headers)
    foreach ($rows as $index => $row) { 
        if ($index === 0) continue; // Skip header row

        $serial_no = $row[0] ?? null;
        $contact_no = $row[1] ?? null;
        $email = $row[2] ?? null;
        $address = $row[3] ?? null;
        $profile = $profile[4] ?? null;

        if ($serial_no && !empty($contact_no) && !empty($email) && !empty($address) ) {
            // Update the member by serial_no
            MembersDirectory::where('serial_no',$serial_no)->update(
                [
                    'contact_no' => trim($contact_no),
                    'email' => trim($email),
                    'address' => trim($address),
                    'profile' => trim($profile)
                ]
            );
        }
    }

    $message = 'Members directory updated successfully.';
	return redirect('admin/members-directory')->with('success_message',$message);
}
	
	public function updateMemberSerialNumbers()
	{
		$members = MembersDirectory::select('id', 'member_name', 'serial_no')
			->orderBy('member_name', 'asc')
			->get();
       
		// Group members by first letter of member_name
		$grouped = $members->groupBy(function ($member) {
			return strtoupper(substr(trim($member->member_name), 0, 1));
		});

		foreach ($grouped as $letter => $group) {
			$counter = 1;
			foreach ($group as $member) {
				$member->serial_no = $letter . $counter;
				$member->save();
				$counter++;
			}
		}

		return response()->json([
			'status'  => true,
			'message' => 'Serial numbers updated successfully',
		]);
	}		
	
	
	
}