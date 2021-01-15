<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Quotation;
use Illuminate\Http\Request;
use App\Patients;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PatientsController extends Controller
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
    	if(request()->has('q')){
    	  $q = request()->q;
    	  $patients = Patients::where('firstname', 'LIKE', $q.'%')->orWhere('lastname', 'LIKE', $q.'%')->paginate(100);
    	}else{
    	  $patients = Patients::orderBy('firstname', 'asc')->paginate(200);
          $q = "";
    	}
         
         return view('patients', compact('patients', 'q'));
    }
    
    public function ajaxPatients(Request $request)
    {
       $q = $request->q; //query parameter
       $patients = Patients::where('firstname', 'like', '%' . $q . '%')->orWhere('lastname', 'like', '%' . $q . '%')->get();
      if(count($patients)){
          foreach ($patients as $p) {
            $patientname = $p->firstname.' '.$p->lastname.' | '.$p->phone.' | '.$p->email;
            $data[] = array('id' => $p->id, 'text' => $patientname);
           }
      }else{
            $data[] = array('id' => '0', 'text' => 'No Patients Found');
      }
       echo json_encode($data);
    }
    
    
    public function add_patient()
    {
        return view('addpatient');
    }
    
    public function allAppointments($id)
    {
        $patient = Patients::where('id', $id)->first();
        $appointments = DB::table('appointments')->where('patientid', $id)->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        return view ('allappointments', compact('patient', 'appointments'));
    }
    
    public function add_new_patient(Request $request)
    {
        $this->validate($request, [
            'firstname'   =>   'required|string',
            'lastname'   =>   'string',
            'dob'   =>   'required|string',
            'gender'   =>   'required|string',
            'phonenumber'   =>   'required|string',
            'email'   =>   'string|email|max:255',
        ]);
        
        
      DB::table('patients')->insert(
             array(
                    'firstname'   =>   ucfirst($request->firstname),
                    'lastname'   =>   ucfirst($request->lastname),
                    'dob'   =>   date('Y-m-d', strtotime($request->dob)),
                    'gender'   =>   $request->gender,
                    'phone'   =>   $request->phonenumber,
                    'email' => $request->email,
                    'dateadded' => date('Y-m-d h:i:sa')
             )
        );
        
        Session::flash('success','Klients pievienots veiksmīgi!');
        return Redirect::back();
    }
    
    
    public function editPatientView($id)
    {
        $patient = DB::table('patients')->where('id', $id)->first();
        return view ('addpatient', compact('patient'));
    }
    
    
    public function editPatient(Request $request)
    {
        $this->validate($request, [
            'firstname'   =>   'required|string',
            'lastname'   =>   'required|string',
            'dob'   =>   'required|string',
            'gender'   =>   'required|string',
            'phonenumber'   =>   'required|string',
            'email'=>'required|email',
            
        ]);
        
        DB::table('patients')->where('id',$request->patientid)->update(
             array(
                    'firstname'   =>   $request->firstname,
                    'lastname'   =>   $request->lastname,
                    'dob'   =>   date('Y-m-d', strtotime($request->dob)),
                    'gender'   =>   $request->gender,
                    'phone'   =>   $request->phonenumber,
                    'email'   =>   $request->email,

             )
        );
        
        Session::flash('success','Klienta informācija atjaunināta veksmīgi!');
        return Redirect::route('patienteditview', ['id' => $request->patientid]);
    }
    
    
    public function patientDetails($id)
    {
        $patient = Patients::where('id', $id)->first();
        return view ('patientdetails', compact('patient'));
    }
    
    
  




} //End Class
