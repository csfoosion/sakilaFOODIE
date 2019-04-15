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
    <title>Select Task on Store</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Store</h2>
    <form method="get" > 
    <div class="middle">
    <button type="summit" name="select" value="select" style="background-color:Orange;font-size:20px">Display</button>
    <button type="summit" name="update" value="update" style="background-color:Orange;font-size:20px">Update</button>
    <button type="summit" name="insert" value="insert" style="background-color:Orange;font-size:20px">Insert</button>
    <button type="summit" name="delete" value="delete" style="background-color:Orange;font-size:20px">Delete</button>
    </form>
    </div>
    <br>
    <button onclick="location.href='index.php'" type="button">Homepage</button></a><br><br>

    <h3>Search for Data from Store Here:<h3>
        <form method = "GET">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="store_id" select>Store ID</option>
        <option value="manager_staff_id" select>Manager Staff ID</option>
        <option value="address_id" select>Address ID</option>
        </select>
        <input type="text" name="condition2" placeholder="Column Input">
        <button type="summit" name="search">Search</button>
        </form>
        
    <!-- INSERT DONE-->
    <?php 
        if(isset($_GET['insert'])){
    ?>
    <h3>Insert Data Here:</h3>
    <form method="POST">
        <input type="text" name="store_id" placeholder="Store ID">
        <br>
        <input type="text" name="manager_staff_id" placeholder="Manager Staff ID">
        <br>
        <input type="text" name="address_id" placeholder="Address ID">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $id = $_POST['store_id'];
            $msid = $_POST['manager_staff_id'];
            $addid = $_POST['address_id'];
        
            //insert query
            $insert = "insert into store(store_id,manager_staff_id,address_id,last_update) 
            values ('$id', '$msid', '$addid',NOW())";
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
    <h3>Update Data Here:</h3>
    <form method="POST">
    <select name="condition1">
        <option value="" disabled selected>Update Column</option>
        <option value="store_id" select>Store ID</option>
        <option value="manager_staff_id" select>Manager Staff ID</option>
        <option value="address_id" select>Address ID</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Store (ID):">
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
        
            $update = sprintf("update store set %s=%s,last_update=NOW() where store_id = %s",$condition1,$condition3,$condition2);
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
        <option value="store_id" select>Store ID</option>
        <option value="manager_staff_id" select>Manager Staff ID</option>
        <option value="address_id" select>Address ID</option>
        </select>

        <input type="text" name="condition2" placeholder="Input">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from store where %s=%s",$condition1,$condition2);
            if($query = mysqli_query($conn, $delete))
                echo("Data deleted");
            else echo("Delete fail");
        }
    ?>
    <?php } ?>
    <!-- To Search Table -->
    <?php
        if(isset($_GET['search'])){
    ?>
    <?php
        $condition1 = $_GET['condition1'];
        $condition2 = $_GET['condition2'];
        $search = sprintf("select store_id, manager_staff_id, address_id, last_update FROM store where %s='%s' ",$condition1,$condition2);
        $query = $conn->query($search);

        if($query->num_rows > 0){
            Echo"Search Table";
            echo "<table>
            <tr>
            <th>store_id</th>
            <th>manager_store_id</th>
            <th>address_id</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                <td>".$row["store_id"]."</td>
                <td>".$row["manager_staff_id"]."</td>
                <td>".$row["address_id"]."</td>
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
        $select = "select store_id, manager_staff_id, address_id, last_update FROM store";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for STORE";
            echo "<table>
                    <tr>
                    <th>store_id</th>
                    <th>manager_staff_id</th>
                    <th>address_id</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["store_id"]."</td>
                    <td>".$row["manager_staff_id"]."</td>
                    <td>".$row["address_id"]."</td>
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