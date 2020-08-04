<?php include('server.php'); ?>
<?php
 $mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
if(isset($_GET['date'])){
    $date = $_GET['date'];
        $stmt = $mysqli->prepare("select * from bookings where date=?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['timeslot'];
            }
            
            $stmt->close();
        }
    }
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $timeslot = $_POST['timeslot'];
    $email = $_POST['email'];
    $hospital=$_POST['grouplabel_name'];
    $stmt = $mysqli->prepare("select * from bookings where date=? AND timeslot=? AND hospital_doctor=?");
    $stmt->bind_param('sss', $date,$timeslot,$hospital);
  
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
         
        }
        else{
            $stmt = $mysqli->prepare("INSERT INTO bookings (name,timeslot,email,hospital_doctor,date) VALUES (?,?,?,?,?)");
            $stmt->bind_param('sssss', $name,$timeslot, $email,$hospital, $date);
            $stmt->execute();
            $msg = "<div class='alert alert-success'>Booking Successfull</div>";
            $bookings[]=$timeslot;
            $stmt->close();
            $mysqli->close();
        }
    }

   
}
$duration=30;
$cleanup=0;
$start="09:00";
$end="15:00";
function timeslots($duration,$cleanup,$start,$end){
    $start=new DateTime($start);
    $end=new DateTime($end);
    $interval=new DateInterval("PT".$duration."M");
    $cleanupInterval=new DateInterval("PT".$cleanup."M");
    $slots=array();
    for($intStart=$start;$intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
        $endPeriod=clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end)
        {
        break;
        }
        $slots[]=$intStart->format("H:iA")."-".$endPeriod->format("H:iA");

    }
    return $slots;
}

?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/js/jquery.payform.min.js" charset="utf-8"></script>
  </head>

  <body>
    <div class="container">
    <button id="formButton" class="btn btn-light btn-lg" type="button" style="margin-left:80%;margin-top:3%" name="my"><a href="myappointment.php" style="color:black;text-decoration: none;">My Appointments</a></button>
        <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
       
        <div class="row">
            <div class="col-md-12">
                <?php echo 
                isset($msg)?$msg:"";
                ?>
            </div>
         
            <?php
              $timeslots=timeslots($duration,$cleanup,$start,$end);
                    foreach($timeslots as $ts){
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <?php if(in_array($ts,$bookings)){?>
                        <button class="btn btn-sucess book" data-timeslot="<?php echo $ts ;?>"><?php echo $ts ;?></button>

                    <?php }else{ ?>
                             <button class="btn btn-success book" data-timeslot="<?php echo $ts ;?>"><?php echo $ts ;?>
                             </button>

                <?php }?>
               
                    </div>
            </div>
          <?php
             }
          ?>
          
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Booking:
            <span id="slot"></span>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">time slot</label>
                        <input type="text" class="form-control" readonly name="timeslot" id="timeslot" required>

                    </div>
                    <div class="form-group">
                        <label for="">name</label>
                        <input type="text" class="form-control"  name="name" required>

                    </div>
                    <div class="form-group">
                        <label for="">email</label>
                        <input type="email"  name="email" class="form-control" required>

                    </div>
                    <h5><b>doctor</b></h5>
                    <select name="grouplabel_name" required>
<option>Choose</option>
    <?php
        $query = mysqli_query($db,"SELECT * FROM groupnames ORDER BY id ASC")or die(mysqli_error($db));

            while($row = mysqli_fetch_object($query)){
                $grouplabel = $row->groupname; 
                $name = $row->name;

                    if($grouplabel == "Apollo"){
                    ?>
                    <optgroup label="Apollo">
                        <option value="<?php echo $grouplabel.' - '.$name; ?>"><?php 
                            if($name == "Dr.Robert"){
                            echo "Dr.Robert"; 
                            }
                            elseif($name == "Dr.Sreeja"){
                            echo "Dr.Sreeja";
                            }
                            elseif($name == "Dr.Karthik"){
                              echo "Dr.Karthik";
                              }
                    ?>    
                        </option>
                    </optgroup>

                    <?php
                    }
                    elseif($grouplabel == "KIMS"){
                    ?>
                    <optgroup label="KIMS">
                        <option value="<?php echo $grouplabel.' - '.$name; ?>"><?php 
                            if($name == "Dr.Priya"){
                            echo "Dr.Priya"; 
                            }
                            elseif($name == "Dr.Avinash"){
                            echo "Dr.Avinash";
                            }
                            elseif($name == "Dr.Kushi"){
                              echo "Dr.Kushi";
                              }
                    ?>
                        </option>
                    </optgroup>

                    <?php
                    }
                    elseif($grouplabel == "Nirmala"){
                    ?>
                    <optgroup label="Nirmala">
                        <option value="<?php echo $grouplabel.' - '.$name; ?>"><?php 
                            if($name == "Dr.Arnav"){
                            echo "Dr.Arnav"; 
                            }
                            elseif($name == "Dr.Manvisree"){
                            echo "Dr.Manvisree";
                            }
                            elseif($name == "Dr.Indhu"){
                              echo "Dr.Indhu";
                              }
                    ?>
                        </option>
                    </optgroup>
                    <?php
                    }
                    elseif($grouplabel == "Fernandaze"){
                    ?>
                    <optgroup label="Fernandaze">
                        <option value="<?php echo $grouplabel.' - '.$name; ?>"><?php 
                            if($name == "Dr.Manish"){
                            echo "Dr.Manish"; 
                            }
                            elseif($name == "Dr.Vineel"){
                            echo "Dr.Vineel";
                            }
                            elseif($name == "Dr.Ravi"){
                              echo "Dr.Ravi";
                              }
                    ?>
                        </option>
                    </optgroup>
                    <?php
                    }
                    elseif($grouplabel == "Holistic"){
                    ?>
                    <optgroup label="Holistic">
                        <option value="<?php echo $grouplabel.' - '.$name; ?>"><?php 
                            if($name == "Dr.Vamshi"){
                            echo "Dr.Vamshi"; 
                            }
                            elseif($name == "Dr.Vijaya"){
                            echo "Dr.Vijaya";
                            }
                            elseif($name == "Dr.Susheela"){
                              echo "Dr.Susheela";
                              }
                    ?>
                        </option>
                    </optgroup>
                    <?php
                    }
            }
        ?>
</select>

<hr style="    margin-top: 46px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid black;">
  
  <h4>Payment Details:</h4>
  <div class="form-group">
                        <label for="">Owner</label>
                        <input type="text" class="form-control"  name="owner" id="owner" required>

                    </div>
                    <div class="form-group">
                        <label for="">CVV</label>
                        <input type="password" class="form-control" minlength="3" maxlength="4" name="cvv" id="cvv" required>

                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="">Card Number</label>
                        <input type="text" class="form-control" minlength="16" maxlength="16" name="cardnumber" id="cardnumber" required>

                    </div>
                    <div class="form-group" id="expiration-date">
                <label>Expiration Date</label>
                <select>
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select>
                    <option value="16"> 2020</option>
                    <option value="17"> 2021</option>
                    <option value="18"> 2022</option>
                    <option value="19"> 2023</option>
                    <option value="20"> 2024</option>
                    <option value="21"> 2025</option>
                </select>
            </div>
            <div class="form-group" id="credit_cards">
                <img src="visa.jpg" id="visa">
                <img src="mastercard.jpg" id="mastercard">
                <img src="amex.jpg" id="amex">
            </div>
            <div class="form-group" id="amount">
            <button type="button" class="btn btn-primary btn-lg">Amount : ₹500 </button>
            </div>
                        <div class="form-group pull-right">
                        <button class="btn btn-primary" type="submit" id="confirm-purchase" name="submit" onclick="valid()">submit</button>
                    </div>
            </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/js/jquery.payform.min.js" charset="utf-8"></script>
    <!-- <script src="assets/js/script.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 <script>
     $(".book").click(function(){
         var timeslot=$(this).attr('data-timeslot');
         $("#slot").html(timeslot);
         $("#timeslot").val(timeslot);
         $("#myModal").modal("show");

     })

     function valid()
     {
        var owner=document.getElementById('owner').value;
        if(!owner.match(/^[A-Za-z][a-zA-Z ]*$/))
        alert("Owner name must be in alphabets");
     }
     
 </script> 
 
</body>

</html>