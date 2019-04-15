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
    <title>Select Task on Rental</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Rental</h2>
    <form method="get" action=""> 
    <div class="middle">
    <button type="summit" name="select" value="select"  style="background-color:Orange;font-size:20px">Display</button>
    <button type="summit" name="update" value="update"  style="background-color:Orange;font-size:20px">Update</button>
    <button type="summit" name="insert" value="insert"  style="background-color:Orange;font-size:20px">Insert</button>
    <button type="summit" name="delete" value="delete"  style="background-color:Orange;font-size:20px">Delete</button>
    </form>
    </div>
    <br>
    <button onclick="location.href='index.php'" type="button">Homepage</button></a><br><br>

    <h3>Search for Data from Rental Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="rental_id" select>Rental ID</option>
        <option value="rental_date" select>Rental Date</option>
        <option value="inventory_date" select>Inventory Date</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="return_date" select>Return Date</option>
        <option value="staff_id" select>Staff ID</option>
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
        <input type="number" name="rental_id" placeholder="Rental ID">
        <br>
        <!-- <input type="date" name="rental_date" placeholder="Rental Date">
        <br> -->
        <input type="number" name="inventory_id" placeholder="Inventory ID">
        <br>
        <input type="number" name="customer_id" placeholder="Customer ID">
        <br>
        <!-- <input type="date" name="return_date" placeholder="Return Date">
        <br> -->
        <input type="number" name="staff_id" placeholder="Staff ID">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $rid = $_POST['rental_id'];
            // $rtdate = $_POST['rental_date'];
            $iid = $_POST['inventory_id'];
            $cid = $_POST['customer_id'];
            // $rtndate = $_POST['return_date'];
            $sid = $_POST['staff_id'];

            //insert query
            $insert = "insert into rental (rental_id,rental_date,inventory_id,customer_id,return_date,staff_id,last_update) 
            values ($rid,NOW(),'$iid','$cid',NOW()+ INTERVAL 7 DAY,'$sid',NOW())";
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
        <option value="rental_id" select>Rental ID</option>
        <option value="inventory_id" select>Inventory ID</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="staff_id" select>Staff ID</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Rental (ID):">
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
        
            $update = sprintf("update rental set %s='%s' where rental_id = %s",$condition1,$condition3,$condition2);
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
        <option value="" disabled selected>Delete Column</option>
        <option value="rental_id" select>Rental ID</option>
        <option value="inventory_id" select>Inventory ID</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="staff_id" select>Staff ID</option>
        </select>
        <input type="text" name="condition2" placeholder="Input">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from rental where %s='%s'",$condition1,$condition2);
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
        $search = sprintf("select rental_id, rental_date, inventory_id, customer_id, return_date, staff_id, last_update FROM rental where %s='%s'",$cond1,$cond2);
        $query = $conn->query($search);
            echo"test";
        if($query->num_rows > 0){
            Echo"The Table for Rental";
            echo "<table>
            <tr>
            <th>rental_id</th>
            <th>rental_date</th>
            <th>inventory_id</th>
            <th>customer_id</th>
            <th>return_date</th>
            <th>staff_id</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                 <td>".$row["rental_id"]."</td>
                 <td>".$row["rental_date"]."</td>
                 <td>".$row["inventory_id"]."</td>
                 <td>".$row["customer_id"]."</td>
                 <td>".$row["return_date"]."</td>
                 <td>".$row["staff_id"]."</td>
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
        $select = "select rental_id, rental_date, inventory_id, customer_id, return_date, staff_id, last_update FROM rental";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Rental";
            echo "<table>
                    <tr>
                    <th>rental_id</th>
                    <th>rental_date</th>
                    <th>inventory_id</th>
                    <th>customer_id</th>
                    <th>return_date</th>
                    <th>staff_id</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["rental_id"]."</td>
                    <td>".$row["rental_date"]."</td>
                    <td>".$row["inventory_id"]."</td>
                    <td>".$row["customer_id"]."</td>
                    <td>".$row["return_date"]."</td>
                    <td>".$row["staff_id"]."</td>
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