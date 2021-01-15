<?php

use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/


Route::get('/time', function () {
   echo date('Y-m-d h:i:sa');  
});



Route::get('/reminder/5days', function () {

    $sid = "";
    $token = "";
    $from = "";
    
    
    
    $appointments = DB::table('appointments')->whereRaw('date = DATE_ADD(CURDATE(), INTERVAL 5 DAY)')->get();
    if($appointments){
        foreach($appointments as $ap){
            $patient = DB::table('patients')->where('id', $ap->patientid)->first();
            $doctor = DB::table('doctors')->where('id', $ap->doctorid)->first();
            $patientname = ucfirst($patient->firstname.' '.$patient->lastname);
            $doctorname = ucfirst($doctor->firstname.' '.$doctor->lastname);
            $date = date('d/m/Y', strtotime($ap->date));
            $time = date('h:ia', strtotime($ap->time));
            $gender = strtolower($patient->gender)=='male' ? 'Sir' : 'Madam';
            $phone = "+234".ltrim($patient->phone, '0');
            $message = "Hello $patientname,\nThis is a reminder of your appointment with Dr. $doctorname on $date at $time.\nThank you for choosing The Eye Doctor's. Eye Care...We Care";
            
            $client = new Client($sid, $token);
            /*$client->messages->create(
            $phone,
            array(
                "from" => $from,
                "body" => $message,
            ));*/
            
            
            $to = $patient->email;
            $subject = "Appointment Reminder";
            $txt = $message;
            $headers = "From: appointments@theeyedoctors.com.ng" . "\r\n";
            mail($to,$subject,$txt,$headers);
        }
    }
    
    
    //$dob = DB::table('patients')->whereMonth('dob', '=', date('m'))->whereDay('dob', '=', date('d'))->get();
    //var_dump($dob);
});

Route::get('/reminder/1day', function () {
    //mail("hassanrrs@gmail.com","1 Day Reminder Testing", '1 Day Reminder Testing');
    $sid = "";
    $token = "";
    $from = "";
    
    
    
    $appointments = DB::table('appointments')->whereRaw('date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)')->get();
    if($appointments){
        foreach($appointments as $ap){
            $patient = DB::table('patients')->where('id', $ap->patientid)->first();
            $doctor = DB::table('doctors')->where('id', $ap->doctorid)->first();
            $patientname = ucfirst($patient->firstname.' '.$patient->lastname);
            $doctorname = ucfirst($doctor->firstname.' '.$doctor->lastname);
            $date = date('F d, Y', strtotime($ap->date));
            $time = date('h:ia', strtotime($ap->time));
            $gender = strtolower($patient->gender)=='male' ? 'Sir' : 'Madam';
            $phone = "+234".ltrim($patient->phone, '0');
            $message = "Hello $patientname,\nTas ir atgādinājums par jūsu vizīte pie Meistera $doctorname rīt $time.\nPaldies";
            $client = new Client($sid, $token);
            /*$client->messages->create(
            $phone,
            array(
                "from" => $from,
                "body" => $message,
            ));*/
            
           
            
            $to = $patient->email;
            $subject = "Appointment Reminder";
            $txt = $message;
            $headers = "From: appointments@theeyedoctors.com.ng" . "\r\n";
            mail($to,$subject,$txt,$headers);
        }
    }
});

Route::get('/reminder/birthday', function () {
    //mail("hassanrrs@gmail.com","Birthday Reminder", 'Birthday Reminder Testing');
    $sid = "";
    $token = "";
    $from = "";
    
    
    
    $patients = DB::table('patients')->whereMonth('dob', '=', date('m'))->whereDay('dob', '=', date('d'))->get();
    //var_dump($patients);
    if($patients){
        foreach($patients as $patient){
            $patientname = ucfirst($patient->firstname.' '.$patient->lastname);
            $gender = strtolower($patient->gender)=='male' ? 'Sir' : 'Madam';
            $phone = "+234".ltrim($patient->phone, '0');
            $message = "Hello $patientname,\nThe Eye Doctor's wishes you a beautiful happy birthday because you are special.\nEye Care...We Care.";
            $client = new Client($sid, $token);
            /*$client->messages->create(
            $phone,
            array(
                "from" => $from,
                "body" => $message,
            ));*/
            
            
            
            
            $to = $patient->email;
            $subject = "Happy Birthday from The Eye Doctors";
            $txt = $message;
            $headers = "From: appointments@theeyedoctors.com.ng" . "\r\n";
            mail($to,$subject,$txt,$headers);
        }
    }
});




Auth::routes();

Route::get('/testing', 'HomeController@getSlots');
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::get('auth/google', 'SocialAuthGoogleController@redirect');
Route::get('callback/google', 'SocialAuthGoogleController@callback');
//Home Route
Route::get('/', 'HomeController@index')->name('home');
Route::get('/editprofile', 'HomeController@myProfile')->name('myprofile');
Route::get('/diagnosis', 'HomeController@showDiagnosis')->name('diagnosis');
Route::post('/diagnosis/add', 'HomeController@addDiagnosis')->name('adddiagnosis');
Route::post('/diagnosis/update', 'HomeController@updateDiagnosis')->name('updatediagnosis');
Route::get('/diagnosis/edit/{id}', 'HomeController@showEditDiagnosis')->name('showeditdiagnosis');
Route::post('/updateemail', 'HomeController@updateEmail')->name('updateemail');
Route::post('/changepassword', 'HomeController@changePassword')->name('changepassword');
Route::post('/subadmin/changepassword', 'HomeController@changeSubAdminPassword')->name('changesubadminpassword');
//Admin Routes
Route::get('/ajax/patients', 'PatientsController@ajaxPatients')->name('ajaxPatients');
Route::get('/patients', 'PatientsController@index')->name('patients');
Route::get('/subadmins', 'HomeController@allSubadmins')->name('subadmins');
Route::get('/appointments', 'HomeController@allAppointments')->name('allappointments');
Route::get('/appointments/doctor/{id}', 'DoctorsController@allAppointments')->name('doctorappointments');
Route::get('/edit/appointment/{id}/doctor/{doctorid}', 'DoctorsController@editAppointment')->name('editappointment');
Route::get('/appointments/patient/{id}', 'PatientsController@allAppointments')->name('patientappointments');
Route::get('/appointment/add', 'HomeController@showAppointments')->name('showaddappointments');
Route::get('/patient/entries/{id}', 'PatientsController@show')->name('entries');
Route::get('/patient/edit/{id}', 'PatientsController@editPatientView')->name('patienteditview');
Route::get('/patient/details/{id}', 'PatientsController@patientDetails')->name('patientdetails');
Route::get('/doctor/details/{id}', 'DoctorsController@doctorDetails')->name('doctordetails');
Route::get('/doctor/edit/{id}', 'DoctorsController@editDoctorView')->name('doctoreditview');
Route::post('/patient/addnewpatient', 'PatientsController@add_new_patient')->name('addnewpatient');
Route::post('/subadmin/addnew', 'HomeController@addSubadmin')->name('addnewsubadmin');
Route::get('/subadmin/edit/{id}', 'HomeController@editSubAdminView')->name('subadmineditview');
Route::get('/subadmin/add', 'HomeController@showAddSubadmin')->name('addsubadmin');
Route::post('/patient/editpatient', 'PatientsController@editPatient')->name('editpatient');
Route::post('/subadmin/edit', 'HomeController@editSubAdmin')->name('editsubadmin');
Route::post('/doctor/editdoctor', 'DoctorsController@editDoctor')->name('editdoctor');
Route::get('/patient/add', 'PatientsController@add_patient')->name('addpatient');
Route::get('/doctors', 'DoctorsController@index')->name('doctors');
Route::get('/doctor/add', 'DoctorsController@add_doctor')->name('adddoctor');
Route::post('/doctor/addnewdoctor', 'DoctorsController@add_new_doctor')->name('addnewdoctor');
Route::post('/appointment/add', 'HomeController@addAppointment')->name('addappointment');
Route::post('/appointment/update', 'HomeController@updateAppointment')->name('updateappointment');

//Daily Entries In Page Routes
Route::get('/patient/entries/{id}/edit/{entryid}', 'PatientsController@editshow')->name('editshow');
Route::get('/patient/report/{id}', 'PatientsController@showreport')->name('showreport');
Route::post('/patient/addentries', 'PatientsController@add_entries')->name('addentries');
Route::post('/patient/editentry', 'PatientsController@edit_entry')->name('editentry');
Route::post('/patient/update/otherstuff', 'PatientsController@ajaxUpdate')->name('updateotherstuff');
Route::get('/patient/report', 'PatientsController@showreporttopatient')->name('showreporttopatient');
//Patient Routes
Route::get('/dailyentries', 'PatientsController@showPatientEntries')->name('dailyentries');

Route::get('/patient/export',array('as'=>'export','uses'=>'PatientsController@exportReport'));
Route::post('/savegraph', 'PatientsController@saveGraph')->name('savegraph');




Route::get('subadmin/remove/{id}', 'HomeController@removeSubadmin')->name('removesubadmin');
Route::get('patient/remove/{id}', 'HomeController@removePatient')->name('removepatient');
Route::get('doctor/remove/{id}', 'HomeController@removeDoctor')->name('removedoctor');
Route::get('appointment/remove/{id}', 'HomeController@removeAppointment')->name('removeappointment');
Route::get('diagnosis/remove/{id}', 'HomeController@removeDiagnosis')->name('removediagnosis');


