<?php
include('./connect.php');
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['file'];

    echo $username . "<br>";
    echo $mobile . "<br>";
    print_r($image);
    $imagefilename = $image['name'];
    echo "<br>";
    print_r($imagefilename);
    $imagefiletemp = $image['tmp_name'];
    print_r($imagefiletemp);
    echo "<br>";

    $filename_separator = explode('.', $imagefilename);
    print_r($filename_separator);
    $file_extension = strtolower($filename_separator[1]);
    print_r($file_extension);

    $extension = array('jpeg', 'jpg', 'png');
    if(in_array($file_extension, $extension)){
        $upload_image = 'images/' . $imagefilename;
        move_uploaded_file($imagefiletemp, $upload_image);

        $sql = "INSERT INTO `registration` (name, mobile, image) VALUES ('$username', '$mobile', '$upload_image')";
        $result = mysqli_query($con, $sql);

        if($result){
            echo "Data inserted successfully";
        }else{
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
<h1 class="text-center my-4">User data</h1>
<div class="container mt-5 d-flex justify-content-center">
<table class="table table-bordered w-50">
  <thead>
    <tr>
      <th scope="col">SI no</th>
      <th scope="col">Username</th>
      <th scope="col">Image</th>
   
    </tr>
  </thead>
  <tbody>

  <?php
  $sql="select * from `registration`";
  $result=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $name=$row['name'];
    $image=$row['image'];
echo'
<tr>
<td>'.$id.'</td>
<td>'.$name.'</td>
<td><img src="'.$image.'"/></td>
</tr>';
  }
    
  ?>
   
    
  </tbody>
</table>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>

