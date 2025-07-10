<?php

require_once('connextion.php');


if (isset($_GET['OrderID'])) {
    $OrderID = $_GET['OrderID'];
    $delete = mysqli_query($con, "DELETE FROM Confirm WHERE OrderID = '$OrderID' ");
}

    // if ($stmt = mysqli_prepare($con, $deleteQuery)) {
    //     mysqli_stmt_bind_param($stmt, "s", $serviceName);
    //     if (mysqli_stmt_execute($stmt)) {
    //         echo "<script>alert('Service has been canceled successfully.');</script>";
    //     }
    // }


$query = "SELECT OrderID, ServiceType, Date, amount, Status FROM Confirm";
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
                    <h2 class="display-6 text-center">Past and Future Services</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr class="bg-dark text-white">
                            
                            <td>OrderID</td>
                            <td>ServiceType</td>
                            <td>Date</td>
                            <td>Amount</td>
                            <td>Status</td>
                            <td>Delete</td>
                        
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['ServiceType']; ?></td>
                            <td><?php echo $row['Date']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td> <?php
    if ($row['Status'] == 0) {
        echo "Pending";
    } elseif ($row['Status'] == 1) {
        echo "Approved";
    } elseif ($row['Status'] == 2) {
        echo "Refused";
    } else {
        echo "Unknown Status";
    }
    ?>
</td>
                            <!-- <td> <a href = "#" class = "btn btn-primary"> Edit</a></td> -->
                            <td> <a href="OverviewServices.php?OrderID=<?php echo ($row['OrderID']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this service?');">Cancel</a> </td>
                             
                            
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
