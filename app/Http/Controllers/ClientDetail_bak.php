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

class ClientDetail extends Controller
{
    // private $base_url="http://192.168.130.10/RecaptureAPI/";
    private $base_url="http://localhost/Recapture/";
    // private $base_url="http://localhost:62798/";
    //  private $base_url="https://ffpro.ieianchorpensions.com/RecaptureAPI/"; 

    public function index(){
        if(null !==(session('pin')) && null !==(session('clientID'))){
            //fetch page lists 
            $data['pfas'] = DB::select('select * from pfas');
            $data['countrys'] = DB::select('select * from countrys');
            $data['states'] = DB::select('select * from  states');
            $data['lgas'] = DB::select('select * from  lgas');
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
        if(strpos($selected_pin, "PEN") !== 0 && (strlen($selected_pin)===12)){
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
        // $form_data = array();
        // $form_data['Nationality'] = filter_var($request['Nationality'], FILTER_SANITIZE_STRING);
        // $form_data['StateOfOrigin'] = filter_var($request['StateOfOrigin'], FILTER_SANITIZE_STRING);
        // $form_data['LGAOfOrigin'] = filter_var($request['LGAOfOrigin'], FILTER_SANITIZE_STRING);
        // $form_data['HouseNo'] = filter_var($request['HouseNo'], FILTER_SANITIZE_STRING);
        // $form_data['StreetName'] = filter_var($request['StreetName'], FILTER_SANITIZE_STRING);
        // $form_data['CityOfResidence'] = filter_var($request['CityOfResidence'], FILTER_SANITIZE_STRING);
        // $form_data['StateOfResidence'] = filter_var($request['StateOfResidence'], FILTER_SANITIZE_STRING);
        // $form_data['LGAOfResidence'] = filter_var($request['LGAOfResidence'], FILTER_SANITIZE_STRING);
        // $form_data['CountryOfResidence'] = filter_var($request['CountryOfResidence'], FILTER_SANITIZE_STRING);
        // $form_data['ZipCode'] = filter_var($request['ZipCode'], FILTER_SANITIZE_STRING);
        // $form_data['POBox'] = filter_var($request['POBox'], FILTER_SANITIZE_STRING);
        // $form_data['Email'] = filter_var($request['Email'], FILTER_SANITIZE_STRING);
        // $form_data['MobilePhone'] = filter_var($request['MobilePhone'], FILTER_SANITIZE_STRING);
        // $form_data['HomePhone'] = filter_var($request['HomePhone'], FILTER_SANITIZE_STRING);
        // $form_data['LocationNA'] = filter_var($request['LocationNA'], FILTER_SANITIZE_STRING);
        // $form_data['PermanentAddress'] = filter_var($request['PermanentAddress'], FILTER_SANITIZE_STRING);
        // $form_data['ClientID'] = $request->session()->get('clientID');

        $status_code=$this->postData('api/PostCorrespondence',$request->all());
        if($status_code==200){
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['success'=>0]);
            }



        $input = $request->all();
        $input['clientID']=session('clientID');

        $sendClient = new Client (['base_uri'=> $this->base_url]);
        $response = $sendClient->request('POST','api/PostCorrespondence',['form_params' => $input]);
        $status_code=$response->getStatusCode();

        $result_data=$this->getClientDetails(session('pin'));
        session(['clientDetails' =>$result_data ]);

        if($status_code==200){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
        }

    }

    public function processNextOfKinDetails(Request $request) {
        // $form_data = array();
        // $form_data['NokTitle'] = filter_var($request['NokTitle'], FILTER_SANITIZE_STRING);
        // $form_data['NokName'] = filter_var($request['NokName'], FILTER_SANITIZE_STRING);
        // $form_data['NokSurname'] = filter_var($request['NokSurname'], FILTER_SANITIZE_STRING);
        // $form_data['NokOthername'] = filter_var($request['NokOthername'], FILTER_SANITIZE_STRING);
        // $form_data['NokGender'] = filter_var($request['NokGender'], FILTER_SANITIZE_STRING);     
        // $form_data['NokLocationNA'] = filter_var($request['NokLocationNA'], FILTER_SANITIZE_STRING);
        // $form_data['NokHouse'] = filter_var($request['NokHouse'], FILTER_SANITIZE_STRING);
        // $form_data['NokStreet'] = filter_var($request['NokStreet'], FILTER_SANITIZE_STRING);
        // $form_data['NokCity'] = filter_var($request['NokCity'], FILTER_SANITIZE_STRING);
        // $form_data['NokCountry'] = filter_var($request['NokCountry'], FILTER_SANITIZE_STRING);
        // $form_data['NokStateCode'] = filter_var($request['NokStateCode'], FILTER_SANITIZE_STRING);
        // $form_data['NokLGACode'] = filter_var($request['NokLGACode'], FILTER_SANITIZE_STRING);       
        // $form_data['NokZipCode'] = filter_var($request['NokZipCode'], FILTER_SANITIZE_STRING);
        // $form_data['NokPOBox'] = filter_var($request['NokPOBox'], FILTER_SANITIZE_STRING);
        // $form_data['NokEmailAddress'] = filter_var($request['NokEmailAddress'], FILTER_SANITIZE_STRING);
        // $form_data['NokMobilePhone'] = filter_var($request['NokMobilePhone'], FILTER_SANITIZE_STRING);
        // $form_data['NokCorraddress1'] = filter_var($request['NokCorraddress1'], FILTER_SANITIZE_STRING);
        // $form_data['NokRelationship'] = filter_var($request['NokRelationship'], FILTER_SANITIZE_STRING);

        // $form_data['NokTitle2'] = filter_var($request['NokTitle2'], FILTER_SANITIZE_STRING);
        // $form_data['NokSurname2'] = filter_var($request['NokSurname2'], FILTER_SANITIZE_STRING);
        // $form_data['NokOthername2'] = filter_var($request['NokOthername2'], FILTER_SANITIZE_STRING);
        // $form_data['NokGender2'] = filter_var($request['NokGender2'], FILTER_SANITIZE_STRING);
        // $form_data['NokName2'] = filter_var($request['NokName2'], FILTER_SANITIZE_STRING);
        // $form_data['NokRelationship2'] = filter_var($request['NokRelationship2'], FILTER_SANITIZE_STRING);
        // $form_data['NokAddress2'] = filter_var($request['NokAddress2'], FILTER_SANITIZE_STRING);

        // $form_data['NokCity2'] = filter_var($request['NokCity2'], FILTER_SANITIZE_STRING);
        // $form_data['NokStateCode2'] = filter_var($request['NokStateCode2'], FILTER_SANITIZE_STRING);
        // $form_data['NokCountry2'] = filter_var($request['NokCountry2'], FILTER_SANITIZE_STRING);
        // $form_data['NokEmailAddress2'] = filter_var($request['NokEmailAddress2'], FILTER_SANITIZE_STRING);
        // $form_data['NokMobilePhone2'] = filter_var($request['NokMobilePhone2'], FILTER_SANITIZE_STRING);
        
        // $form_data['NokCorraddress2'] = filter_var($request['NokCorraddress2'], FILTER_SANITIZE_STRING);
        // $form_data['NokHomePhone'] = filter_var($request['NokHomePhone'], FILTER_SANITIZE_STRING);

        $input = $request->all();
        $input['clientID']=session('clientID');

        $sendClient = new Client (['base_uri'=> $this->base_url]);
        $response = $sendClient->request('POST','api/PostNextOfKin',['form_params' => $input]);
        $status_code=$response->getStatusCode();

        $result_data=$this->getClientDetails(session('pin'));
        session(['clientDetails' =>$result_data ]);

        if($status_code==200){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
        }

        
        // $form_data['ClientID'] = $request->session()->get('clientID');

        // $sendClient = new Client (['base_uri'=> $this->base_url]);
        // $response = $sendClient->request('POST','api/PostNextOfKin',['form_params' => $form_data]);
        // $status_code=$response->getStatusCode();

    }

    public function processEmploymentDetails(Request $request) {
        // $form_data = array();

        // $form_data['EmployerName'] = filter_var($request['EmployerName'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerLocationNA'] = filter_var($request['EmployerLocationNA'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerBuildingNo'] = filter_var($request['EmployerBuildingNo'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerStreetName'] = filter_var($request['EmployerStreetName'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerCity'] = filter_var($request['EmployerCity'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerState'] = filter_var($request['EmployerState'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerCountry'] = filter_var($request['EmployerCountry'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerZipCode'] = filter_var($request['EmployerZipCode'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerPOBox'] = filter_var($request['EmployerPOBox'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerPhone'] = filter_var($request['EmployerPhone'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerMobilePhone'] = filter_var($request['EmployerMobilePhone'], FILTER_SANITIZE_STRING);
        // $form_data['NatureOfBusiness'] = filter_var($request['NatureOfBusiness'], FILTER_SANITIZE_STRING);
        
        // $form_data['EmployeeId'] = filter_var($request['EmployeeId'], FILTER_SANITIZE_STRING);
        // //$form_data['EmployerCode'] = filter_var($request['EmployerCode'], FILTER_SANITIZE_STRING);
        // $form_data['StateOfPosting'] = filter_var($request['StateOfPosting'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerLGA'] = filter_var($request['EmployerLGA'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerIndustry'] = filter_var($request['EmployerIndustry'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerEmail'] = filter_var($request['EmployerEmail'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerWebsite'] = filter_var($request['EmployerWebsite'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerBank'] = filter_var($request['EmployerBank'], FILTER_SANITIZE_STRING);

        // //$form_data['DateEmployedString'] = filter_var($request['DateEmployed'], FILTER_SANITIZE_STRING);
        // $form_data['DateOfFirstAppointmentString'] = filter_var($request['DateOfFirstAppointment'], FILTER_SANITIZE_STRING);
        // $form_data['DateOfCurrentAppointmentString'] = filter_var($request['DateOfCurrentAppointment'], FILTER_SANITIZE_STRING);
        // $form_data['DateOfTransferString'] = filter_var($request['DateOfTransfer'], FILTER_SANITIZE_STRING);
        // $form_data['DateJoinedIPPISString'] = filter_var($request['DateJoinedIPPIS'], FILTER_SANITIZE_STRING);

        // //$form_data['UnderIPPIS'] = filter_var($request['UnderIPPIS'], FILTER_SANITIZE_STRING);
        // //$form_data['IPPISNo'] = filter_var($request['IPPISNo'], FILTER_SANITIZE_STRING);
        // $form_data['EmployeeServiceID'] = filter_var($request['EmployeeServiceID'], FILTER_SANITIZE_STRING);
        // $form_data['HarmonizedSalaryStructure2004'] = filter_var($request['HarmonizedSalaryStructure2004'], FILTER_SANITIZE_STRING);

        // $form_data['GLJune2004'] = filter_var($request['GLJune2004'], FILTER_SANITIZE_STRING);
        // $form_data['StepJune2004'] = filter_var($request['StepJune2004'], FILTER_SANITIZE_STRING);
        // $form_data['ConsolidatedSalaryStructure2007'] = filter_var($request['ConsolidatedSalaryStructure2007'], FILTER_SANITIZE_STRING);
        // $form_data['GLJan2007'] = filter_var($request['GLJan2007'], FILTER_SANITIZE_STRING);
        // $form_data['StepJan2007'] = filter_var($request['StepJan2007'], FILTER_SANITIZE_STRING);
        // $form_data['ConsolidatedSalaryStructure2010'] = filter_var($request['ConsolidatedSalaryStructure2010'], FILTER_SANITIZE_STRING);
        // $form_data['GL2010'] = filter_var($request['GL2010'], FILTER_SANITIZE_STRING);
        // $form_data['Step2010'] = filter_var($request['Step2010'], FILTER_SANITIZE_STRING);
        // $form_data['ConsolidatedSalaryStructure2013'] = filter_var($request['ConsolidatedSalaryStructure2013'], FILTER_SANITIZE_STRING);

        // $form_data['GL2013'] = filter_var($request['GL2013'], FILTER_SANITIZE_STRING);
        // $form_data['Step2013'] = filter_var($request['Step2013'], FILTER_SANITIZE_STRING);
        // $form_data['ConsolidatedSalaryStructure2016'] = filter_var($request['ConsolidatedSalaryStructure2016'], FILTER_SANITIZE_STRING);
        // $form_data['GL2016'] = filter_var($request['GL2016'], FILTER_SANITIZE_STRING);
        // $form_data['Step2016'] = filter_var($request['Step2016'], FILTER_SANITIZE_STRING);
        // $form_data['CurrentGradeLevel'] = filter_var($request['CurrentGradeLevel'], FILTER_SANITIZE_STRING);
        // $form_data['CurrentStep'] = filter_var($request['CurrentStep'], FILTER_SANITIZE_STRING);
        // $form_data['correspondenceAdds'] = filter_var($request['correspondenceAdds'], FILTER_SANITIZE_STRING);
        // $form_data['correspondenceAdds1'] = filter_var($request['correspondenceAdds1'], FILTER_SANITIZE_STRING);
        // $form_data['EmployerAddress'] = filter_var($request['EmployerAddress'], FILTER_SANITIZE_STRING);
        // $form_data['ClientID'] = $request->session()->get('clientID');

        $input = $request->all();
        $input['clientID']=session('clientID');

        $sendClient = new Client (['base_uri'=> $this->base_url]);
        $response = $sendClient->request('POST','api/PostEmployment',['form_params' => $input]);
        $status_code=$response->getStatusCode();

        $result_data=$this->getClientDetails(session('pin'));
        session(['clientDetails' =>$result_data ]);

        if($status_code==200){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
        }
    }

    public function processAppointment(Request $request){

        // $form_data = array();
        

        // $this->validate($request, [
        //     'ClientLocation' => 'required',
        //     'AppointmentDate' => 'required',
        //     'ClientEmail' => 'required|email',
        //     'ClientPhone' => 'required|numeric'
        // ]);

        // print_r($form_data);exit;

        $input = $request->all();
        $input['clientID']=session('clientID');
        $input['ClientPIN']=session('pin');
        

        // $form_data['locationID'] = filter_var($request['ClientLocation'], FILTER_SANITIZE_STRING);
        // $form_data['contactEmail'] = filter_var($request['ClientEmail'], FILTER_SANITIZE_STRING);
        // $form_data['contactPhone'] = filter_var($request['ClientPhone'], FILTER_SANITIZE_STRING);

        //has to be today or in d future
        // $form_data['DateOfAppointmentString'] = filter_var($request['DateOfAppointment'], FILTER_SANITIZE_STRING);

        // $form_data['ClientID'] = $request->session()->get('clientID');
        // $form_data['ClientPIN'] = $request->session()->get('pin');

        $subject="Data Recapture Appointment";
        
        //get team leader phone
        $location_details = DB::select('select * from  locations where ID = '.$input['locationID'] );
        // print_r($location_details);exit;
        $selected_location=$location_details[0];
        $team_phone =$selected_location->TEAM_LEADER_PHONE;
        $team_email =$selected_location->TEAM_LEADER_EMAIL;
        // $team_phone = $location_details[0]['TEAM_LEADER_PHONE'];
        // $team_email = $location_details[0]['TEAM_LEADER_EMAIL'];

        // return response()->json($input);
        // echo 'id '.$team_phone ;exit;

        // if($team_email !="" && $team_phone !=""){
        //     $email_data=array(
        //         'c_service_email' => 'cservice@ieianchorpensions.com',
        //         'client_email'=>$input['contactEmail'],
        //         'subject'=>$subject,
        //         'AppointmentDate'=>$input['DateOfAppointmentString'],
        //         'teamPhone'=>$team_phone ,
        //         'teamEmail'=>$team_email 
        //     );
    
        //     //mail from c.service or recapture to client
        //     Mail::send('emails.appointment', $email_data, function($message) use ($email_data) {
        //         $message->from($email_data['c_service_email']);
        //         $message->to($email_data['client_email']);
        //         $message->bcc($email_data['c_service_email']);//designated staff
        //         $message->subject($email_data['subject']);
        //     });
        // }

        // print_r($input);exit;
        // return response()->json($input);
        $sendClient = new Client (['base_uri'=> $this->base_url]);
        $response = $sendClient->request('POST','api/PostAppointment',['form_params' => $input]);
        $status_code=$response->getStatusCode();

        $result_data=$this->getClientDetails(session('pin'));
        session(['clientDetails' =>$result_data ]);

        if($status_code==200){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
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


}
