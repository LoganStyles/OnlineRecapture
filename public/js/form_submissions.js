$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("#personal_button_span").hide();
    $("#employment_button_span").hide();
    $("#correspondence_button_span").hide();
    $("#nextofkin_button_span").hide();
    $("#summary_button_span").hide();

    var base_url = "http://localhost:81/IEIOnlineRecapture/";
    // var base_url = "https://datarecapture.ieianchorpensions.com/";

    var personalData = {
        LastName: "", FirstName: "", OtherName: "", Title: "", Gender: "",
        MaritalStatus: "", MotherMaidenName: "", BVN: "", NIN: "", InternationalPassport: "",
        DateOfBirthString: "", PlaceOfBirth: "", PinOther1: "", PfaNameOther1: "", PinOther2: "",
        PfaNameOther2: "", PinOther3: "", PfaNameOther3: ""
    };

    $('#form-personal').submit(function (e) {
        e.preventDefault();

        $("#personal_button").attr('disabled', true);
        $("#personal_button_span").show();

        personalData.LastName = $('#LastName').val();
        personalData.FirstName = $('#FirstName').val();
        personalData.OtherName = $('#OtherName').val();
        personalData.Title = $('#Title').val();
        personalData.Gender = $('#Gender').val();
        personalData.MaritalStatus = $('#MaritalStatus').val();
        personalData.MotherMaidenName = $('#MotherMaidenName').val();
        personalData.BVN = $('#BVN').val();
        personalData.NIN = $('#NIN').val();
        personalData.InternationalPassport = $('#InternationalPassport').val();
        personalData.DateOfBirthString = $('#DateOfBirth').val();
        personalData.PlaceOfBirth = $('#PlaceOfBirth').val();
        personalData.PinOther1 = $('#PinOther1').val();
        personalData.PfaNameOther1 = $('#PfaNameOther1').val();
        personalData.PinOther2 = $('#PinOther2').val();
        personalData.PfaNameOther2 = $('#PfaNameOther2').val();
        personalData.PinOther3 = $('#PinOther3').val();
        personalData.PfaNameOther3 = $('#PfaNameOther3').val();

        $.ajax({

            type: 'POST',
            url: base_url + 'public/process_personal_details',
            // url: base_url + 'process_personal_details',
            data: personalData,
            success: function (data) {
                console.log(data)
                if (data.success === 1) {
                    //move to next group
                    var href = "#employment";
                    var $curr = $(".process-model  a[href='" + href + "']").parent();

                    $('.process-model li').removeClass();
                    $curr.addClass("active");
                    $curr.prevAll().addClass("visited");
                    //
                    $('#personal').removeClass("active");
                    $('#employment').addClass("active");
                } else {
                    //show failed message
                }
            },
            error: function (err) {
                console.log(err.responseText);
            },
            complete: function () {
                $("#personal_button").attr('disabled', false);
                $("#personal_button_span").hide();
            }

        });
    });

    var employeeData = {
        DateOfFirstAppointment: "", DateOfCurrentAppointment: "", DateOfTransfer: "",
        EmployerName: "", EmployerLocationNA: "", EmployerCountry: "", EmployerState: "",
        EmployerLGA: "", EmployerCity: "", EmployerBuildingNo: "", EmployerStreetName: "",
        EmployerPOBox: "", EmployerZipCode: "", EmployerPhone: "", EmployerMobilePhone: "",
        EmployeeId: "", EmployeeServiceID: "",
        NatureOfBusiness: "",
        DateJoinedIPPIS: "",
        HarmonizedSalaryStructure2004: "", GLJune2004: "", StepJune2004: "",
        ConsolidatedSalaryStructure2007: "", GLJan2007: "", StepJan2007: "",
        ConsolidatedSalaryStructure2010: "", GL2010: "", Step2010: "",
        ConsolidatedSalaryStructure2013: "", GL2013: "", Step2013: "",
        ConsolidatedSalaryStructure2016: "", GL2016: "", Step2016: "",
        CurrentSalaryStructure: "", CurrentGradeLevel: "", CurrentStep: ""
    };

    $('#form-employment').submit(function (e) {
        e.preventDefault();

        $("#employment_button").attr('disabled', true);
        $("#employment_button_span").show();

        employeeData.DateOfFirstAppointmentString = $('#DateOfFirstAppointment').val();
        employeeData.DateOfCurrentAppointmentString = $('#DateOfCurrentAppointment').val();
        employeeData.DateOfTransferString = $('#DateOfTransfer').val();
        employeeData.EmployerName = $('#EmployerName').val();
        employeeData.EmployerLocationNA = $('#EmployerLocationNA').val();
        employeeData.EmployerCountry = $('#EmployerCountry').val();
        employeeData.EmployerState = $('#EmployerState').val();
        employeeData.EmployerLGA = $('#EmployerLGA').val();
        employeeData.EmployerCity = $('#EmployerCity').val();
        employeeData.EmployerBuildingNo = $('#EmployerBuildingNo').val();
        employeeData.EmployerStreetName = $('#EmployerStreetName').val();
        employeeData.EmployerPOBox = $('#EmployerPOBox').val();
        employeeData.EmployerZipCode = $('#EmployerZipCode').val();
        employeeData.EmployerPhone = $('#EmployerPhone').val();
        employeeData.EmployerMobilePhone = $('#EmployerMobilePhone').val();

        employeeData.EmployeeId = $('#EmployeeId').val();
        employeeData.EmployeeServiceID = $('#EmployeeServiceID').val();
        employeeData.NatureOfBusiness = $('#NatureOfBusiness').val();
        employeeData.DateJoinedIPPISString = $('#DateJoinedIPPIS').val();
        employeeData.HarmonizedSalaryStructure2004 = $('#HarmonizedSalaryStructure2004').val();
        employeeData.GLJune2004 = $('#GLJune2004').val();
        employeeData.StepJune2004 = $('#StepJune2004').val();
        employeeData.ConsolidatedSalaryStructure2007 = $('#ConsolidatedSalaryStructure2007').val();
        employeeData.GLJan2007 = $('#GLJan2007').val();
        employeeData.StepJan2007 = $('#StepJan2007').val();
        employeeData.ConsolidatedSalaryStructure2010 = $('#ConsolidatedSalaryStructure2010').val();
        employeeData.GL2010 = $('#GL2010').val();
        employeeData.Step2010 = $('#Step2010').val();
        employeeData.ConsolidatedSalaryStructure2013 = $('#ConsolidatedSalaryStructure2013').val();
        employeeData.GL2013 = $('#GL2013').val();
        employeeData.Step2013 = $('#Step2013').val();
        employeeData.ConsolidatedSalaryStructure2016 = $('#ConsolidatedSalaryStructure2016').val();
        employeeData.GL2016 = $('#GL2016').val();
        employeeData.Step2016 = $('#Step2016').val();
        employeeData.CurrentSalaryStructure = $('#CurrentSalaryStructure').val();
        employeeData.CurrentGradeLevel = $('#CurrentGradeLevel').val();
        employeeData.CurrentStep = $('#CurrentStep').val();

        $.ajax({

            type: 'POST',
            url: base_url + 'public/process_employment_details',
            // url: base_url + 'process_employment_details',
            data: employeeData,
            success: function (data) {
                if (data.success === 1) {
                    var href = "#correspondence";
                    var $curr = $(".process-model  a[href='" + href + "']").parent();

                    $('.process-model li').removeClass();
                    $curr.addClass("active");
                    $curr.prevAll().addClass("visited");
                    //
                    $('#employment').removeClass("active");
                    $('#correspondence').addClass("active");
                } else {
                    //show failed message
                }
            },
            error: function (err) {
                // console.log(err.responseText);
            },
            complete: function () {
                $("#employment_button").attr('disabled', false);
                $("#employment_button_span").hide();
            }

        });

    });

    var correspondenceData = {
        Nationality: "", StateOfOrigin: "", LGAOfOrigin: "",
        CountryOfResidence: "", StateOfResidence: "", LGAOfResidence: "",
        CityOfResidence: "", StreetName: "", HouseNo: "",
        ZipCode: "", POBox: "", Email: "",
        MobilePhone: "", HomePhone: "", LocationNA: "",

    };

    $('#form-correspondence').submit(function (e) {
        e.preventDefault();

        $("#correspondence_button").attr('disabled', true);
        $("#correspondence_button_span").show();

        correspondenceData.Nationality = $('#Nationality').val();
        correspondenceData.StateOfOrigin = $('#StateOfOrigin').val();
        correspondenceData.LGAOfOrigin = $('#LGAOfOrigin').val();
        correspondenceData.CountryOfResidence = $('#CountryOfResidence').val();
        correspondenceData.StateOfResidence = $('#StateOfResidence').val();
        correspondenceData.LGAOfResidence = $('#LGAOfResidence').val();
        correspondenceData.CityOfResidence = $('#CityOfResidence').val();
        correspondenceData.StreetName = $('#StreetName').val();
        correspondenceData.HouseNo = $('#HouseNo').val();
        correspondenceData.ZipCode = $('#ZipCode').val();
        correspondenceData.POBox = $('#POBox').val();
        correspondenceData.Email = $('#Email').val();
        correspondenceData.MobilePhone = $('#MobilePhone').val();
        correspondenceData.HomePhone = $('#HomePhone').val();
        correspondenceData.LocationNA = $('#LocationNA').val();

        // console.log('correspondenceData ' + correspondenceData);

        $.ajax({

            type: 'POST',
            url: base_url + 'public/process_correspondence_details',
            // url: base_url + 'process_correspondence_details',
            data: correspondenceData,
            success: function (data) {
                console.log('success dta ' + data)
                if (data.success === 1) {
                    var href = "#nextofkin";
                    var $curr = $(".process-model  a[href='" + href + "']").parent();

                    $('.process-model li').removeClass();
                    $curr.addClass("active");
                    $curr.prevAll().addClass("visited");
                    //
                    $('#correspondence').removeClass("active");
                    $('#nextofkin').addClass("active");
                } else {
                    //show failed message
                }
            },
            error: function (err) {
                console.log(err.responseText);
                console.log(err)
            },
            complete: function () {
                $("#correspondence_button").attr('disabled', false);
                $("#correspondence_button_span").hide();
            }

        });

    });

    var nextofkinData = {
        NokTitle: "", NokName: "", NokSurname: "",
        NokOthername: "", NokGender: "", NokRelationship: "",
        NokHouse: "", NokStreet: "", NokCity: "",
        NokCountry: "", NokStateCode: "", NokLGACode: "",
        NokZipCode: "", NokPOBox: "", NokEmailAddress: "",
        NokCorraddress1: "", NokMobilePhone: "", NokLocationNA: "",
    };

    $('#form-nok').submit(function (e) {
        e.preventDefault();

        $("#nextofkin_button").attr('disabled', true);
        $("#nextofkin_button_span").show();

        nextofkinData.NokTitle = $('#NokTitle').val();
        nextofkinData.NokName = $('#NokName').val();
        nextofkinData.NokSurname = $('#NokSurname').val();
        nextofkinData.NokOthername = $('#NokOthername').val();
        nextofkinData.NokGender = $('#NokGender').val();
        nextofkinData.NokRelationship = $('#NokRelationship').val();
        nextofkinData.NokHouse = $('#NokHouse').val();
        nextofkinData.NokStreet = $('#NokStreet').val();
        nextofkinData.NokCity = $('#NokCity').val();
        nextofkinData.NokCountry = $('#NokCountry').val();
        nextofkinData.NokStateCode = $('#NokStateCode').val();
        nextofkinData.NokLGACode = $('#NokLGACode').val();
        nextofkinData.NokZipCode = $('#NokZipCode').val();
        nextofkinData.NokPOBox = $('#NokPOBox').val();
        nextofkinData.NokEmailAddress = $('#NokEmailAddress').val();
        nextofkinData.NokCorraddress1 = $('#NokCorraddress1').val();
        nextofkinData.NokMobilePhone = $('#NokMobilePhone').val();
        nextofkinData.NokLocationNA = $('#NokLocationNA').val();

        // console.log('nextofkinData ' + nextofkinData);

        $.ajax({

            type: 'POST',
            url: base_url + 'public/process_nok_details',
            // url: base_url + 'process_nok_details',
            data: nextofkinData,
            success: function (data) {
                if (data.success === 1) {
                    var href = "#summary";
                    var $curr = $(".process-model  a[href='" + href + "']").parent();

                    $('.process-model li').removeClass();
                    $curr.addClass("active");
                    $curr.prevAll().addClass("visited");
                    //
                    $('#nextofkin').removeClass("active");
                    $('#summary').addClass("active");
                } else {
                    //show failed message
                }
            },
            error: function (err) {
                // console.log(err.responseText);
            },
            complete: function () {
                $("#nextofkin_button").attr('disabled', false);
                $("#nextofkin_button_span").hide();
            }

        });
    });

    var summaryData = {
        locationID: "", contactEmail: "", contactPhone: "", DateOfAppointmentString: ""
    };

    $("#form-completion").submit(function (e) {

        e.preventDefault();

        $("#summary_button").attr('disabled', true);
        $("#summary_button_span").show();

        summaryData.locationID = $('#ClientLocation').val();
        summaryData.contactEmail = $('#ClientEmail').val();
        summaryData.contactPhone = $('#ClientPhone').val();
        summaryData.DateOfAppointmentString = $('#DateOfAppointment').val();


        $.ajax({

            type: 'POST',
            url: base_url + 'public/process_appointment',
            // url: base_url + 'process_appointment',
            data: summaryData,
            success: function (data) {
                console.log('data ' + data);
                if (data.success === 1) {
                    window.location = base_url + "public/summary";
                    // window.location=base_url +"summary";
                }
            },
            error: function (err) {
                console.log(err.responseText);
            },
            complete: function () {
                $("#summary_button").attr('disabled', false);
                $("#summary_button_span").hide();
            }

        });

    });

    $("#EmployerState").on("change", function () {
        var state = $(this).val();
        var obj = { state: state };

        $.ajax({
            type: 'POST',
            url: base_url + 'public/get_lgas',
            data: obj,
            success: function (results) {
                var response =results.selected_lgas;

                $("#EmployerLGA").html("");
                var options="";
                var current_option="";

                if(response.length > 0){
                    for(var i=0;i < response.length; i++){
                        current_option=response[i];
                        options+='<option value="'+current_option.CODE+'">'+current_option.DESCRIPTION+'</option>';
                    };

                   $("#EmployerLGA").html(options);
                }
            },
            error: function (err) {
                // console.log(err.responseText);
            },
            complete: function () {
                // console.log("list fetched!");
            }
        });
    });

    $("#StateOfOrigin").on("change", function () {
        var state = $(this).val();
        var obj = { state: state };

        $.ajax({
            type: 'POST',
            url: base_url + 'public/get_lgas',
            data: obj,
            success: function (results) {
                var response =results.selected_lgas;

                $("#LGAOfOrigin").html("");
                var options="";
                var current_option="";

                if(response.length > 0){
                    for(var i=0;i < response.length; i++){
                        current_option=response[i];
                        options+='<option value="'+current_option.CODE+'">'+current_option.DESCRIPTION+'</option>';
                    };

                   $("#LGAOfOrigin").html(options);
                }
            },
            error: function (err) {
                // console.log(err.responseText);
            },
            complete: function () {
                // console.log("list fetched!");
            }
        });
    });

    $("#StateOfResidence").on("change", function () {
        var state = $(this).val();
        var obj = { state: state };

        $.ajax({
            type: 'POST',
            url: base_url + 'public/get_lgas',
            data: obj,
            success: function (results) {
                var response =results.selected_lgas;

                $("#LGAOfResidence").html("");
                var options="";
                var current_option="";

                if(response.length > 0){
                    for(var i=0;i < response.length; i++){
                        current_option=response[i];
                        options+='<option value="'+current_option.CODE+'">'+current_option.DESCRIPTION+'</option>';
                    };

                   $("#LGAOfResidence").html(options);
                }
            },
            error: function (err) {
                // console.log(err.responseText);
            },
            complete: function () {
                // console.log("list fetched!");
            }
        });
    });

    $("#NokStateCode").on("change", function () {
        var state = $(this).val();
        var obj = { state: state };

        $.ajax({
            type: 'POST',
            url: base_url + 'public/get_lgas',
            data: obj,
            success: function (results) {
                var response =results.selected_lgas;

                $("#NokLGACode").html("");
                var options="";
                var current_option="";

                if(response.length > 0){
                    for(var i=0;i < response.length; i++){
                        current_option=response[i];
                        options+='<option value="'+current_option.CODE+'">'+current_option.DESCRIPTION+'</option>';
                    };

                   $("#NokLGACode").html(options);
                }
            },
            error: function (err) {
                // console.log(err.responseText);
            },
            complete: function () {
                // console.log("list fetched!");
            }
        });
    });

});