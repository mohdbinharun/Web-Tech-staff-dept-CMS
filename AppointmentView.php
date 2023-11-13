<?php
include 'Conection.php';
  
$sql = "select * from appointment";
$result = mysqli_query($con,$sql);
  
if(isset($_POST['add'])){
  header("Location:SelectDoctor.php");
}
if(isset($_POST['makedatetime'])){
  header("Location:AllowDateTime.php");
}
if(isset($_POST['doctorappointment'])){
  header("Location:AppointmentDoctorList.php");
}
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <form method="post">
      <center><table border="1" style="width: 900px;">
        <tr style="width:200px; heigth: 10px;">
          <td style="text-align: right;" ><a href="Logout.php">Logout</a> <br><br><br></td>
        </tr>
        <tr style="height:200px;">
          <td><h3>Appoinment View</h3><br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <a href="Dashboard.php">Dashboard</a> &nbsp &nbsp &nbsp 
            <a href="PatientList.php">Patient</a>&nbsp &nbsp &nbsp
            <a href="AppointmentView.php">Appointment</a>&nbsp &nbsp &nbsp
            <a href="InvoiceDashboard.php">Transaction</a>&nbsp &nbsp &nbsp
            <a href="">Notification</a>&nbsp &nbsp &nbsp
            <a href="">Seetings</a> &nbsp &nbsp &nbsp <br> <br><br><br>
            
            <center>
              <button type="submit" name="add">Add Appoinment</button>
              <button type="submit" name="makedatetime">Create Date/Time</button>
              <button type="submit" name="doctorappointment">Doctor Appointment</button>
              <table border="" style="width: 500px; text-align:center;">
                <tr style="text-align:center;">
                  <br><br>
                    <th>AppoinmentID</th>
                    <th>Patient_name</th>
                    <th>Doctor_name</th>
                    <th>Department</th>
                    <th>Appoinment_date</th>
                    <th>Appoinment_time</th>
                    <th>Serial</th>
                    <th>Action</th>
                </tr>
      </form>            
                <?php while($r=mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $r['AppoinmentID'];?></td>
                    <td><?php echo $r['Patient_name']; ?></td>
                    <td><?php echo $r['Doctor_name'];?></td>
                    <td><?php echo $r['Department']; ?></td>
                    <td><?php echo $r['Appoinment_date']; ?></td>
                    <td><?php echo $r['Appoinment_time']; ?></td>
                    <td><?php echo $r['Serial'];?></td>

                    <td>
                      <form  action="EditAppointment.php" method="get"><button type="submit" name="edit"  value="<?php echo $r["SLNo"] ; ?>">Edit</button> </form>
                      <form action="DeleteAppointment.php" method="get"><button type="submit" name="delete" value="<?php echo $r["SLNo"] ; ?>">Delete</button> </form>
                      <form  action="AddInvoice.php" method="get"><button type="submit" name="addpayment"  value="<?php echo $r["SLNo"] ; ?>">InsertPayment</button> </form>
                    </td>
                    
                </tr>
                <?php } ?>
              </table><br><br>
            </center>

          </td>
        </tr> <br><br><br><br>
      </table></center>
    
    
  </body>
</html>
