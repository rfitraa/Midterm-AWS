<?php
   $connect = mysqli_connect("db-midterm.cqgymu2ljsdm.us-east-1.rds.amazonaws.com", "midterm", "midterm123", "polinema_database");
   $query = "SELECT * FROM employee ORDER BY name ASC";
   $result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">  

<!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
   <style type="text/css">
       
  </style>

</head>
<body>

<div class="container" style="width: 900px;">
	<h2 align="center">Return JSON Data from PHP Script using Ajax and Jquery</h2>
	<h3 align="center">Search Employee Data</h3>

  <div class="row">
      <div class="col-md-4">
          <select name="employee_list" id="employee_list" class="form-control">
              <option value="">Select Employee </option> 
              <?php
                 while($row = mysqli_fetch_array($result))
                 {
                  echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                 }
              ?>
          </select>
      </div>

      <div class="col-md-4">
          <button type="button" name="search" id="search" class="btn btn-info">Search</button>
      </div>
    
 </div> <!-- row -->

  <br/>

  
<div class="table-responsive" id="employee_details" style="display: none;">
    <table class="table table-bordered">
       <tr>
          <td width="10%" align="right"><b>Name</b></td>
          <td width="90%"><span id="employee_name"></span></td>
        </tr>
        <tr>
          <td width="10%" align="right"><b>Address</b></td>
          <td width="90%"><span id="employee_address"></span></td>
        </tr>
        <tr>
          <td width="10%" align="right"><b>Gender</b></td>
          <td width="90%"><span id="employee_gender"></span></td>
        </tr>
        <tr>
          <td width="10%" align="right"><b>Designation</b></td>
          <td width="90%"><span id="employee_designation"></span></td>
        </tr>
        <tr>
          <td width="10%" align="right"><b>Age</b></td>
          <td width="90%"><span id="employee_age"></span></td>
        </tr>
      
    </table>    
</div>  <!-- table responsive -->
 
	
</div>


 <!-- BOOTSTRAP 4 -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

 
</body>
</html>


<script>
  $(document).ready(function(){
    $('#search').click(function(){
      var id = $('#employee_list').val();
      if(id !="") {
        $.ajax({
         url:"fetch.php",
         method:"POST",
         data:{id:id},
         dataType:"JSON",
         success:function(data){
             $('#employee_details').css("display", "block");
             $('#employee_name').text(data.name);
             $('#employee_address').text(data.address);
             $('#employee_gender').text(data.gender);
             $('#employee_designation').text(data.designation);
             $('#employee_age').text(data.age);
         }  // success

        });
      } // if
      else {
        alertify.error("Please select employee");
        $('#employee_details').css("display", "none");
      } // else

    });   // search click

  });  // document

</script>


