<?php

require_once('connextion.php');


// if (isset($_GET['orderID'])) {
//     $orderID = $_GET['orderID'];
//     $delete = mysqli_query($con, "DELETE FROM Confirm WHERE orderID = '$orderID' ");
// }

    // if ($stmt = mysqli_prepare($con, $deleteQuery)) {
    //     mysqli_stmt_bind_param($stmt, "s", $serviceName);
    //     if (mysqli_stmt_execute($stmt)) {
    //         echo "<script>alert('Service has been canceled successfully.');</script>";
    //     }
    // }


$query = "SELECT ID, name, email  FROM users";
$result = mysqli_query($con, $query);


// $deleteQuery = "DELETE FROM Try WHERE Name = ?";
// $resultDelete = mysqli_query($con, $deletequery);




?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="css/customer.css"> 
</head>
<body>
    
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="display-6 text-center">Customers</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr class="bg-dark text-white">
                            
                        <thead>
                          <tr>
                             <th>ID</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Delete User</th>
                          </tr>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                        
                            <!-- <td> <a href = "#" class = "btn btn-primary"> Edit</a></td> -->
                            <td> <a href="customer.php?ID=<?php echo ($row['ID']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this service?');">Delete</a> </td>
                             
                            
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>