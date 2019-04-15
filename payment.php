<?php
    include_once 'C:\xampp\htdocs\interface\connect.php';
    error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<style>
table, th, td {
    border: 1px solid black;
}
body{
    font-family:Verdana,sans-serif;
    background-color:lightGray;	
}
h1{
    background-color:black;
    color:white;
    padding:10px;
    font-size:50px;
}
.middle{
     text-align:center;
     cursor:pointer;
}
button{
    padding:5px;
    background-color:darkGray;
    border-radius:8px;
    font-family:"Verdana";
    cursor:pointer;
}
button:hover{
    background-color:black;
    color:white;
}
</style>
<head>
    <title>Select Task on Payment</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Payment</h2>
    <form method="get" action=""> 
    <div class="middle">
    <button type="summit" name="select" value="select" style="background-color:Orange;font-size:20px">Display</button>
    <button type="summit" name="update" value="update" style="background-color:Orange;font-size:20px">Update</button>
    <button type="summit" name="insert" value="insert" style="background-color:Orange;font-size:20px">Insert</button>
    <button type="summit" name="delete" value="delete" style="background-color:Orange;font-size:20px">Delete</button>
    </form>
    </div>
    <br>
    <button onclick="location.href='index.php'" type="button">Homepage</button></a><br><br>

    <h3>Search for Data from Payment Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="payment_id" select>Payment ID</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="staff_id" select>Staff ID</option>
        <option value="rental_id" select>Rental ID</option>
        <option value="amount" select>Amount</option>
        <option value="payment_date" select>Payment Date</option>
        </select>
        <input type="text" name="cond2" placeholder="Column Input">
        <button type="summit" name="search">Search</button>
        </form>
    <!-- INSERT DONE-->
    <?php 
        if(isset($_GET['insert'])){
    ?>
    <h3>Insert Data Here:</h3>
    <form method="POST">
        <input type="number" name="payment_id" placeholder="Payment ID">
        <br>
        <input type="number" name="customer_id" placeholder="Customer ID">
        <br>
        <input type="number" name="staff_id" placeholder="Staff ID">
        <br>
        <input type="number" name="rental_id" placeholder="Rental ID">
        <br>
        <input type="text" name="amount" placeholder="Amount">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $pid = $_POST['payment_id'];
            $cid = $_POST['customer_id'];
            $sid = $_POST['staff_id'];
            $rid = $_POST['rental_id'];
            $amt = $_POST['amount'];

            //insert query
            $insert = "insert into payment (payment_id,customer_id,staff_id,rental_id,amount,payment_date,last_update) 
            values ($pid,'$cid','$sid','$rid','$amt',NOW(),NOW())";
            if($query = mysqli_query($conn, $insert)){
                echo("Data inserted");
            }
            else echo("Insert fail");
        }
    ?>
    <?php } ?>

    <!-- UPDATE DONE-->
    <?php
        if(isset($_GET['update'])){
    ?>
    <h3>Update Here:</h3>
    <form method="POST">
        <select name="condition1">
        <option value="" disabled selected>Update Column</option>
        <option value="payment_id" select>Payment ID</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="staff_id" select>Staff ID</option>
        <option value="rental_id" select>Rental ID</option>
        <option value="amount" select>Amount</option>
        <option value="payment_date" select>Payment Date</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Payment (ID):">
        <br>
        <input type="text" name="condition3" placeholder="To (?)">
        <br>
        <button type="summit" name="update">Update</button>
    </form>

    <?php
        if(isset($_POST['update'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];
            $condition3 = $_POST['condition3'];
        
            $update = sprintf("update payment set %s='%s', last_update = NOW() where payment_id = '%s'",$condition1,$condition3,$condition2);
            if($query = mysqli_query($conn, $update))
                echo("Data Updated");
            else
                echo("Data not Updated");
        }
    ?>

    <?php } ?>


    <!-- DELETE DONE-->
    <?php
        if(isset($_GET['delete'])){
    ?>
    <h3>Delete Data Here:</h3>
    <form method="POST">
        <select name="condition1">
        <option value="" disabled selected>Update Column</option>
        <option value="payment_id" select>Payment ID</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="staff_id" select>Staff ID</option>
        <option value="rental_id" select>Rental ID</option>
        <option value="amount" select>Amount</option>
        <option value="payment_date" select>Payment Date</option>
        </select>
        <input type="text" name="condition2" placeholder="Input">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from payment where %s='%s'",$condition1,$condition2);
            if($query = mysqli_query($conn, $delete))
                echo("Data deleted");
            else echo("Delete fail");
        }
    ?>
    <?php } ?>
    <!-- To Search Table -->
    
    <?php
        if(isset($_POST['search'])){
    ?>

    <?php
        $cond1 = $_POST['cond1'];
        $cond2 = $_POST['cond2'];
        $search = sprintf("select payment_id, customer_id, staff_id, rental_id, amount, payment_date, last_update FROM payment where %s='%s'",$cond1,$cond2);
        $query = $conn->query($search);
        if($query->num_rows > 0){
            Echo"The Table for Payment";
            echo "<table>
            <tr>
            <th>payment_id</th>
            <th>customer_id</th>
            <th>staff_id</th>
            <th>rental_id</th>
            <th>amount</th>
            <th>payment_date</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                <td>".$row["payment_id"]."</td>
                <td>".$row["customer"]."</td>
                <td>".$row["staff_id"]."</td>
                <td>".$row["rental_id"]."</td>
                <td>".$row["amount"]."</td>
                <td>".$row["payment_date"]."</td>
                <td>".$row["last_update"]."</td>
                </tr>";
                }//end while
            echo "</table>";
            }//end if
        else{
                echo"0 results";
        }
            ?>
        <?php } ?>
    <!-- Display -->
    <?php
        if(isset($_GET['select'])){
    ?>
    
    <?php
        $select = "select payment_id, customer_id, staff_id, rental_id, amount, payment_date, last_update FROM payment";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Payment";
            echo "<table>
                    <tr>
                    <th>payment_id</th>
                    <th>customer_id</th>
                    <th>staff_id</th>
                    <th>rental_id</th>
                    <th>amount</th>
                    <th>payment_date</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["payment_id"]."</td>
                    <td>".$row["customer_id"]."</td>
                    <td>".$row["staff_id"]."</td>
                    <td>".$row["rental_id"]."</td>
                    <td>".$row["amount"]."</td>
                    <td>".$row["payment_date"]."</td>
                    <td>".$row["last_update"]."</td>
                    </tr>";
            }//end while
            echo "</table>";
        }//end if
        else{
            echo"0 results";
        }
    ?>
    <?php } ?>
    <?php mysqli_close($conn);?>
</body>
</html>