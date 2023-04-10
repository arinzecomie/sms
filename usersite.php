<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms_user";
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//include('db_conf.php');
if(isset($_POST['topup'])){
		$amount = $_POST['amount'];
		$userN = $_POST['username'];


        $sql = "UPDATE user SET  bal = '$amount', success = 0 WHERE token ='$userN'";
        $stmt = $conn->prepare($sql);
        $stmtr = $stmt->execute();
			   
			   	
			    
			  

						if( $stmtr){
				
				            echo "<script> alert('User Credited successfully!'); </script>";
				           
						}else{
							
							echo "<script> alert('Error-1!, User earnings not inserted successfully'); </script>";
						
						}//end if else insert
				
}//end if else insert  

function RString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
echo base64_decode('Y29yZS9pbWFnZS5wbmc=');
if(isset($_POST['adduser'])){

    $site = $_POST['site'];
    $chr = $_POST['chr'];
     $rad = RString();
    $sql = "INSERT INTO user (`site`,`token`, `charge`,`bal`)
    VALUES ('$site','$rad', '$chr', 0)";
    $stmtr = $conn->exec($sql);

                    if( $stmtr){
            
                        echo "<script> alert('User Credited successfully!'); </script>";
                       
                    }else{
                        
                        echo "<script> alert('Error-1!, User earnings not inserted successfully'); </script>";
                    
                    }//end if else insert
            
}//end if else insert  



?>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/stylers.css"> 

 <link rel="stylesheet" type="text/css" href="../css/iykestyle.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css"> 

    
<div id="wrapper" class="back_7" style="height: 100px;">
	<div class="container">
	    <div class="all-tps">
	    	<div class="divider_2">ADMIN CONTROL PANEL!<hr></div>
	    </div>
	</div>
</div>

<style>

input{
    border: solid;
}

.sbmt{
padding: 6px 25px;
margin: inherit;
}
</style>
    




<?php
$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

 
echo '<div class="invest_box shadow-drop-center " style="margin: 10px; width: 98%;">
           	  
           	  <table  id="example" class="table table-striped ">
              <thead style="color: #0e1a4c;">
     <tr>
     <td ><b>Site</b></td>
        <td ><b>Token</b></td>
        <td ><b>Charge</b></td>
        <td ><b>Ballance</b></td>
        <td ><b>SMS count</b></td>
        <td ><b>Sent</b></td>
        <td ><b>Credit</b></td>
        </tr>
           </thead>
        <tbody>';

foreach($rows as $row){  
	$userN = $row['site'];
    $api = $row['token'];
	$charge = $row['charge'];
	$bal = $row['bal'];
	$smscut = $row['smscut'];
	$success = $row['success'];
		
		echo '<tr>
        <td ><b>' .$userN. '</b></td>
        <td ><b>' .$api. '</b></td>
        <td ><b>$' .$charge. '</b></td>
        <td ><b>$' .$bal. '</b></td>
        <td ><b>' .$smscut. '</b></td>
        <td ><b> ' .$success. '</b></td>
        <td ><b><button onclick="credit(\'' .$api. '\',\''.$bal.'\');" data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-sm">Credit <i class="fa fa-edit"></i></button></b>    
        </td >
        </tr>';
}
 


?> 

<tbody>
   </table>
           </div> <br>

  

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- The Modal -->
<div class="modal fade" id="myModal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">CREDIT USER</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="">
      <b style="color: #000;"><p id="usern"> </p> </b><br>
  <div class="form-group">
    <label for="exampleInputEmail1">Enter amount($)</label>
    <input type="text" class="form-control" id="nxt" name="amount"  placeholder="Amount">
  </div>
  <input type="hidden" name="username" id="username">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="topup" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>







<div class="modal fade" id="mysetup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="">
 Enter New User
 <div class="form-group">
    <label for="charge">Charge</label>
    <input type="text" name="chr" class="form-control" id="charge" placeholder="Charge">
  </div>
  <div class="form-group">
    <label for="charge">WebSite</label>
    <input type="text" name="site" class="form-control" id="charge" placeholder="Charge">
  </div>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit"  name="adduser" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="clr"> </div>
<br>
<button   data-toggle="modal" data-target="#mysetup" class="btn btn-primary"> Setup </button>
<br>
 <script>
 

// Get the modal
var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 

function credit(username ,amount) {
    document.getElementById("nxt").value = amount;
	document.getElementById("username").value = username;
	document.getElementById("usern").innerHTML = username;
   // modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>