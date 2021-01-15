<?php

namespace App\Http\Controllers;
use DB;
use App\Quotation;
use Illuminate\Http\Request;
use App\Doctors;
use Session;
use Redirect;
class DoctorsController extends Controller
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
    public function index()
    {
          $doctors = Doctors::all();
          return view('doctors')->withDoctors($doctors);
    }
    
    public function editAppointment($id, $doctorid)
    {
        $appointment = DB::table('appointments')->where('id', $id)->where('doctorid', $doctorid)->first();
        $diagnosis = DB::table('diagnosis')->get();
        $patient = DB::table('patients')->where('id', $appointment->patientid)->first();
        return view('editappointment', compact('appointment', 'diagnosis', 'patient'));
    }
    
    public function add_doctor()
    {
          return view('adddoctor');
    }
    
    public function editDoctorView($id)
    {
        $doctor = Doctors::where('id', $id)->first();
        return view ('adddoctor', compact('doctor'));
    }
    
    public function allAppointments($id)
    {
        $doctor = Doctors::where('id', $id)->first();
        if(request()->has('date')){
          $date = request()->date;
        }else{
          $date = date('Y-m-d');
        }
        $appointments = DB::table('appointments')->where('doctorid', $id)->where('date', $date)->orderBy('time', 'asc')->get();
        $patients = DB::table('patients')->get();
        $diagnosis = DB::table('diagnosis')->get();
        return view ('allappointments', compact('doctor', 'appointments', 'patients', 'diagnosis'));
    }
    
    public function editDoctor(Request $request)
    {
        $this->validate($request, [
            'firstname'   =>   'required|string',
            'lastname'   =>   'required|string',
            'mobilenumber'   =>   'required|string',
            'speciality'   =>   'required|string',
            'gender'   =>   'required|string',
            'email'   =>   'required|email',
        ]);
        
        DB::table('doctors')->where('id',$request->doctorid)->update(
             array(
                    'firstname'   =>   $request->firstname,
                    'lastname'   =>   $request->lastname,
                    'mobilenumber'   =>   $request->mobilenumber,
                    'speciality'   =>   $request->speciality,
                    'email'   =>   $request->email,
                    'gender'   =>   $request->gender,
             )
        );
        Session::flash('success','Doctor Profile Updated Successfuly');
        return Redirect::route('doctoreditview', ['id' => $request->doctorid]);
    }
    
    public function show($id)
    {
        //$records = DB::table('dailyentries')->where('patientid', $id)->simplePaginate(2);
        $patient = DB::table('patients')->where('id', $id)->get();
        $records = DB::table('dailyentries')->where('patientid', $id)->get();
        return view ('patient')->with('records', $records)->with('patient', $patient); 
    }
    
//    public function showreport($id)
//    {
//        //$records = DB::table('dailyentries')->where('patientid', $id)->simplePaginate(2);
//        $patient = DB::table('patients')->where('id', $id)->get();
//        $records = DB::table('dailyentries')->where('patientid', $id)->get();
//        return view ('report')->with('records', $records)->with('patient', $patient);
//    }
    
    public function doctorDetails($id)
    {
        $doctor = Doctors::where('id', $id)->first();
        return view ('doctordetails')->with('doctor', $doctor); 
    }
    
    
    public function add_new_doctor(Request $request)
    {
        $this->validate($request, [
            'firstname'   =>   'required|string',
            'lastname'   =>   'required|string',
            'mobilenumber'   =>   'required|string',
            'email'   =>   'required|email',
            'gender'   =>   'required|string',
            'speciality'   =>   'string',
        ]);
        
        
        
        DB::table('doctors')->insert(
             array(
                    'firstname'   =>   $request->firstname,
                    'lastname'   =>   $request->lastname,
                    'mobilenumber'   =>   $request->mobilenumber,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'speciality' => $request->speciality,
                    'dateadded'   =>   date('Y-m-d'),
             )
        );
        
        
        Session::flash('success','Meistars pievienots veiksmīgi!');
        return Redirect::back();
    }
    
    
    
    
    
    
}
