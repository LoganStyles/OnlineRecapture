
@extends('layouts.master_site')

@section('content')

<?php
$pfas = $data['pfas'];
$countrys = $data['countrys'];
$states = $data['states'];
$lgas = $data['lgas'];
$salary_structures = $data['salary_structures'];
$locations = $data['locations'];
$relationship = $data['relationship'];

$client_details = $data['clientDetails'];
$sectorClass=$client_details['SectorClass'];

$EmployerCountry=$client_details['EmployerCountry']; 

//correspondence
$Nationality=($client_details['Nationality'] ==''?'NG':$client_details['Nationality']);

$CountryOfResidence=($client_details['CountryOfResidence']==''?'NG':$client_details['CountryOfResidence']);


//Next of Kin
$NokCountry=$client_details['NokCountry'];

//appointment
$locationID=(!isset($client_details['locationID']) || trim($client_details['locationID']) ==="" ?"":$client_details['locationID']);
$contactEmail=(!isset($client_details['contactEmail']) || trim($client_details['contactEmail']) ==="" ?"":$client_details['contactEmail']);
$contactPhone=(!isset($client_details['contactPhone']) || trim($client_details['contactPhone']) ==="" ?"":$client_details['contactPhone']);
$DateOfAppointment=(!isset($client_details['DateOfAppointment']) || trim($client_details['DateOfAppointment']) ==="" ?"":$client_details['DateOfAppointment']);

?>


<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
	<div class="navbar-header d-flex col">
    <a class="navbar-brand" href="#"><img style="max-width:35%;"  src="{{ asset('/css/images/iei_anchor.jpg')}}" /></a>  
	<a class="navbar-brand" href="#">Data <b>Recapture</b> Exercise</a>
        		
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
			<span class="navbar-toggler-icon"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		
		<ul class="nav navbar-nav navbar-right ml-auto">
			<li class="nav-item dropdown">
				<a href="{{route('logout')}}"><i class="fa fa-user-o"></i> Logout</a>				
			</li>
		</ul>
	</div>
</nav>


    <section class="design-process-section" id="process-tab">
        <div class="container">
            <div class="row">
                <div class="col-xs-12"> 
                    <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">

                        <li role="presentation" class="active" >
                        <a href="#personal" aria-controls="personal" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>
                                <p>Personal</p>
                            </a>
                        </li>
                        <li role="presentation"><a href="#employment" aria-controls="employment" role="tab" data-toggle="tab"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <p>Employment</p>
                            </a>
                        </li>
                        <li role="presentation"><a href="#correspondence" aria-controls="correspondence" role="tab" data-toggle="tab"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <p>Correspondence</p>
                            </a>
                        </li>
                        <li role="presentation"><a href="#nextofkin" aria-controls="nextofkin" role="tab" data-toggle="tab"><i class="fa fa-street-view" aria-hidden="true"></i>
                                <p>Next of Kin</p>
                            </a>
                        </li>
                        <li role="presentation"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab"><i class="fa fa-clipboard" aria-hidden="true"></i>
                                <p>Appointment</p>
                            </a>
                        </li>
                    </ul>
                    <!-- end design process steps--> 
                    <div style="color:#f00";>Fields marked with (*) are required</div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personal">
                            <div class="design-process-content">
                                <h3 class="semi-bold">Personal Details</h3>
                                <form class="form-horizontal" role="form" method="POST" action="#" id="form-personal" >
                                                             

                                    <fieldset>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="AccountStatus">Account Status:</label>
                                                <input type="text" class="form-control" id="AccountStatus" name="AccountStatus" readonly="true" value="{{$client_details['AccountStatus']}}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="pin">RSA PIN:</label>
                                                <input type="text" class="form-control" id="pin" name="pin" value="{{$client_details['Pin']}}" readonly="true">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="PfaName">PFA NAME:</label>
                                                <input type="text" class="form-control" id="PfaName" name="PfaName" value="{{$client_details['PfaName']}}" readonly="true">
                                                
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="PinOther1">Other Pin (1):</label>
                                                <input type="text" class="form-control" id="PinOther1" name="PinOther1" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="PfaNameOther1">Other PFA (1):</label>
                                                <select class="form-control" id="PfaNameOther1" name="PfaNameOther1">
                                                <option value="">None</option>
                                                    @foreach($pfas as $pfa)
                                                    <option value="{{$pfa->CODE}}">{{$pfa->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="PinOther2">Other Pin (2):</label>
                                                <input type="text" class="form-control" id="PinOther2" name="PinOther2" value="">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-4">
                                                <label for="PfaNameOther2">Other PFA (2):</label>
                                                <select class="form-control" id="PfaNameOther2" name="PfaNameOther2">
                                                <option value="">None</option>
                                                    @foreach($pfas as $pfa)
                                                    <option value="{{$pfa->CODE}}">{{$pfa->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="PinOther3">Other Pin (3):</label>
                                                <input type="text" class="form-control" id="PinOther3" name="PinOther3" value="{{$client_details['PinOther2']}}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="PfaNameOther3">Other PFA (3):</label>
                                                <select class="form-control" id="PfaNameOther3" name="PfaNameOther3">
                                                <option value="">None</option>
                                                    @foreach($pfas as $pfa)
                                                    <option value="{{$pfa->CODE}}">{{$pfa->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-4">
                                                <label for="Title">Title:</label>
                                                <select class="form-control" id="Title" name="Title" >
                                                    <option value="MR" >MR</option>
                                                    <option value="MISS" >MISS</option>
                                                    <option value="MS" >MS</option>
                                                    <option value="MRS">MRS</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="LastName">Last Name:</label>
                                                <input type="text" class="form-control" id="LastName" name="LastName" value="{{$client_details['LastName']}}" readonly="true">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="FirstName">First Name:</label>
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="{{$client_details['FirstName']}}" readonly="true">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-4">
                                                <label for="OtherName">Other Name:</label>
                                                <input type="text" class="form-control" id="OtherName" name="OtherName" value="{{$client_details['OtherName']}}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Gender">Gender:</label>
                                                <select class="form-control" id="Gender" name="Gender">
                                                    <option value="M" >Male</option>
                                                    <option value="F" >Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="MaritalStatus">Marital Status:</label>
                                                <select class="form-control" id="MaritalStatus" name="MaritalStatus">
                                                    <option value="SG" >Single</option>
                                                    <option value="MD" >Married</option>
                                                    <option value="WD" >Widow</option>
                                                    <option value="SP" >Separated</option>
                                                    <option value="DV" >Divorce</option>
                                                </select>
                                            </div>



                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="BVN">BVN:</label>
                                                <input type="text" class="form-control" id="BVN" name="BVN" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NIN">NIN:</label>
                                                <input type="text" class="form-control" id="NIN" name="NIN" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="InternationalPassport">International Passport:</label>
                                                <input type="text" class="form-control" id="InternationalPassport" name="InternationalPassport" value="">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-4">
                                                <label for="MotherMaidenName">Mother's Maiden Name:</label>
                                                <input type="text" class="form-control" id="MotherMaidenName" name="MotherMaidenName" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="PlaceOfBirth">Place Of Birth:</label>
                                                <input type="text" class="form-control" id="PlaceOfBirth" name="PlaceOfBirth" value="">
                                            </div>

                                            <div class="col-md-4">
                                            <label class="control-label" for="date">Date Of Birth:</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="DateOfBirth" name="DateOfBirth" placeholder="DD/MM/YYYY" type="text" disabled="true"/>
                                                    <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                                </div>

                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <div class="col-md-3" style="float:right;">
                                                <button id="personal_button" type="submit" class="btn btn-success btn-lg btn-block info">
                                                    <span id="personal_button_span"><i class='fa fa-spinner fa-spin' ></i></span>Save & Continue
                                                </button>                                                
                                            </div>
                                            <!--<div class="col-md-3" style="float:right;"> 
                                                <a href="#employment" class="btn btn-primary btn-lg btn-block info" aria-controls="employment" role="tab" data-toggle="tab">Next</a>                                              
                                            </div>-->
                                            <br style="clear:all">
                                        </div> <br><br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="employment">
                            <div class="design-process-content">
                                <h3 class="semi-bold">Employment</h3>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/process_employment_details') }}" id="form-employment">
                                {!! csrf_field() !!}
                                    <fieldset>
                                    @if($sectorClass=="Public")

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="date">Date Of First Appointment:</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="DateOfFirstAppointment" name="DateOfFirstAppointment" placeholder="DD/MM/YYYY" type="text"/>
                                                        <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                                    </div>

                                            </div>

                                            <div class="col-md-4">
                                                    <label class="control-label" for="date">Date Of Current Appointment:</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="DateOfCurrentAppointment" name="DateOfCurrentAppointment" placeholder="DD/MM/YYYY" type="text"/>
                                                        <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                                    </div>

                                            </div>

                                            <div class="col-md-4">
                                                <label class="control-label" for="date">Date Of Transfer:</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="DateOfTransfer" name="DateOfTransfer" placeholder="DD/MM/YYYY" type="text"/>
                                                    <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                                </div>

                                            </div>

                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="EmployerName">Employer Name:</label>
                                                <input type="text" class="form-control" id="EmployerName" name="EmployerName" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerLocationNA">Employer Location:</label>
                                                <select class="form-control" id="EmployerLocationNA" name="EmployerLocationNA">
                                                    <option value="N" >Nigeria</option>
                                                    <option value="A" >Abroad</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerCountry">Employer Country:</label>
                                                <select class="form-control" id="EmployerCountry" name="EmployerCountry">
                                                    @foreach($countrys as $country)
                                                    <option value="{{$country->CODE}}" {{ $EmployerCountry == $country->CODE ?'selected':'' }}>{{$country->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">                                            

                                            <div class="col-md-4">
                                                <label for="EmployerState">Employer State:</label>
                                                <select class="form-control" id="EmployerState" name="EmployerState">
                                                    @foreach($states as $state)
                                                    <option value="{{$state->CODE}}" >{{$state->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerLGA">Employer LGA:</label>
                                                <select class="form-control" id="EmployerLGA" name="EmployerLGA">
                                                    @foreach($lgas as $lga)
                                                    <option value="{{$lga->CODE}}" >{{$lga->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerCity">Employer City:</label>
                                                <input type="text" class="form-control" id="EmployerCity" name="EmployerCity" value="">
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="EmployerBuildingNo">Employer Building No:</label>
                                                <input type="text" class="form-control" id="EmployerBuildingNo" name="EmployerBuildingNo" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerStreetName">Employer Street Name:</label>
                                                <input type="text" class="form-control" id="EmployerStreetName" name="EmployerStreetName" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerPOBox">Employer P O Box:</label>
                                                <input type="text" class="form-control" id="EmployerPOBox" name="EmployerPOBox" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="EmployerZipCode">Employer Zip Code:</label>
                                                <input type="text" class="form-control" id="EmployerZipCode" name="EmployerZipCode" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerPhone">Employer Phone:</label>
                                                <input type="text" class="form-control" id="EmployerPhone" name="EmployerPhone" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployerMobilePhone">Employer Mobile Phone:</label>
                                                <input type="text" class="form-control" id="EmployerMobilePhone" name="EmployerMobilePhone" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="EmployerCode">Employer Code:</label>
                                                <input type="text" class="form-control" id="EmployerCode" name="EmployerCode" value="" readonly="true">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployeeId">Employee ID:</label>
                                                <input type="text" class="form-control" id="EmployeeId" name="EmployeeId" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EmployeeServiceID">Employee Service ID:</label>
                                                <input type="text" class="form-control" id="EmployeeServiceID" name="EmployeeServiceID" value="" >
                                            </div>
                                        </div>

                                        


                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="DateEmployed">Date Employed:</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="DateEmployed" name="DateEmployed" placeholder="DD/MM/YYYY" type="text" disabled="true"/>
                                                        <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                                    </div>
                                            </div>

                                            <div class="col-md-8">
                                                <label for="NatureOfBusiness">Nature Of Business:</label>
                                                <input type="text" class="form-control" id="NatureOfBusiness" name="NatureOfBusiness" value="">
                                            </div>
                                        </div>

                                        
                                        @if($sectorClass=="Public")
                                        <div class="form-group">

                                            <div class="col-md-4">
                                                <label for="UnderIPPIS">Under IPPIS?:</label>
                                                <select class="form-control" id="UnderIPPIS" name="UnderIPPIS" disabled="true">
                                                    <option value="1">YES</option>
                                                    <option value="0">NO</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="IPPISNo">IPPIS No:</label>
                                                <input type="text" class="form-control" id="IPPISNo" name="IPPISNo" value="" readonly="true">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="control-label" for="DateJoinedIPPIS">Date Joined IPPIS:</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="DateJoinedIPPIS" name="DateJoinedIPPIS" placeholder="DD/MM/YYYY" type="text"/>
                                                    <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                                </div>

                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="HarmonizedSalaryStructure2004">Harmonized Salary Structure 2004:</label>
                                                <select class="form-control" id="HarmonizedSalaryStructure2004" name="HarmonizedSalaryStructure2004">
                                                    @foreach($salary_structures as $salary_structure)
                                                    <option value="{{$salary_structure->ID}}" >{{$salary_structure->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="GLJune2004">Grade Level June 2004:</label>
                                                <input type="number" class="form-control" id="GLJune2004" name="GLJune2004" value="">                                                    
                                            </div>

                                            <div class="col-md-4">
                                                <label for="StepJune2004">Step June 2004:</label>
                                                <input type="number" class="form-control" id="StepJune2004" name="StepJune2004" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ConsolidatedSalaryStructure2007">Consolidated Salary Structure 2007:</label>
                                                <select class="form-control" id="ConsolidatedSalaryStructure2007" name="ConsolidatedSalaryStructure2007">
                                                    @foreach($salary_structures as $salary_structure)
                                                    <option value="{{$salary_structure->ID}}"  >{{$salary_structure->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="GLJan2007">Grade Level January 2007:</label>
                                                <input type="number" class="form-control" id="GLJan2007" name="GLJan2007" value="">                                                    
                                            </div>

                                            <div class="col-md-4">
                                                <label for="StepJan2007">Step Jan 2007:</label>
                                                <input type="number" class="form-control" id="StepJan2007" name="StepJan2007" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ConsolidatedSalaryStructure2010">Consolidated Salary Structure 2010:</label>
                                                <select class="form-control" id="ConsolidatedSalaryStructure2010" name="ConsolidatedSalaryStructure2010">
                                                    @foreach($salary_structures as $salary_structure)
                                                    <option value="{{$salary_structure->ID}}" >{{$salary_structure->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="GL2010">Grade Level 2010:</label>
                                                <input type="number" class="form-control" id="GL2010" name="GL2010" value="">                                                    
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Step2010">Step 2010:</label>
                                                <input type="number" class="form-control" id="Step2010" name="Step2010" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ConsolidatedSalaryStructure2013">Consolidated Salary Structure 2013:</label>
                                                <select class="form-control" id="ConsolidatedSalaryStructure2013" name="ConsolidatedSalaryStructure2013">
                                                    @foreach($salary_structures as $salary_structure)
                                                    <option value="{{$salary_structure->ID}}" >{{$salary_structure->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="GL2013">Grade Level 2013:</label>
                                                <input type="number" class="form-control" id="GL2013" name="GL2013" value="">                                                    
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Step2013">Step 2013:</label>
                                                <input type="number" class="form-control" id="Step2013" name="Step2013" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ConsolidatedSalaryStructure2016">Consolidated Salary Structure 2016:</label>
                                                <select class="form-control" id="ConsolidatedSalaryStructure2016" name="ConsolidatedSalaryStructure2016">
                                                    @foreach($salary_structures as $salary_structure)
                                                    <option value="{{$salary_structure->ID}}" >{{$salary_structure->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="GL2016">Grade Level 2016:</label>
                                                <input type="number" class="form-control" id="GL2016" name="GL2016" value="">                                                    
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Step2016">Step 2016:</label>
                                                <input type="number" class="form-control" id="Step2016" name="Step2016" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="CurrentSalaryStructure">Current Salary Structure:</label>
                                                <select class="form-control" id="CurrentSalaryStructure" name="CurrentSalaryStructure">
                                                    @foreach($salary_structures as $salary_structure)
                                                    <option value="{{$salary_structure->ID}}" >{{$salary_structure->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="CurrentGradeLevel">Current Grade Level:</label>
                                                <input type="number" class="form-control" id="CurrentGradeLevel" name="CurrentGradeLevel" value="">                                                    
                                            </div>

                                            <div class="col-md-4">
                                                <label for="CurrentStep">Current Step :</label>
                                                <input type="number" class="form-control" id="CurrentStep" name="CurrentStep" value="">
                                            </div>
                                        </div>

                                        @endif



                                        <div class="form-group">
                                        <div class="col-md-3"> 
                                                <a href="#personal" class="btn btn-primary btn-lg btn-block info" aria-controls="personal" role="tab" data-toggle="tab">Back</a>                                              
                                            </div>
                                            <div class="col-md-3" style="float:right;">
                                                <button id="employment_button" type="submit" class="btn btn-success btn-lg btn-block info">
                                                    <span id="employment_button_span"><i class='fa fa-spinner fa-spin' ></i></span>
                                                    Save & Continue
                                                </button> 
                                            </div>
                                            <!--<div class="col-md-3" style="float:right;"> 
                                                <a href="#correspondence" class="btn btn-primary btn-lg btn-block info" aria-controls="correspondence" role="tab" data-toggle="tab">Next</a>                                              
                                            </div>-->
                                            <br style="clear:all">
                                        </div> <br><br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="correspondence">
                            <div class="design-process-content">
                                <h3 class="semi-bold">Correspondence</h3>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/process_correspondence_details') }}" id="form-correspondence" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="Nationality">Nationality:</label>
                                                <select class="form-control" id="Nationality" name="Nationality">
                                                    @foreach($countrys as $country)
                                                    <option value="{{$country->CODE}}" {{ $Nationality == $country->CODE ?'selected':'' }}>{{$country->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="StateOfOrigin">State Of Origin:</label>
                                                <select class="form-control" id="StateOfOrigin" name="StateOfOrigin">
                                                    @foreach($states as $state)
                                                    <option value="{{$state->CODE}}" >{{$state->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="LGAOfOrigin">LGA Of Origin:</label>
                                                <select class="form-control" id="LGAOfOrigin" name="LGAOfOrigin">
                                                    @foreach($lgas as $lga)
                                                    <option value="{{$lga->CODE}}">{{$lga->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="CountryOfResidence">Country Of Residence:</label>
                                                <select class="form-control" id="CountryOfResidence" name="CountryOfResidence">
                                                    @foreach($countrys as $country)
                                                    <option value="{{$country->CODE}}"  {{ $CountryOfResidence == $country->CODE ?'selected':'' }}>{{$country->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="StateOfResidence">State Of Residence:</label>
                                                <select class="form-control" id="StateOfResidence" name="StateOfResidence">
                                                    @foreach($states as $state)
                                                    <option value="{{$state->CODE}}">{{$state->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="LGAOfResidence">LGA Of Residence:</label>
                                                <select class="form-control" id="LGAOfResidence" name="LGAOfResidence">
                                                    @foreach($lgas as $lga)
                                                    <option value="{{$lga->CODE}}" >{{$lga->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="CityOfResidence">City Of Residence:</label>
                                                <input type="text" class="form-control" id="CityOfResidence" name="CityOfResidence" value="" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="StreetName">Street Name:</label>
                                                <input type="text" class="form-control" id="StreetName" name="StreetName" value="">                                                 
                                            </div>

                                            <div class="col-md-4">
                                                <label for="HouseNo">House No:</label>
                                                <input type="text" class="form-control" id="HouseNo" name="HouseNo" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ZipCode">Zip Code:</label>
                                                <input type="text" class="form-control" id="ZipCode" name="ZipCode" value="" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="POBox">POBox:</label>
                                                <input type="text" class="form-control" id="POBox" name="POBox" value="">                                                 
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Email">Email:</label>
                                                <input type="text" class="form-control" id="Email" name="Email" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="MobilePhone">Mobile Phone:</label>
                                                <input type="text" class="form-control" id="MobilePhone" name="MobilePhone" value="" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="HomePhone">Home Phone:</label>
                                                <input type="text" class="form-control" id="HomePhone" name="HomePhone" value="">     
                                                @if ($errors->has('HomePhone'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('HomePhone') }}</strong>
                                                    </span>
                                                @endif                                            
                                            </div>

                                            <div class="col-md-4">
                                                <label for="LocationNA">Location:</label>
                                                <select class="form-control" id="LocationNA" name="LocationNA">
                                                    <option value="N">Nigeria</option>
                                                    <option value="A">Abroad</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                        <div class="col-md-3"> 
                                                <a href="#employment" class="btn btn-primary btn-lg btn-block info" aria-controls="employment" role="tab" data-toggle="tab">Back</a>                                              
                                            </div>
                                            <div class="col-md-3" style="float:right;">
                                                <button id="correspondence_button" type="submit" class="btn btn-success btn-lg btn-block info">
                                                    <span id="correspondence_button_span"><i class='fa fa-spinner fa-spin'></i></span>
                                                    Save & Continue
                                                </button> 

                                            </div>
                                            <!--<div class="col-md-3" style="float:right;"> 
                                                <a href="#nextofkin" class="btn btn-primary btn-lg btn-block info" aria-controls="nextofkin" role="tab" data-toggle="tab">Next</a>                                              
                                            </div>-->
                                            <br style="clear:all">
                                        </div> <br><br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="nextofkin">
                            <div class="design-process-content">
                                <h3 class="semi-bold">Next of Kin</h3>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/process_nok_details') }}" id="form-nok">
                                {!! csrf_field() !!}
                                    <fieldset>
                                        
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="NokTitle">Nok Title:</label>
                                                <select class="form-control" id="NokTitle" name="NokTitle" >
                                                    <option value="MR">MR</option>
                                                    <option value="MISS" >MISS</option>
                                                    <option value="MS" >MS</option>
                                                    <option value="MRS" >MRS</option>

                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokName">Nok Name:</label>
                                                <input type="text" class="form-control" id="NokName" name="NokName" value="" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokSurname">Nok Surname:</label>
                                                <input type="text" class="form-control" id="NokSurname" name="NokSurname" value="" >
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="NokOthername">Nok Othername:</label>
                                                <input type="text" class="form-control" id="NokOthername" name="NokOthername" value="" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokGender">Nok Gender:</label>
                                                <select class="form-control" id="NokGender" name="NokGender">
                                                    <option value="M" >Male</option>
                                                    <option value="F" >Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokRelationship">Relationship:</label>
                                                <select class="form-control" id="NokRelationship" name="NokRelationship">
                                                    @foreach($relationship as $rel)
                                                    <option value="{{$rel->RelationshipID}}">{{$rel->Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="NokHouse">House:</label>
                                                <input type="text" class="form-control" id="NokHouse" name="NokHouse" value="" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokStreet">Street:</label>
                                                <input type="text" class="form-control" id="NokStreet" name="NokStreet" value="" >
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="NokCity">City:</label>
                                                <input type="text" class="form-control" id="NokCity" name="NokCity" value="" >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="NokCountry">Country :</label>
                                                <select class="form-control" id="NokCountry" name="NokCountry">
                                                    @foreach($countrys as $country)
                                                    <option value="{{$country->CODE}}" {{ $NokCountry == $country->CODE ?'selected':'' }}>{{$country->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokStateCode">State :</label>
                                                <select class="form-control" id="NokStateCode" name="NokStateCode">
                                                    @foreach($states as $state)
                                                    <option value="{{$state->CODE}}">{{$state->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="NokLGACode">LGA:</label>
                                                <select class="form-control" id="NokLGACode" name="NokLGACode">
                                                    @foreach($lgas as $lga)
                                                    <option value="{{$lga->CODE}}" >{{$lga->DESCRIPTION}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">                                           
                                            <div class="col-md-4">
                                                <label for="NokZipCode">Zip Code:</label>
                                                <input type="text" class="form-control" id="NokZipCode" name="NokZipCode" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokPOBox">P O Box:</label>
                                                <input type="text" class="form-control" id="NokPOBox" name="NokPOBox" value="">
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="NokEmailAddress">Email Address:</label>
                                                <input type="text" class="form-control" id="NokEmailAddress" name="NokEmailAddress" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">  

                                            <div class="col-md-4">
                                                <label for="NokCorraddress1">Correspondence Address:</label>
                                                <input type="text" class="form-control" id="NokCorraddress1" name="NokCorraddress1" value="">
                                            </div>

                                             
                                            <div class="col-md-4">
                                                <label for="NokMobilePhone">Mobile Phone:</label>
                                                <input type="text" class="form-control" id="NokMobilePhone" name="NokMobilePhone" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="NokLocationNA">Location:</label>
                                                <select class="form-control" id="NokLocationNA" name="NokLocationNA">
                                                    <option value="N" >Nigeria</option>
                                                    <option value="A" >Abroad</option>
                                                </select>
                                            </div> 

                                            
                                        </div>


                                        <div class="form-group">
                                        <div class="col-md-3"> 
                                                <a href="#correspondence" class="btn btn-primary btn-lg btn-block info" aria-controls="correspondence" role="tab" data-toggle="tab">Back</a>                                              
                                            </div>

                                            <div class="col-md-3" style="float:right;">
                                                <button id="nextofkin_button" type="submit" class="btn btn-success btn-lg btn-block info">
                                                    <span id="nextofkin_button_span"><i class='fa fa-spinner fa-spin'></i></span>
                                                    Save & Continue
                                                </button> 
                                            </div>

                                            <br style="clear:all">
                                        </div> <br><br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="summary">
                        <div class="alert alert-danger" style="display:none" id="page_errors">
                            
                        </div>
                            <div class="design-process-content">
                                <h3>Schedule An Appointment</h3>
                                <h5>To complete the Data Recapture Exercise, please visit one of our branches</h5>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/process_appointment') }}" id="form-completion">
                                {!! csrf_field() !!}
                                    <fieldset>
                                    <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ClientLocation">Location:</label>
                                                <select class="form-control" id="ClientLocation" name="ClientLocation">
                                                    @foreach($locations as $location)
                                                    <option value="{{$location->ID}}" {{ $locationID == $location->ID ?'selected':'' }} >{{$location->TITLE}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="ClientEmail"><span style="color:#f00";>*</span>Contact Email:</label>
                                                <input type="text" class="form-control" id="ClientEmail" name="ClientEmail" value="{{$contactEmail}}">
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="ClientPhone"><span style="color:#f00";>*</span>Contact Phone:</label>
                                                <input type="text" class="form-control" id="ClientPhone" name="ClientPhone" value="{{$contactPhone}}">
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4">
                                                <label class="control-label" for="DateOfAppointment">Proposed Date</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="DateOfAppointment" name="DateOfAppointment" placeholder="DD/MM/YYYY" type="text"/>
                                                <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
                                        </div>
                                        
                                    </div>
                                    
                                    </div>
                                        
                                        <div class="form-group">
                                        <div class="col-md-3"> 
                                                <a href="#nextofkin" class="btn btn-primary btn-lg btn-block info" aria-controls="nextofkin" role="tab" data-toggle="tab">Back</a>                                              
                                            </div>

                                            <div class="col-md-3" style="float:right;">
                                                <button id="summary_button" type="submit" class="btn btn-success btn-lg btn-block info">
                                                    <span id="summary_button_span"><i class='fa fa-spinner fa-spin'></i></span>
                                                    Submit
                                                </button> 
                                            </div>
                                        </div> <br><br>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
    </section>

    @endsection

