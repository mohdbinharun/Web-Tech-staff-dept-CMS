<?php
  include 'Conection.php';
  
  $Serial = $apnmnt_ID = $patnt_name = $dctr_name = $deprtmnt = $dte = $srl=$time = ""; 
  $SerialError = $apnmnt_IDError = $patnt_nameError = $dctr_nameError = $deprtmntError = $dteError = $srlError=$timeError = "";
?>

<?php
    if(isset($_GET['register'])){
     if(empty($_GET['appointmentid'])){
       $apnmnt_IDError = "Appointment Id is required";
     }else{
       $apnmnt_ID =$_GET["appointmentid"];
     }
     if(empty($_GET['patientname'])){
       $patnt_nameError = "Patient Name is required";
     }else{
       $patnt_name =$_GET["patientname"];
     }
     if(empty($_GET['doctor'])){
       $dctr_nameError = "Doctor Name is required";
     }else{
       $doctor_name = $_GET['doctor'];
     }
     if(empty($_GET['department'])){
       $deprtmntError = "Department is required";
     }else{
       $deprtmnt = $_GET["department"];
     }
     if(empty($_GET['date'])){
       $dteError = "Date is required";
     }else{
       $dte = $_GET["date"];
     }
     if(empty($_GET['serial'])){
       $srlError = "Serial is required";
     }else{
       $srl = $_GET["serial"];
     }
     if(empty($_GET['time'])){
      $timeError = "Time is required";
    }else{
      $time = $_GET["time"];
    }

     // Insertion
     if( !empty($_GET['appointmentId']) && !empty($_GET['patientname']) && !empty($_GET['doctor']) && !empty($_GET['department']) && !empty($_GET['date']) && !empty($_GET['serial'])){
      $id=$_GET['appointmentId'];
      $patient_name=$_GET['patientname'];
      $doctor_name=$_GET['doctor'];
      $department=$_GET['department'];
      $Date=$_GET['date'];
      $serial=$_GET['serial'];
      $time = $_GET['time'];

      $sql ="SELECT * from appointment where AppoinmentID='$id'";
      $result = mysqli_query($con,$sql);
      if($result->num_rows > 0){
        echo '<script>alert("This appointment id already exist!")</script>';
      }
      else{
        $sql2 = "INSERT INTO appointment(`AppoinmentID`, `Patient_name`, `Doctor_name`, `Department`, `Appoinment_date`,`Appoinment_time`, `Serial`) VALUES ('$id','$patient_name','$doctor_name','$department','$Date','$time',$serial)";
        mysqli_query($con,$sql2);
        header("Location:AppointmentView.php");
      }
    }
  }
  //............................................................................
  if(isset($_GET['doctorname'])){
    $doctor_name=$_GET['doctorname'];
  }//else{
  //   $doctor_name = $_GET['doctor'];
  // }

?>


<!DOCTYPE HTML>
<html>Appointment Insertion</title>
  </head>
  <body>
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
      <center><table border="1" style="width: 700px;">
        <tr style="width:200px; heigth: 10px;">
        <td style="text-align: right;" ><a href="Logout.php">Logout</a> <br><br><br></td>

        </tr>
        <tr style="height:200px;">
          <td><h1>Appointment Register</h1> <br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <a href="Dashboard.php">Dashboard</a> &nbsp &nbsp &nbsp 
            <a href="">Patient</a>&nbsp &nbsp &nbsp
            <a href="AppointmentView.php">Appointment</a>&nbsp &nbsp &nbsp
            <a href="InvoiceDashboard.php">Transaction</a>&nbsp &nbsp &nbsp
            <a href="">Notification</a>&nbsp &nbsp &nbsp
            <a href="">Seetings</a> &nbsp &nbsp &nbsp <br> <br>
            <center>
              <table border="1" style="width: 500px;">
                <tr style="text-align:center;">
                  <td><br><br>
                    Appointment_ID: 
                    <input type="text" name="appointmentId" id=""><br>
                    <?php if(empty($_GET['appointmentId'])){?>
                    <span style="color:red;"><?php echo $apnmnt_IDError;?></span><br><br>
                    <?php } ?>
                    Patient Name: 
                    <input type="text" name="patientname" id="" ><br>
                    <?php if(empty($_GET['patientname'])){?>
                    <span style="color:red;"><?php echo $patnt_nameError;?></span><br><br>
                    <?php } ?>
                    
                    Department: 
                    <?php $sql5="select Department from allowed_date_time where Doctor_name='$doctor_name'";
                    $resultdep=mysqli_query($con,$sql5);
                    $r=mysqli_fetch_assoc($resultdep);
                    if($resultdep->num_rows > 0){
                      $department = $r['Department'];
                    }
                    ?>
                    <input type="text" name="department" value="<?php echo $department;?>" readonly><br>
                    <?php if(empty($_GET['department'])){?>
                    <span style="color:red;"><?php echo $deprtmntError;?></span><br><br>
                    <?php } ?>

                    Doctor: 
                    <input type="text" name="doctor" value="<?php echo $doctor_name;?>"readonly><br>
                    <?php if(empty($_GET['doctor'])){?>
                    <span style="color:red;"><?php echo $dctr_nameError;?></span><br><br>
                    <?php } ?>

                    serial:
                     <input type="number" name="serial" id="" ><br>
                     <?php if(empty($_GET['serial'])){?>
                     <span style="color:red;"><?php echo $srlError;?></span><br><br>
                     <?php } ?>
                     Appointment Date:
                     <select name="date">
                      <option value="">Select_date</option>
                      <?php
                        $sql3="select DISTINCT Date from allowed_date_time where Doctor_name='$doctor_name'";
                        $res = mysqli_query($con,$sql3);
                        while($r=mysqli_fetch_assoc($res)){?>
                          <option value="<?php echo $r['Date'];?>"><?php echo $r['Date'];?></option>
                      <?php } ?>    
                    </select><br><br>
                    Appointment Time:
                     <select name="time">
                      <option value="">Select_time</option>
                      <?php
                        $sql4="select DISTINCT Time from allowed_date_time where Doctor_name='$doctor_name'";
                        $res = mysqli_query($con,$sql4);
                        while($r=mysqli_fetch_assoc($res)){?>
                          <option value="<?php echo $r['Time'];?>"><?php echo $r['Time'];?></option>
                      <?php } ?>    
                    </select><br>
                     <br><br>
                    <input type="submit" name="register" id="" value="Save" style="color:blue;" ><br><br>
                  </td>
                </tr>
              </table><br><br>
            </center>

          </td>
        </tr> <br><br><br><br>
      </table></center>
    </form>
    
  </body>
</html>