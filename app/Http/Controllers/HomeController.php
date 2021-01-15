<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Quotation;

use App\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use PHPExcel_IOFactory;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $sid = "AC54421645071131eb5fa9db2ab014d5ef";
    private $token = "8923a5972bb9d2a405c797f6ed975f0e";
    private $from = "+1 254-870-1209 ";
    
    
    public function index()
    {
        return view('home');
    }
    
//    public function showImportPatients()
//    {
//        if(Auth::user()->role=='superadmin'){
//            return view('import');
//        }else{
//            abort('404');
//        }
//
//    }
    
//    public function sendWishes()
//    {
//    	DB::table('wishes')->where('id', 1)->increment('count');
//    }
    
    
//    public function importPatients(Request $request)
//    {
//         $extension = $request->file->extension();
//         $allowed_extension = array("xls", "xlsx", "csv");
//         $output="";
//         if(in_array($extension, $allowed_extension))
//         {
//          //$file = public_path()."/excel/demo.xlsx";
//          $file = $request->file;
//          $objPHPExcel = PHPExcel_IOFactory::load($file);
//          $output .= "<div class='alert alert-success'><strong>Data Inserted</strong></div><table class='table table-bordered'>";
//          foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
//          {
//           $highestRow = $worksheet->getHighestRow();
//           for($row=2; $row<=$highestRow; $row++)
//           {
//            $output .= "<tr>";
//
//            $firstname = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
//            $lastname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
//            $dob = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
//            $phone = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
//            $email = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
//            $sex = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
//            DB::table('patients')->insert(
//             array(
//                    'firstname'   =>   $firstname,
//                    'lastname'   =>   $lastname,
//                    'dob'   =>   date('Y-m-d', strtotime($dob)),
//                    'gender'   =>   $sex,
//                    'phone'   =>   $phone,
//                    'email' => $email,
//                )
//            );
//
//
//            $output .= '<td>'.strip_tags($firstname).'</td>';
//            $output .= '<td>'.strip_tags($lastname).'</td>';
//            $output .= '<td>'.strip_tags($dob).'</td>';
//            $output .= '<td>'.strip_tags($phone).'</td>';
//            $output .= '<td>'.strip_tags($email).'</td>';
//            $output .= '<td>'.strip_tags($sex).'</td>';
//
//            $output .= '</tr>';
//           }
//          }
//          $output .= '</table>';
//
//         }
//         else
//         {
//          $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
//         }
//        //echo $output;
//       Session::flash('success','Patients Imported Successfuly');
//        return view('import', compact('output'));
//    }
//
    
    
    public function myProfile()
    {
        $mydetails = User::find(Auth::user()->id);
        return view('myprofile',compact('mydetails'));
    }
    
    public function showDiagnosis()
    {
        $diagnosis = DB::table('diagnosis')->orderBy('name', 'asc')->get();
        return view('diagnosis',compact('diagnosis'));
    }
    
    public function showEditDiagnosis($id)
    {
        $editdiagnosis = DB::table('diagnosis')->where('id', $id)->first();
        $diagnosis = DB::table('diagnosis')->orderBy('name', 'asc')->get();
        return view('diagnosis',compact('diagnosis', 'editdiagnosis'));
    }
    
    public function updateEmail(Request $request)
    {
        $userid = Auth::user()->id;
        $this->validate($request, [
            'email'=>'required|email|unique:users,email,'.$userid.',id',
        ]);
        $user = User::find($userid);
        $user->email = $request->email;
        $user->save();
        Session::flash('success','Epasts ir veiksmīgi atjaunināts');
        return Redirect::route('myprofile');
    }
    
    public function changePassword(Request $request)
    {
        if(Auth::Check()){
            if(strlen($request->password)<6){
                return "<div class=\"alert alert-danger\"> Parolē jābūt vismaz 6 rakstzīmēm </div>";
            }elseif($request->password!=$request->password_confirmation){
                return "<div class=\"alert alert-danger\"> Paroles neatbilst </div>";
            }else{
               $userid = Auth::user()->id;
               $user = User::find($userid);
               if (Hash::check($request->currentpassword, $user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save(); 
                    return "<div class=\"alert alert-success\">Parole atjaunināta veiksmīgi!</div>";
                }else{
                    return "<div class=\"alert alert-danger\"> Nepareiza parole </div>";
                } 
            }
        }
    }
    
    public function changeSubAdminPassword(Request $request)
    {
        if(Auth::user()->role=='superadmin'){
            if(strlen($request->password)<6){
                return "<div class=\"alert alert-danger\"> Parolē jābūt vismaz 6 rakstzīmēm </div>";
            }elseif($request->password!=$request->password_confirmation){
                return "<div class=\"alert alert-danger\"> Paroles neatbilst </div>";
            }else{
               $userid = $request->subadminid;
               $user = User::find($userid);
               $user->password = Hash::make($request->password);
               $user->save(); 
               return "<div class=\"alert alert-success\">Parole atjaunināta veiksmīgi!</div>";
            }
        }
    }
    
    
    public function showAddSubadmin()
    {
        if(Auth::user()->role=='superadmin'){
            return view('addsubadmin');
        }else{
            abort('404');
        }
    }
    
    public function showAppointments()
    {
            $patients = DB::table('patients')->get();
            $doctors = DB::table('doctors')->get();
            $diagnosis = DB::table('diagnosis')->get();
            return view('appointments', compact('patients', 'doctors', 'diagnosis'));
    }
    
    public function allAppointments()
    {
            $appointments = DB::table('appointments')->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
            return view('allappointments', compact('appointments'));
    }
    
    
    public function addSubadmin(Request $request)
    {
        $this->validate($request, [
            'name'   =>   'required|string',
            'email'   =>   'string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
         DB::table('users')->insert(
             array(
                    'name'   =>   ucwords($request->name),
                    'email'   =>   $request->email,
                    'password' => bcrypt($request->password),
                    'role'   =>   'admin',
                    'created_at'   =>   date('Y-m-d'),
             )
        );
        
        Session::flash('success','Administrators Pievienots Veiksmīgi');
        return Redirect::back();
    }
    
    public function addDiagnosis(Request $request)
    {
        $this->validate($request, [
            'diagnosis'   =>   'required|string',
        ]);
        
         DB::table('diagnosis')->insert(
             array(
                    'name'   =>   $request->diagnosis,
             )
        );
        
        Session::flash('success','Procedūra Pievienota Veiksmīgi');
        return Redirect::back();
    }
    
    public function updateDiagnosis(Request $request)
    {
        $this->validate($request, [
            'diagnosis'   =>   'required|string',
            'diagnosisid' => 'required|numeric'
        ]);
        
         DB::table('diagnosis')->where('id', $request->diagnosisid)->update(
             array(
                    'name'   =>   $request->diagnosis,
             )
        );
        
        Session::flash('success','Procedūra atjaunināta veiksmīgi');
        return Redirect::back();
    }
    
    
    
    public function addAppointment(Request $request)
    {
        $this->validate($request, [
            'patientid'   =>   'required|numeric',
            'doctorid'   =>   'required|numeric',
            'date' => 'required|string',
            'time' => 'required|string',
            'diagnosisid' => 'required|numeric'
        ]);
        
        $check = DB::table('appointments')->where('doctorid', $request->doctorid)->where('time', date('G:i', strtotime($request->time)))->where('date', $request->date)->first();
        if($check){
            Session::flash('danger','Vizīte jau pastāv uz šo laiku');
        }else{
            DB::table('appointments')->insert(
             array(
                    'patientid'   =>   $request->patientid,
                    'doctorid'   =>   $request->doctorid,
                    'date' => $request->date,
                    'diagnosis' => $request->diagnosisid,
                    'time'   =>   date('G:i', strtotime($request->time)),
                    'dateadded'   =>   date('Y-m-d h:i:sa'),
                )
            );
        
            $doctor = DB::table('doctors')->where('id', $request->doctorid)->first();
            $patient = DB::table('patients')->where('id', $request->patientid)->first();
            //$this->sendMail('patient', $patient, $doctor, $request->date, $request->time);
            //$this->sendMail('doctor', $patient, $doctor, $request->date, $request->time);
            //$this->sendSMS('patient', $patient, $doctor, $request->date, $request->time);
            //$this->sendSMS('doctor', $patient, $doctor, $request->date, $request->time);
            Session::flash('success','Vizīte Pievienota Veiksmīgi');
        }
        
        return Redirect::back();
    }
    
    public function updateAppointment(Request $request)
    {
        $this->validate($request, [
            'patientid'   =>   'required|numeric',
            'date' => 'required|string',
            'time' => 'required|string',
            'diagnosisid' => 'required|numeric'
        ]);
        
        
        $check = DB::table('appointments')
            ->where('doctorid', $request->doctorid)
            ->where('time', date('H:i:s', strtotime($request->time)))
            ->where('date', $request->date)->where('id', '!=', $request->appointmentid)
            ->first();
        if($check){
            Session::flash('danger','Vizīte jau pastāv '.date('F, d Y', strtotime($request->date)).' '.$request->time);
        }else{
            DB::table('appointments')->where('id', $request->appointmentid)->update(
             array(
                    'patientid'   =>   $request->patientid,
                    'date' => $request->date,
                    'diagnosis' => $request->diagnosisid,
                    'time'   =>   date('G:i', strtotime($request->time)),
                )
            );
            Session::flash('success','Vizīte atjaunināšana ir veiksmīga');
        }
        
        
        return Redirect::back();
    }
    
    
//    private function sendSMS($type, $patient, $doctor, $date, $time)
//    {
//
//        if($type=='patient'){
//            $gender = strtolower($patient->gender)=='male' ? 'Sir' : 'Madam';
//            $message = "Hello ".ucfirst($patient->firstname)." ".ucfirst($patient->lastname).",\nYour appointment has been confirmed with Dr. ".$doctor->firstname.' '.$doctor->lastname." on ".date('d/m/Y', strtotime($date))." at $time.\nThanks for choosing The Eye Doctor's. Eye Care...We Care.";
//            $phone = $patient->phone;
//            $phone = "+234".ltrim($phone, '0');
//
//        }
//
//        if($type=='doctor'){
//            $message = "Hello Dr. ".$doctor->firstname." ".$doctor->lastname.",\nYou have an appointment with Patient ".$patient->firstname.' '.$patient->lastname." on ".date('d/m/Y', strtotime($date))." at $time.\nThe Eye Doctor's. Eye Care...We Care";
//            $phone = $doctor->mobilenumber;
//            $phone = "+234".ltrim($phone, '0');
//        }
//    }
    
    
    public function editSubAdmin(Request $request)
    {
        $this->validate($request, [
            'name'   =>   'required|string',
            'email'=>'required|email|unique:users,email,'.$request->subadminid.',id',
            'subadminid'   =>   'required|numeric',
        ]);
        
         DB::table('users')->where('id', $request->subadminid)->update(
             array(
                    'name'   =>   ucwords($request->name),
                    'email'   =>   $request->email,
             )
        );
        
        Session::flash('success','Administratora atjaunināšana ir veiksmīga');
        return Redirect::back();
    }
    
    public function allSubadmins()
    {
        if(Auth::user()->role=='superadmin'){
        $subadmins = User::where('role', 'admin')->get();
        return view('subadmins',compact('subadmins'));
        }else{
            abort('404');
        }
    }
    
    public function editSubAdminView($id)
    {
        $subadmin = User::where('id', $id)->first();
        return view ('addsubadmin', compact('subadmin'));
    }
    
//    public function testmail()
//    {
//
//    	$message = "
//            <html>
//            <head><title>Mail</title></head>
//            <body>
//            <h3>Hello Mr. Hassan Shahid,</h3>
//            <p>Your have an appointment with Dr Adam Walker on 06-04-2018 at 10.00pm.</p>
//            <p>Thanks.</p>
//            <p>The Eye Doctors</p>
//            </body>
//            </html>";
//            $to = "hassanrrs@gmail.com";
//            $headers = "MIME-Version: 1.0" . "\r\n";
//            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//            $headers .= 'From: <appointments@theeyedoctors.com.ng>' . "\r\n";
//            if(mail($to,'Test',$message,$headers)){
//            	echo "Success";
//            }else{
//            	echo "Fail";
//            }
//
//    }
    
    public static function getPName($id)
    {
        $patient = DB::table('patients')->where('id', $id)->first();
        return $patient ? $patient->firstname.' '.$patient->lastname : 'Izdzēsts';
    }
    
    public static function getDName($id)
    {
        $doctor = DB::table('doctors')->where('id', $id)->first();
        return $doctor ? $doctor->firstname.' '.$doctor->lastname : 'Izdzēsts';
        
    }
    
    public static function getDiagName($id)
    {
        return DB::table('diagnosis')->where('id', $id)->value('name');
    }
    
//    private function sendMail($type, $patient, $doctor, $date, $time)
//    {
//        $subject = 'Appointment Alert';
//        if($type=='patient'){
//            $gender = strtolower($patient->gender)=='male' ? 'Sir' : 'Madam';
//            $message = "
//            <html>
//            <head><title>Mail</title></head>
//            <body>
//            <h3>Hello ".ucfirst($patient->firstname)." ".ucfirst($patient->lastname).",</h3>
//            <p>Your appointment has been confirmed with Dr. ".ucfirst($doctor->firstname)." ".ucfirst($doctor->lastname)." at ".date('d/m/Y', strtotime($date))." on ".$time."</p>
//            <p>Thanks for choosing The Eye Doctor's. Eye Care...We Care.</p>
//            </body>
//            </html>";
//            $to = $patient->email;
//            $headers = "MIME-Version: 1.0" . "\r\n";
//            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//            $headers .= 'From: <appointments@theeyedoctors.com.ng>' . "\r\n";
//            mail($to,$subject,$message,$headers);
//        }
        
//        if($type=='doctor'){
//
//            $message = "
//            <html>
//            <head><title>Mail</title></head>
//            <body>
//            <h3>Hello Dr. ".ucfirst($doctor->firstname)." ".ucfirst($doctor->lastname).",</h3>
//            <p>Your have an appointment with Patient ".ucfirst($patient->firstname).' '.ucfirst($patient->lastname)." at ".date('d/m/Y', strtotime($date))." on ".$time."</p>
//
//            <p>The Eye Doctor's. Eye Care...We Care</p>
//            </body>
//            </html>";
//            $to = $doctor->email;
//            $headers = "MIME-Version: 1.0" . "\r\n";
//            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//            $headers .= 'From: <appointments@theeyedoctors.com.ng>' . "\r\n";
//            mail($to,$subject,$message,$headers);
//        }
//    }
//
    
    public function removeSubadmin($id)
    {
        if(Auth::user()->role=='superadmin'){
            DB::table('users')->where('id', $id)->delete();
            Session::flash('success','Administrators veiksmīgi izdzēsta');
            return Redirect::back();
        }else{
            abort('404');
        }
    }
    
    public function removeDoctor($id)
    {
        if(Auth::user()->role=='superadmin'){
            DB::table('doctors')->where('id', $id)->delete();
            Session::flash('success','Meistare veiksmīgi izdzēsta');
            return Redirect::back();
        }else{
            abort('404');
        }
    }
    
    public function removePatient($id)
    {
        if(Auth::user()->role=='superadmin'){
            DB::table('patients')->where('id', $id)->delete();
            Session::flash('success','Klients veiksmīgi izdzēsta');
            return Redirect::back();
        }else{
            abort('404');
        }
    }
    
    public function removeAppointment($id)
    {
        if(Auth::user()->role=='superadmin'){
            DB::table('appointments')->where('id', $id)->delete();
            Session::flash('success','Vizīte veiksmīgi izdzēsta');
            return Redirect::back();
        }else{
            abort('404');
        }
    }
    
    public function removeDiagnosis($id)
    {
        if(Auth::user()->role=='superadmin'){
            DB::table('diagnosis')->where('id', $id)->delete();
            Session::flash('success','Procedūra veiksmīgi izdzēsta');
            return Redirect::back();
        }else{
            abort('404');
        }
    }
    
    
    public static function getSlots()
    {
        $slots = array();
        $start = strtotime('07:00');
        $end = strtotime('17:50');

         for ($i=$start; $i<=$end; $i = $i + 10*60)
        {
            $slots[] = date('g:ia',$i);
        }
        
        return $slots;
    }
    
    public static function getBookedSlots($doctorid, $date)
    {
        $appointments = DB::table('appointments')->where('doctorid', $doctorid)->where('date', $date)->get();
        $booked = array();
        foreach($appointments as $a){
            $booked[] = date('g:ia' ,strtotime($a->time));
        }
        
        return $booked;
    }
    
    public static function getAppointmentInfo($date, $doctorid, $slot)
    {
        $appointment = DB::table('appointments')->where('doctorid', $doctorid)->where('date', $date)->where('time', date('G:i', strtotime($slot)))->first();
        $patient = DB::table('patients')->where('id', $appointment->patientid)->first();
        if($patient){
            $patientname = $patient->firstname." ".$patient->lastname;
        }else{
            $patientname = 'Deleted';
        }
        
        $diagnosis = DB::table('diagnosis')->where('id', $appointment->diagnosis)->first();
        if($diagnosis){
            $diagnosisname = $diagnosis->name;
        }else{
            $diagnosisname = 'Deleted';
        }
        
        return "Patient: $patientname<br>Diagnosis: $diagnosisname";
    }
    
    
    
    
    
    
    
    
}