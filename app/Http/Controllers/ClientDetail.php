<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Purifier;
use Redirect;
use URL;

class ClientDetail extends App
{
    // private $base_url="http://192.168.130.10/RecaptureAPI/";
    // private $base_url="http://localhost/Recapture/";
    // private $base_url="http://localhost:62798/";
    //  private $base_url="https://ffpro.ieianchorpensions.com/RecaptureAPI/"; 

    private $base_url="";   
    

    public function __construct() {

        if($this->isPrivateIP()){
            $this->base_url="http://192.168.130.10/RecaptureAPI/";

        }else{
            $this->base_url="https://ffpro.ieianchorpensions.com/RecaptureAPI/";
        }
    }

    public function index(){
        if(null !==(session('pin')) && null !==(session('clientID'))){
            //fetch page lists 
            $data['pfas'] = DB::select('select * from pfas');
            $data['countrys'] = DB::select('select * from countrys');
            $data['states'] = DB::select('select * from  states');
            $data['lgas'] = DB::select("select * from  lgas where state_code='AB' ");
            $data['salary_structures'] = DB::select('select * from  salary_structures');
            $data['locations'] = DB::select('select * from  locations');
            $data['relationship'] = DB::select('select * from  relationship');
            $data['clientDetails']=session('clientDetails');

            $path = '/site/client';
            return view($path, ['data' => $data]);

        }else{
            return redirect()->route('login');
        }        
    }

    public function clientLogin(Request $request){

        $this->validate($request, [
            'PIN' => 'required|max:15|min:12'//modify error msg later
        ]);
        $selected_pin = filter_var($request['PIN'], FILTER_SANITIZE_STRING);  

        //chk for pin format, if PEN is not included add it,
        if(stripos($selected_pin, "PEN") !== 0 && (strlen($selected_pin)===12)){
            $selected_pin="PEN".$selected_pin;
        }

        $result_data=$this->getClientDetails($selected_pin);

        if(!empty($result_data) && empty($result_data["error_msg"])){
            session(['pin'=> $selected_pin]);
            session(['clientID' => $result_data["ID"]]);
            session(['clientDetails' =>$result_data ]);
            return redirect()->action('ClientDetail@index');

        }else{
            // return back()->withInput();
            return redirect('login')->with('error_msg', $result_data["error_msg"]);
        }       

    }
    

    public function getClientDetails($pin){
        $data=array("error_msg"=>"");

        $client = new Client (['base_uri'=> $this->base_url]);
        try{
            $response = $client->request('GET','api/GetClientDetail?pin='.$pin);
            if($response->getStatusCode() ==200){
                $body = $response->getBody();
                $content = $body->getContents();
                $data = json_decode($content,TRUE);      
                $data['error_msg']="";  
              }

        }catch(\GuzzleHttp\Exception\connectException $e){
            $data['error_msg']="Error occurred, Please try again";

        }catch(\GuzzleHttp\Exception\ClientException $e){
            $data['error_msg']="Invalid submission";
        }   
      return $data;
    }
    

    public function getLGAsForState(Request $request){

        $state = $request["state"];
        $res=array('selected_lgas'=>'');

        if(!empty($state)){
            $res['selected_lgas'] = DB::select("select * from  lgas where state_code='".$state."'");
        }
        return $res;     

    }


    public function processPersonalDetails(Request $request) {

        // $this->validate($request, [
        //     //'AccountStatus' => 'required',
        //     'PinOther1' => 'required',
        //     'dob' => 'required',
        //     'states' => 'required',
        //     'phone' => 'required',
        //     'employer' => 'required',
        //     'email' => 'required|email',
        //     'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
        //     'CaptchaCode' => 'required|valid_captcha'
        // ]);

        $status_code=$this->postData('api/PostClient',$request->all());
        if($status_code==200){
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['success'=>0]);
            }
        
    }
    

    public function processCorrespondenceDetails(Request $request) {

        // $this->validate($request, [
        //     'MobilePhone' => 'required',
        //     'HomePhone' => 'required'
        // ]);

        $status_code=$this->postData('api/PostCorrespondence',$request->all());
        if($status_code==200){
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['success'=>0]);
            }

    }

    public function processNextOfKinDetails(Request $request) {

        $status_code=$this->postData('api/PostNextOfKin',$request->all());
        if($status_code==200){
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['success'=>0]);
            }
        
    }

    public function processEmploymentDetails(Request $request) {

        $status_code=$this->postData('api/PostEmployment',$request->all());
        if($status_code==200){
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['success'=>0]);
            }

    }

    public function processAppointment(Request $request){

        $this->validate($request, [
            'contactEmail' => 'required',
            'contactPhone' => 'required'
        ]);

        $input = $request->all();

        $clientDetails=session('clientDetails');
        $ClientFirstName=$clientDetails['FirstName'];
        $ClientLastName=$clientDetails['LastName'];
       

        $subject="Data Recapture Appointment";
        
        //get team leader phone
        $location_details = DB::select('select * from  locations where ID = '.$input['locationID'] );

        $selected_location=$location_details[0];
        $team_phone =$selected_location->TEAM_LEADER_PHONE;
        $team_email =$selected_location->TEAM_LEADER_EMAIL;
        $team_leader_name =$selected_location->TEAM_LEADER;
        $branch_office =$selected_location->BRANCH_OFFICE;
        

        if($team_email !="" && $team_phone !=""){
            
            $email_data=array(
                'sender_email' => 'schedule_recapture@ieianchorpensions.com',
                'client_email'=>$input['contactEmail'],
                'client_phone'=>$input['contactPhone'],
                'client_firstname'=>$ClientFirstName,
                'client_lastname'=>$ClientLastName,
                'subject'=>$subject,
                'AppointmentDate'=>$input['DateOfAppointmentString'],
                'branch_office'=>$branch_office,
                'teamLeader'=>$team_leader_name ,
                'teamPhone'=>$team_phone ,
                'teamEmail'=>$team_email 
            );

            //mail to client
            Mail::send('emails.appointment', $email_data, function($message) use ($email_data) {
                $message->from($email_data['sender_email']);
                $message->to($email_data['client_email']);
                $message->subject($email_data['subject']);
            });
            
            //send copy to to recapture team
            Mail::send('emails.appointment_copy', $email_data, function($message) use ($email_data) {
                $message->from($email_data['sender_email']);
                $message->to("appointments.datarecapture@ieianchorpensions.com");
                // $message->bcc($email_data['c_service_email']);//designated staff
                $message->subject($email_data['subject']);
            });
        }

        $status_code=$this->postData('api/PostAppointment',$request->all());
        if($status_code==200){
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['success'=>0]);
            }
        
    }

    public function summary(){
        if($this->checkIfLoggedIn()){
            return view('/site/summary');
        }else{
            return view('/site/login');
        } 
    }

    private function postData($url,$data){

        $input = $this->sanitizeInputs($data);
        $input['Pin']=session('pin');
        $input['clientID']=session('clientID');

        $sendClient = new Client (['base_uri'=> $this->base_url]);
        $response = $sendClient->request('POST',$url,['form_params' => $input]);
        $status_code=$response->getStatusCode();
        

        $result_data=$this->getClientDetails(session('pin'));
        session(['clientDetails' =>$result_data ]);

        return $status_code;        
    }

    private function sanitizeInputs($input=[]){
        $sanitized=array();

        foreach($input as $key => $value){
            //test value to determine value type then use apporpriate sanitizer
            $sanitized[$key] = trim(filter_var($input[$key], FILTER_SANITIZE_STRING));
        }

        return $sanitized;
    }

    private function isPrivateIP(){

        $ip_address=$this->getClientIPAddress();

        if($ip_address !='UNKNOWN'){            
            $str_ip_parts = explode (".", $ip_address); 

            if($str_ip_parts[0]==10 || 
            ($str_ip_parts[0]==192 && $str_ip_parts[1]==168)  || 
            ($str_ip_parts[0]==172 && ($str_ip_parts[1]>=16 && $str_ip_parts[1]<=31)))
            {
                return true;
            }else{
                return false;
            }
            return false;
        }
        return false;
    }

    // Function to get the client ip address
    private function getClientIPAddress() {
        $ipaddress = '';
        // if ($_SERVER['HTTP_CLIENT_IP'])
        //     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        // else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        //     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        // else if($_SERVER['HTTP_X_FORWARDED'])
        //     $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        // else if($_SERVER['HTTP_FORWARDED_FOR'])
        //     $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        //  if($_SERVER['HTTP_FORWARDED'])
        //     $ipaddress = $_SERVER['HTTP_FORWARDED'];
        if($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
    
        return $ipaddress;
    }


}
