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
    <title>Select Task on Customer</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Customer</h2>
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

    <h3>Search for Data from Customer Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="store_id" select>Store ID</option>
        <option value="first_name" select>First Name</option>
        <option value="last_name" select>Last Name</option>
        <option value="email" select>Email</option>
        <option value="address_id" select>Address ID</option>
        <option value="active" select>Active</option>
        <option value="create_date" select>Create Date</option>
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
        <input type="number" name="customer_id" placeholder="Customer ID">
        <br>
        <input type="number" name="store_id" placeholder="Store ID">
        <br>
        <input type="text" name="first_name" placeholder="First Name">
        <br>
        <input type="text" name="last_name" placeholder="Last Name">
        <br>
        <input type="text" name="email" placeholder="Email">
        <br>
        <input type="number" name="address_id" placeholder="Address ID">
        <br>
        <input type="text" name="active" placeholder="Active">
        <br>
        <!-- <input type="date" name="create_date" placeholder="Create Date">
        <br> -->
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $id = $_POST['customer_id'];
            $sid = $_POST['store_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $aid = $_POST['address_id'];
            $act = $_POST['active'];

            //insert query
            $insert = "insert into customer (customer_id,store_id,first_name,last_name,email,address_id,active,create_date,last_update) 
            values ($id,'$sid','$fname','$lname','$email','$aid','$act',NOW(),NOW())";
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
        <!-- <input type="text" name="condition1" placeholder="Update (Column Name):"> -->
        <select name="condition1">
        <option value="" disabled selected>Update Column</option>
        <option value="customer_id" select>Customer ID</option>
        <option value="store_id" select>Store ID</option>
        <option value="first_name" select>First Name</option>
        <option value="last_name" select>Last Name</option>
        <option value="email" select>Email</option>
        <option value="address_id" select>Address ID</option>
        <option value="active" select>Active</option>
        <option value="create_date" select>Create Date</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Customer (ID):">
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
        
            $update = sprintf("update customer set %s='%s', last_update = NOW() where customer_id = %s",$condition1,$condition3,$condition2);
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
        <option value="customer_id" select>Customer ID</option>
        <option value="store_id" select>Store ID</option>
        <option value="first_name" select>First Name</option>
        <option value="last_name" select>Last Name</option>
        <option value="email" select>Email</option>
        <option value="address_id" select>Address ID</option>
        <option value="active" select>Active</option>
        <option value="create_date" select>Create Date</option>
        </select>
        <input type="text" name="condition2" placeholder="Input">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from customer where %s='%s'",$condition1,$condition2);
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
        $search = sprintf("select customer_id, store_id, first_name, last_name, email,address_id, active, create_date, last_update FROM customer where %s='%s'",$cond1,$cond2);
        $query = $conn->query($search);
        if($query->num_rows > 0){
            Echo"Search Table";
            echo "<table>
            <tr>
            <th>customer_id</th>
            <th>store_id</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>address_id</th>
            <th>active</th>
            <th>create_date</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                <td>".$row["customer_id"]."</td>
                <td>".$row["store_id"]."</td>
                <td>".$row["first_name"]."</td>
                <td>".$row["last_name"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["address_id"]."</td>
                <td>".$row["active"]."</td>
                <td>".$row["create_date"]."</td>
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
        $select = "select customer_id,store_id,first_name,last_name,email,address_id,active,create_date,last_update FROM customer";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Customer";
            echo "<table>
                    <tr>
                    <th>customer_id</th>
                    <th>store_id</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>email</th>
                    <th>address_id</th>
                    <th>active</th>
                    <th>create_date</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["customer_id"]."</td>
                    <td>".$row["store_id"]."</td>
                    <td>".$row["first_name"]."</td>
                    <td>".$row["last_name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["address_id"]."</td>
                    <td>".$row["active"]."</td>
                    <td>".$row["create_date"]."</td>
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