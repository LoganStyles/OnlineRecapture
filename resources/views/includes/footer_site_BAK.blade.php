<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/green.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/form_submissions.js')}}"></script>


<script>
    $(document).ready(function(){
      // window.location = '#personal';

//dates
      var today = new Date();
      var dd = String(today.getDate()).padStart(2,'0');
      var mm = String(today.getMonth() + 1).padStart(2,'0');
      var yyyy=today.getFullYear();
      today = dd+'/'+mm+'/'+ yyyy;

      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd/mm/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };

      var date_appointment=$('input[name="AppointmentDate"]');
      date_appointment.datepicker(options);
      date_appointment.val(today);

      var selected_dob='<?php echo $DateOfBirth; ?>';
      selected_dob=(selected_dob=='01/01/1970'?'':selected_dob);
      var dob=$('input[name="DateOfBirth"]');
      dob.datepicker(options);      
	  dob.val(selected_dob);

      var selected_DateOfFirstAppointment='<?php echo $DateOfFirstAppointment; ?>';
      selected_DateOfFirstAppointment=(selected_DateOfFirstAppointment=='01/01/1970'?'':selected_DateOfFirstAppointment);
      var DateOfFirstAppointment=$('input[name="DateOfFirstAppointment"]');
      DateOfFirstAppointment.datepicker(options);      
	  DateOfFirstAppointment.val(selected_DateOfFirstAppointment);

      var selected_DateOfCurrentAppointment='<?php echo $DateOfCurrentAppointment; ?>';
      selected_DateOfCurrentAppointment=(selected_DateOfCurrentAppointment=='01/01/1970'?'':selected_DateOfCurrentAppointment);
      var DateOfCurrentAppointment=$('input[name="DateOfCurrentAppointment"]');
      DateOfCurrentAppointment.datepicker(options);      
	  DateOfCurrentAppointment.val(selected_DateOfCurrentAppointment);

      var selected_DateOfTransfer='<?php echo $DateOfTransfer; ?>';
      selected_DateOfTransfer=(selected_DateOfTransfer=='01/01/1970'?'':selected_DateOfTransfer);
      var DateOfTransfer=$('input[name="DateOfTransfer"]');
      DateOfTransfer.datepicker(options);      
	  DateOfTransfer.val(selected_DateOfTransfer);

      var selected_DateEmployed='<?php echo $DateEmployed; ?>';
      selected_DateEmployed=(selected_DateEmployed=='01/01/1970'?'':selected_DateEmployed);
      var DateEmployed=$('input[name="DateEmployed"]');
      DateEmployed.datepicker(options);      
	  DateEmployed.val(selected_DateEmployed);

      var selected_DateJoinedIPPIS='<?php echo $DateJoinedIPPIS; ?>';
      selected_DateJoinedIPPIS=(selected_DateJoinedIPPIS=='01/01/1970'?'':selected_DateJoinedIPPIS);
      var DateJoinedIPPIS=$('input[name="DateJoinedIPPIS"]');
      DateJoinedIPPIS.datepicker(options);      
	  DateJoinedIPPIS.val(selected_DateJoinedIPPIS);

      var selected_DateOfAppointment='<?php echo $DateOfAppointment; ?>';
      selected_DateOfAppointment=(selected_DateOfAppointment=='01/01/1970'?'':selected_DateOfAppointment);
      var DateOfAppointment=$('input[name="DateOfAppointment"]');
      DateOfAppointment.datepicker(options);      
	  DateOfAppointment.val(selected_DateOfAppointment);
      
    });
</script>


</body>

</html>

