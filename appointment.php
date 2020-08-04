<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>

function test(selectBox)
{
  var op=selectBox.options[selectBox.selectedIndex];
  var optgroup=op.parentNode;
  var hosp=optgroup.label;
  var doct=op.text;
  sessionStorage.setItem("Hospital",hosp);
  sessionStorage.setItem("Doctor",doct);
}
$(document).ready(function(){
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});
</script>
      <style>
          label{
              font-weight:bold;
          }
          </style>
</head>
<body style="background: linear-gradient(to bottom, #0066ff 0%, #00ffcc 100%)">

    <h1 class="text-center"
    >Book an Appointment</h1>
<form style= "width: 486px; margin: auto;margin-top: 70px;" action="payment.php" method="post">
  <div class="form-group">
    <label for="exampleInputName">Name</label>
    <input type="text" class="form-control" id="exampleInputName"  name="uname"  placeholder="Enter name" value="<?php echo $name1; ?>">
   
  </div>
  <div class="form-group">
    <label for="exampleInputMail">Email-Id</label>
    <input type="email" class="form-control" id="exampleInputMail" placeholder="Enter email" name="mail1"  value="<?php echo $mail1; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputMobile">Phone Number</label>
    <input type="number" class="form-control" id="exampleInputMobile" placeholder="Enter mobile number" name="phno1"  value="<?php echo $phone1; ?>">
  </div>

 
 
  <select name="grouplabel_name">
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
 
  <div class="form-group">
    <label for="exampleInputdate">Date</label>
    <input type="date" class="form-control" id="exampleInputdate" placeholder="Choose appointment date" name="date" value="<?php echo $date1; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputTime">Time </label>
    <input type="time" class="form-control" id="exampleInputTime" placeholder="Select time" name="time" value="<?php echo $time1; ?>">
    <small>Working hours are 9am to 8pm</small>
  </div>


   <button type="submit" class="btn btn-primary " name="book" >
       
       Submit
       
       </button>
</form>

</body>
</html>