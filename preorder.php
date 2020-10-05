<?php require_once 'include/header.php'; ?>
<?php
$nophp = '<?php echo  0?>';
$tempmenu = "";
$zero = 0;
$noafter = 0;
session_start();
require_once 'php_action/db_connect.php';
if($_SESSION['username'] == ""){
  header('location:'.$store_url.'index.php');
};
$condition = false;
$menu = "";
$i = 1;
$j = 0;

$query = $connect->query("SELECT * FROM menu");
$checktemp = $connect->query("SELECT * FROM temporder");


if($checktemp->num_rows > 0){
  while($row = $checktemp->fetch_assoc() and $rowimage = $query ->fetch_assoc()){
    $amount = $row['amount'];
    $qty = "qty(".$j.")";
    $foodname = "foodname(".$j.")";
    $count = "count".$i;
    $plus = "plus".$i;
    $minus = "minus".$i;
    $pbracket = "plus(".$i.")";
    $mbracket = "minus(".$i.")";
    $menu = $menu .= "<div class='row' style='padding-bottom:10px;'>
    <div class='col-sm-5'><img class='card-img-top' src='uploads/" . $rowimage['file_name'] . "' alt='Card image cap' style='width:100%''></div>
    <div class='col-sm-3'>" . $row['name'] . " </div>
    <input type='text' name='".$foodname."' style='visibility:hidden;position:absolute' value='".$row['name']."'>
    <input type='text' name='index' style='visibility:hidden;position:absolute' value=".$j.">
    <div class='col-sm-4'>
        <div class='qty mt-5'>
                    <span class='minus bg-dark ".$minus."' onClick='".$mbracket."'>-</span>
                    <input type='number' class='".$count." count' name='".$qty."' value='".$amount."'>
                    <span class='plus bg-dark ".$plus."' onClick='".$pbracket."' >+</span>
        </div>
      </div>
    </div> ";
    $i = $i + 1;
    $j = $j + 1;
}
}else if($query->num_rows > 0){
  while($row = $query->fetch_assoc()){
  $qty = "qty(".$j.")";
  $foodname = "foodname(".$j.")";
  $count = "count".$i;
  $plus = "plus".$i;
  $minus = "minus".$i;
  $pbracket = "plus(".$i.")";
  $mbracket = "minus(".$i.")";
  $menu = $menu .= "<div class='row' style='padding-bottom:10px;'>
  <div class='col-sm-5'><img class='card-img-top' src='uploads/" . $row['file_name'] . "' alt='Card image cap' style='width:100%''></div>
  <div class='col-sm-3'>" . $row['name'] . " </div>
  <input type='text' name='".$foodname."' style='visibility:hidden;position:absolute' value='".$row['name']."'>
  <input type='text' name='index' style='visibility:hidden;position:absolute' value=".$j.">
  <div class='col-sm-4'>
      <div class='qty mt-5'>
                  <span class='minus bg-dark ".$minus."' onClick='".$mbracket."'>-</span>
                  <input type='number' class='".$count." count' name='".$qty."' value='0'>
                  <span class='plus bg-dark ".$plus."' onClick='".$pbracket."' >+</span>
      </div>
    </div>
  </div> ";
$i = $i + 1;
$j = $j + 1;
}
};

if(isset($_POST['insert'])){
  $menu = "";
  $i = 0;
  $j = 0;
  $sql = "SELECT * FROM temporder";
  $querytemp = $connect->query($sql);
  if($querytemp->num_rows == 0){
  for($x = 0;$x <= $_POST['index'];$x++){
    $noafter = $_POST['qty('.$x.')'];
    $food = $_POST['foodname('.$x.')'];
    if($noafter != 0) {
      $sql = "INSERT INTO temporder (name,amount)
      VALUES ('$food','$noafter')";

      if($connect->query($sql) === TRUE) {

      };



          // echo "food name: ".$_POST['foodname('.$x.')'];
    // echo "amount: ".$noafter;
  }
  $foodname = "foodname(".$j.")";
  $qty = "qty(".$j.")";
  $foodname = "foodname(".$j.")";
  $count = "count".$i;
  $plus = "plus".$i;
  $minus = "minus".$i;
  $pbracket = "plus(".$i.")";
  $mbracket = "minus(".$i.")";
  $imagename= "";
  $sqlfile = "SELECT * FROM menu WHERE name = '$food'";
  $query = $connect->query($sqlfile);
  while($row = $query->fetch_assoc()){
      $imagename = $row['file_name'];
  }

  $menu = $menu .= "<div class='row' style='padding-bottom:10px;'>
  <div class='col-sm-5'><img class='card-img-top' src='uploads/".$imagename."' alt='Card image cap' style='width:100%''></div>
  <div class='col-sm-3'>".$food." </div>
  <input type='text' name='".$foodname."' style='visibility:hidden;position:absolute' value='".$food."'>
  <input type='text' name='index' style='visibility:hidden;position:absolute' value=".$j.">
  <div class='col-sm-4'>
      <div class='qty mt-5'>
                  <span class='minus bg-dark ".$minus."' onClick='".$mbracket."'>-</span>
                  <input type='number' class='".$count." count' name='".$qty."' value='$noafter'>
                  <span class='plus bg-dark ".$plus."' onClick='".$pbracket."' >+</span>
      </div>
    </div>
  </div> ";
  $i = $i + 1;
  $j = $j + 1;
}
}
if($querytemp->num_rows > 0){
  for($x = 0;$x <= $_POST['index'];$x++){
    $anoafter = $_POST['qty('.$x.')'];
    $food = $_POST['foodname('.$x.')'];

    $sqlfind = "SELECT * FROM temporder WHERE name='$food'";
    $query = $connect->query($sqlfind);
    if($anoafter >= 1 and $query->num_rows == 0){
      $sql = "INSERT INTO temporder (name,amount) VALUES ('$food','$anoafter')";
      if($connect->query($sql) === TRUE) {
      }else{
      }
    }

    if($anoafter >= 1 and $query->num_rows >= 1){
      $sql = "UPDATE temporder SET amount = $anoafter WHERE name='$food'";
        if($connect->query($sql) === TRUE) {
        }
    }

    if($anoafter == 0 and $query->num_rows >= 1){
      $sql = "DELETE FROM temporder WHERE name='$food'";
        if($connect->query($sql) === TRUE) {
        }
    }

    $foodname = "foodname(".$j.")";
    $qty = "qty(".$j.")";
    $foodname = "foodname(".$j.")";
    $count = "count".$i;
    $plus = "plus".$i;
    $minus = "minus".$i;
    $pbracket = "plus(".$i.")";
    $mbracket = "minus(".$i.")";
    $imagename= "";
    $sqlfile = "SELECT * FROM menu WHERE name = '$food'";
    $query = $connect->query($sqlfile);
    while($row = $query->fetch_assoc()){
        $imagename = $row['file_name'];
    }
    $menu = $menu .= "<div class='row' style='padding-bottom:10px;'>
    <div class='col-sm-5'><img class='card-img-top' src='uploads/" . $imagename . "' alt='Card image cap' style='width:100%''></div>
    <div class='col-sm-3'>" . $food . " </div>
    <input type='text' name='".$foodname."' style='visibility:hidden;position:absolute' value='".$food."'>
    <input type='text' name='index' style='visibility:hidden;position:absolute' value=".$j.">
    <div class='col-sm-4'>
        <div class='qty mt-5'>
                    <span class='minus bg-dark ".$minus."' onClick='".$mbracket."'>-</span>
                    <input type='number' class='".$count." count' name='".$qty."' value='$anoafter'>
                    <span class='plus bg-dark ".$plus."' onClick='".$pbracket."' >+</span>
        </div>
      </div>
    </div> ";
    $i = $i + 1;
    $j = $j + 1;
  }
}
}


//display stuff in temporder
$mainsql = "SELECT * FROM menu";
$sql = "SELECT * FROM temporder";
$query = $connect->query($sql);
$mainquery = $connect->query($mainsql);
if($query->num_rows > 0){
  while($content = $query->fetch_assoc() and $mcontent = $mainquery->fetch_assoc()){
  $totalamount = $content['amount'] * $mcontent['price'];

  $tempmenu = $tempmenu .= "<tr><td> </td>
  <td>".$content['name']."</td> <td> ".$content['amount']."</td> <td>".$totalamount."</td> </tr>";

};
};


 if (isset($_POST['submitform'])) {
   echo "yes";
 }
 ?>

 </div>
<div class="preorderContainer" style="margin-bottom:20px;text-align:left">
  <div class="preorderForm">
    <form name = "mymenu" method="post">
    <div class="form-group">
      <label for="name">Order No: </label>
    </div>
  <div class="form-group">
    <label for="name">Full Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name">
  </div>
  <div class="form-group">
    <label for="number">Phone Number</label>
    <input type="text" class="form-control" id="number" name="number" placeholder="Enter Phone Number">
  </div>
  <div class="form-group">
    <label for="number">Address</label>
    <input type="text" class="form-control" id="address" name="adrress" placeholder="Enter Address">
  </div>
  <div class="form-group">
    <label for="order">Orders</label>
    <div id="menu_table">
    <table class="table table-hover">
  <thead>
    <tr>
      <th style="width: 4%">#</th>
      <th scope="col">Food</th>
      <th scope="col">Amount</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $tempmenu?>


    <div class="row">
      <div class="col-sm-12" style="text-align:center; padding-bottom:10px;" ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#menumodal">Add/Edit Order</button></div>

      <!-- <td> </td>
      <td>
      </td>
      <td style="text-align:center" ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#menumodal">Add/Edit Order</button></td>
      <td></td> -->
    </div>
    <tr>
      <td></td>
      <td></td>
      <td style="text-align:right">Total:</td>
      <td> 100 000</td>
    </tr>
  </tbody>
</table>
</div>

  </div>
  <div style="text-align:center">
  <button type="submit" name="submitform" class="btn btn-primary">Submit</button>
</div>
  <input type="hidden" id="jtampil" name="jtampil" value="8">

</form>
  </div>

</div>

<div class="modal fade" id="menumodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Orders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


    <div class="modal-body" id="menudetail">
      <form method="post" id="insert_form">
        <?php echo $menu;
        ?>
          <!-- <div class="row" style="padding-bottom:10px;">
          <div class="col-sm-5"><img class="card-img-top" src="uploads/food2.jpeg" alt="Card image cap" style="width:100%"></div>
          <div class="col-sm-3" name="foodname(1)">Burger</div>
          <input type="text" name="foodname(0)" style="visibility:hidden;position:absolute" value="Burger">
          <input type="text" name="index" style="visibility:hidden;position:absolute" value="1">
          <div class="col-sm-4">

            <div class="qty mt-5">
                        <span class="minus bg-dark minus1" onClick="minus(1)">-</span>
                        <input type="number" class="count count1" name="qty(0)" value="0">
                        <input type="number" class="count count1" name="qty" value="99" style="visibility:hidden;position:absolute">
                        <span class="plus bg-dark plus1" onClick="plus(1)">+</span>
            </div>
          </div>
        </div> -->

        <!-- <div class="row" style="padding-bottom:10px;">
        <div class="col-sm-5"><img class="card-img-top" src="uploads/food2.jpeg" alt="Card image cap" style="width:100%"></div>
        <div class="col-sm-3">Spageti</div>
        <input type="text" name="foodname(1)" style="visibility:hidden;position:absolute" value="Spageti">
        <input type="text" name="index" style="visibility:hidden;position:absolute" value="2">
        <div class="col-sm-4">

          <div class="qty mt-5">
                      <span class="minus bg-dark minus2" onClick="minus(2)">-</span>
                      <input type="number" class="count count2" name="qty(1)" value="0">
                      <span class="plus bg-dark plus2" onClick="plus(2)">+</span>
          </div>
        </div>
        </div> -->

        <!-- <div class="row">
          <div class="col-sm-5"><img class="card-img-top" src="food2.jpg" alt="Card image cap" style="width:100%"></div>
          <div class="col-sm-3">Burger</div>
          <div class="col-sm-4">

            <div class="qty mt-5">
                        <span class="minus bg-dark">-</span>
                        <input type="number" class="count" name="qty" value="0">
                        <span class="plus bg-dark">+</span>
            </div>
          </div>
        </div> -->
        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" style="width:100%;"/>
      </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="submit" class="btn btn-primary" name="submit" id="submit" class="submit">Submit</button> -->
        <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
</script>
<script type="text/javascript">

xxx=eval(document.mymenu.jtampil.value);
var r = $("#id0").text();
var numItems = $('.qty').length

function pilihdatatransaksi(xx)
		{
      for(x=0;x<xxx;x++)
			{
									    if(xx==x)
										{
											 if(document.mymenu.xc[xx].checked!==false)
											 {
											 	 document.mymenu.xc[x].checked=false;
                         index = "";
											 }
											 else
											 {
											 	document.mymenu.xc[xx].checked=true;
                        index = xx;
											 }
										}
										else
										{
											 document.mymenu.xc[x].checked=false;
                       // index = "";
										}
			}

    }

    function plus(x){
      $('.count'+x).val(parseInt($('.count'+x).val()) + 1 );
    }

    function minus(x){
      $('.count'+x).val(parseInt($('.count'+x).val()) - 1 );
      if ($('.count'+x).val() == -1) {
      $('.count'+x).val(0);

    }
    }
    $(document).ready(function(){
//   $("#insert_form").submit(function(){
//     $.ajax({
//      url:"insert.php",
//      method:"POST",
//      data:$('#insert_form').serialize(),
//      beforeSend:function(){
//           $('#insert').val("Inserting");
//      },
//      success:function(data){
//        alert("yse");
//           // $('#insert_form')[0].reset();
//           // $('#menu_table').html(data);
//      }
// });
//
//   });
});

</script>
</body>
</html>
