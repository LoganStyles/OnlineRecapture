<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/green.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/form_submissions.js')}}"></script>


<script>
    $(document).ready(function(){
    

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

  
      var dob=$('input[name="DateOfBirth"]');
      dob.datepicker(options);      
	  dob.val(today);

      var DateOfFirstAppointment=$('input[name="DateOfFirstAppointment"]');
      DateOfFirstAppointment.datepicker(options);      
	  DateOfFirstAppointment.val(today);

      var DateOfCurrentAppointment=$('input[name="DateOfCurrentAppointment"]');
      DateOfCurrentAppointment.datepicker(options);      
	  DateOfCurrentAppointment.val(today);

      var DateOfTransfer=$('input[name="DateOfTransfer"]');
      DateOfTransfer.datepicker(options);      
	  DateOfTransfer.val(today);

      var DateEmployed=$('input[name="DateEmployed"]');
      DateEmployed.datepicker(options);      
	  DateEmployed.val(today);

      var DateJoinedIPPIS=$('input[name="DateJoinedIPPIS"]');
      DateJoinedIPPIS.datepicker(options);      
	  DateJoinedIPPIS.val(today);

      var DateOfAppointment=$('input[name="DateOfAppointment"]');
      DateOfAppointment.datepicker(options);      
	  DateOfAppointment.val(today);
      
    });
</script>


</body>

</html>

