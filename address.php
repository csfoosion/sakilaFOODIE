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
    <title>Select Task on Address</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Address</h2>
    <form method="get">
    <div class="middle"> 
    <button type="summit" name="select" value="select" style="background-color:Orange;font-size:20px">Display</button>
    <button type="summit" name="update" value="update" style="background-color:Orange;font-size:20px">Update</button>
    <button type="summit" name="insert" value="insert" style="background-color:Orange;font-size:20px">Insert</button>
    <button type="summit" name="delete" value="delete" style="background-color:Orange;font-size:20px">Delete</button>
    </form>
    </div>
    <br>
    <button onclick="location.href='index.php'" type="button">Homepage</button></a><br><br>

    <h3>Search for Data from Address Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="address_id" select>Address ID</option>
        <option value="address" select>Address</option>
        <option value="address2" select>Address2</option>
        <option value="distract" select>Distract</option>
        <option value="city_id" select>City ID</option>
        <option value="postal_code" select>Postal Code</option>
        <option value="phone" select>Phone</option>
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
        <input type="number" name="id" placeholder="Address ID">
        <br>
        <input type="text" name="add" placeholder="Address1">
        <br>
        <input type="text" name="add2" placeholder="Address2">
        <br>
        <input type="text" name="dis" placeholder="District">
        <br>
        <input type="number" name="city_id" placeholder="City ID">
        <br>
        <input type="text" name="code" placeholder="Postal Code">
        <br>
        <input type="text" name="no" placeholder="Phone">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $id = $_POST['id'];
            $add = $_POST['add'];
            $add2 = $_POST['add2'];
            $dis = $_POST['dis'];
            $city = $_POST['city_id'];
            $code = $_POST['code'];
            $no = $_POST['no'];

            //insert query
            $insert = "insert into address (address_id,address,address2,district,city_id,postal_code,phone,last_update) 
            values ($id,'$add','$add2','$dis','$city','$code','$no',NOW())";
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
        <option value="id" select>Address ID</option>
        <option value="add" select>Address 1</option>
        <option value="add2" select>Address 2</option>
        <option value="dis" select>District</option>
        <option value="city_id" select>City ID</option>
        <option value="code" select>Postal Code</option>
        <option value="no" select>Phone</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Actor (ID):">
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
            //$addid = $_POST['address_id'];
        
            $update = sprintf("update address set %s='%s',last_update=NOW() where address_id = %s",$condition1,$condition3,$condition2);
            if($query = mysqli_query($conn, $update))
                echo("Data Updated");
            else
                echo("Data not Updated
                <p>Please key in the correct column name.</p>
                 <p>EXAMPLE: Correct(city_id) & Wrong(city id)</p>
                ");
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
        <option value="id" select>Address ID</option>
        <option value="add" select>Address 1</option>
        <option value="add2" select>Address 2</option>
        <option value="dis" select>District</option>
        <option value="city_id" select>City ID</option>
        <option value="code" select>Postal Code</option>
        <option value="no" select>Phone</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="Input">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            //$id = $_POST['store_id'];
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from address where %s='%s'",$condition1,$condition2);
            if($query = mysqli_query($conn, $delete))
                echo("Data deleted");
            else echo("Delete fail
            <p>Please key in the correct column name.</p>
            <p>EXAMPLE: Correct(city_id) & Wrong(city id)</p>");
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
        
        $search = sprintf("select address_id, address, address2, district, city_id, postal_code, phone, last_update FROM address where %s='%s'",$cond1,$cond2);
        $query = $conn->query($search);
            //echo"test";
            
        if($query->num_rows > 0){
            Echo"Search Table";
            echo "<table>
            <tr>
            <th>address_id</th>
            <th>address</th>
            <th>address2</th>
            <th>district</th>
            <th>city_id</th>
            <th>postal_code</th>
            <th>phone</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                 <td>".$row["address_id"]."</td>
                 <td>".$row["address"]."</td>
                 <td>".$row["address2"]."</td>
                 <td>".$row["district"]."</td>
                 <td>".$row["city_id"]."</td>
                 <td>".$row["postal_code"]."</td>
                 <td>".$row["phone"]."</td>
                 <td>".$row["last_update"]."</td>
                </tr>";
                }//end while
            echo "</table>";
            }//end if
        else{
                echo"<p>0 results</p>
                    <p>Please key in the correct column name.</p>
                    <p>EXAMPLE: Correct(city_id) & Wrong(city id)</p>";
        }
            ?>
        <?php } ?>
    <!-- Display -->
    <?php
        if(isset($_GET['select'])){
    ?>
    
    <?php
        $select = "select address_id, address, address2, district,city_id,postal_code,phone,last_update FROM address";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Address";
            echo "<table>
                    <tr>
                    <th>address_id</th>
                    <th>address</th>
                    <th>address2</th>
                    <th>district</th>
                    <th>city_id</th>
                    <th>postal_code</th>
                    <th>phone</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["address_id"]."</td>
                    <td>".$row["address"]."</td>
                    <td>".$row["address2"]."</td>
                    <td>".$row["district"]."</td>
                    <td>".$row["city_id"]."</td>
                    <td>".$row["postal_code"]."</td>
                    <td>".$row["phone"]."</td>
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