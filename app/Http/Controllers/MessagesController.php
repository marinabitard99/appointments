<?php
//
//namespace App\Http\Controllers;
//use DB;
//use App\Quotation;
//use Illuminate\Http\Request;
//use App\Messages;
//use App\NextGenMessages;
//use Session;
//use Illuminate\Support\Facades\Auth;
//use Redirect;
//use Carbon\Carbon;
//use Twilio\Rest\Client;
//class MessagesController extends Controller
//{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
//
//
//    private $sid = "AC54421645071131eb5fa9db2ab014d5ef";
//    private $token = "8923a5972bb9d2a405c797f6ed975f0e";
//    private $from = "+1 254-870-1209 ";
//
//    public function showAllPatientsMessages()
//    {
//        $patients = DB::table('patients')->get();
//        return view('messages',compact('patients'));
//    }
//
//    public function showAllDoctorMessages()
//    {
//        $doctors = DB::table('doctors')->get();
//        return view('messages',compact('doctors'));
//    }
//
//    public function sendToPatient(Request $request)
//    {
//        $this->validate($request, [
//            'message'   =>   'required|string',
//            'subject'   =>   'string',
//            'sms'   =>   'numeric',
//            'email'   =>   'numeric',
//            'patients'   =>   'required',
//        ]);
//
//        $subject = $request->subject;
//        $message = $request->message;
//        $sms = isset($request->sms) ? 1 : 0;
//        $email = isset($request->email) ? 1 : 0;
//        $patients = $request->patients;
//        foreach($patients as $patientid){
//            $patient = DB::table('patients')->where('id', $patientid)->first();
//            if($email==1){
//                $patientmail = $patient->email;
//                $patientname = $patient->firstname.' '.$patient->lastname;
//                if($patientmail){
//                    $emailbody="<html>
//                    <head><title>Mail</title></head>
//                    <body>
//                    <h3>Hello, ".$patientname."</h3>
//                    <p><b>Your have a message from Eye Doctor's Clinic:</b></p>
//                    <p>".$message."</p>
//                    <p>Thanks</p>
//                    </body>
//                    </html>";
//                    $this->sendMail($patientmail, $subject, $emailbody);
//                }
//            }
//
//            if($sms==1){
//                $patientphone = $patient->phone;
//                $patientphone = "+234".ltrim($patientphone , '0');
//                if($patientphone){
//                    $this->sendSMS($patientphone, $message);
//                }
//            }
//        }
//        Session::flash('success','Message sent successfully');
//        return Redirect::back();
//    }
//
//    public function sendToDoctor(Request $request)
//    {
//        $this->validate($request, [
//            'message'   =>   'required|string',
//            'subject'   =>   'string',
//            'sms'   =>   'numeric',
//            'email'   =>   'numeric',
//            'doctors'   =>   'required',
//        ]);
//
//        $subject = $request->subject;
//        $message = $request->message;
//        $sms = isset($request->sms) ? 1 : 0;
//        $email = isset($request->email) ? 1 : 0;
//        $doctors = $request->doctors;
//        foreach($doctors as $doctorid){
//            $doctor = DB::table('doctors')->where('id', $doctorid)->first();
//            if($email==1){
//                $doctormail = $doctor->email;
//                $doctorname = $doctor->firstname." ".$doctor->lastname;
//                if($doctormail){
//                    $emailbody="<html>
//                    <head><title>Mail</title></head>
//                    <body>
//                    <h3>Hello, Dr. ".$doctorname."</h3>
//                    <p><b>Your have a message from Eye Doctor's Clinic:</b></p>
//                    <p>".$message."</p>
//                    <p>Thanks</p>
//                    </body>
//                    </html>";
//                    $this->sendMail($doctormail, $subject, $emailbody);
//                }
//            }
//
//            if($sms==1){
//                $doctorphone = $doctor->mobilenumber;
//                $doctorphone = "+234".ltrim($doctorphone , '0');
//                if($doctorphone){
//                    $this->sendSMS($doctorphone, $message);
//                }
//            }
//        }
//        Session::flash('success','Message sent successfully');
//        return Redirect::back();
//    }
//
//
//    private function sendSMS($phone, $message)
//    {
//        $client = new Client($this->sid, $this->token);
//        $client->messages->create(
//        $phone,
//        array(
//            "from" => $this->from,
//            "body" => $message,
//        ));
//    }
//
//    private function sendMail($to, $subject, $message)
//    {
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <appointments@theeyedoctors.com.ng>' . "\r\n";
//        mail($to,$subject,$message,$headers);
//    }
//
//
//
//
//
//
//} //End Class
