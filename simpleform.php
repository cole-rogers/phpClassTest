<?php
include("connect-db.php");      

include("friend-db.php");

$list_of_friends = getAllFriends();
$friend_to_update = null;
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Add') 
  {
      addFriend($_POST['name'], $_POST['major'], $_POST['year']);
      $list_of_friends = getAllFriends();  
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Update')
  {
      $friend_to_update = getFriendByName($_POST['friend_to_update']);
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Delete')
  {
      $friend_to_delete = deleteFriend($_POST['friend_to_Delete']);
  }
}
?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">

  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.

  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded
  -->

  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">

  <title>Friend Book</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->
  <link href="Bootstrap%20example_files/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- you may also use W3's formats -->
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 

  <!--
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource.
  -->

  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png">
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> -->

  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->

</head>
<?php include ('header.html') ?>
<body>

<div class="container">
  <h1>Friend Book!</h1>



  <form name="mainForm" action="simpleform.php" method="post">   
  <div class="row mb-3 mx-3">
    Your name:
    <input type="text" class="form-control" name="name" required
    value="<?php if ($friend_to_update!=null) echo $friend_to_update['name'] ?>" />            
  </div>  
  <div class="row mb-3 mx-3">
    Major:
    <input type="text" class="form-control" name="major" required
    value="<?php if ($friend_to_update!=null) echo $friend_to_update['major'] ?>" />            
  </div> 
  <div class="row mb-3 mx-3">
    Year:
    <input type="number" max="4" min="1" class="form-control" name="year" required
    value="<?php if ($friend_to_update!=null) echo $friend_to_update['year'] ?>" />            
  </div>   
  <div>    
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Insert Friend" />
   <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary" 
           title="Update Friend" />             
  </div>  

</form>   
<h3> List of friends </h3>
<div class="row justify-content-center">
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thread>
    <tr style="background-collor:#B0B0B0">
      <th width="30%">name
      <th width="30%">major
      <th width="30%">Year
      <th> Update </th>
      <th> Delete </th>
  </tr>
</thread>
<?php foreach ($list_of_friends as $friend_info): ?>
  <tr>
     <td><?php echo $friend_info['name']; ?></td>
     <td><?php echo $friend_info['major']; ?></td>        
     <td><?php echo $friend_info['year']; ?></td>                
     <td>
        <form action="simpleform.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="btn btn-primary" 
                title="Update friend" />
          <input type="hidden" name="friend_to_update" 
                value="<?php echo $friend_info['name']; ?>"
          />                
        </form>
     </td>
     <td>
        <form action="simpleform.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="btn btn-dark" 
                title="Delete this friend from the database" />
          <input type="hidden" name="friend_to_delete" 
                value="<?php echo $friend_info['name']; ?>"
          />                
        </form></td>
  </tr>

<?php endforeach; ?>
</table>
    <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->
</div>

</div>
<?php include ('footer.html') ?>
<div style="position: static !important;"></div>
</body>
</html>
