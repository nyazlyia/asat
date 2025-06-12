<?php
include ('db.php');

$sql="select * from pemesanan" ;
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);
?>

<form name="form1" method="GET" action="">
  <?php
    while($rows = mysqli_fetch_array($result)){
  ?>
  <?php echo $rows['no']; ?>
    <input name="checkbox" type="checkbox" id="checkbox[]" value="<?php echo $rows[0]; ?>"> <?php echo $rows['email']; ?>  <br>
  <?php
  }
  ?>
  <input name="delete" type="submit" id="delete" value="Delete">|<input type="submit" name="deleteAll" value="Delete All" class="bg-danger text-light"> 
  <br>

  <?php
  // Check if delete button active, start this
  //echo $_GET['checkbox'] ;
  if(isset($_GET['delete'])){
    for($i=0; $i <$count; $i++ ){
    $del_id = $_GET['checkbox'];
    $sql = "DELETE FROM pemesanan WHERE no='$del_id'";
    $result = mysqli_query($conn,$sql);
    }
  // if successful redirect to delete_multiple.php
    if($result){
    //  echo "<script> window.location.href='delete_chek.php' </script> ";
    }
  }
  ?>

</form>
