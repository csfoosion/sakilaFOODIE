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
    <title>Select Task on Film_Actor</title>
</head>

<body>
    <h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Film_Actor</h2>
    <div class="middle">
    <button type="summit" name="select" value="select" style="background-color:Orange;font-size:20px">Display</button>
    <button type="summit" name="update" value="update" style="background-color:Orange;font-size:20px">Update</button>
    <button type="summit" name="insert" value="insert" style="background-color:Orange;font-size:20px">Insert</button>
    <button type="summit" name="delete" value="delete" style="background-color:Orange;font-size:20px">Delete</button>
    </form>
    </div>
    <br>
    <button onclick="location.href='index.php'" type="button">Homepage</button></a><br><br>

    <h3>Search for Data from Film Actor Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="actor_id" select>Actor ID</option>
        <option value="film_id" select>Film ID</option>
        </select>
        <input type="text" name="cond2" placeholder="Search">
        <button type="summit" name="search">Search</button>
        </form>
    <!-- INSERT DONE-->
    <?php 
        if(isset($_GET['insert'])){
    ?>
    <h3>Insert Data Here:</h3>
    <form method="POST">
        <input type="number" name="actor_id" placeholder="Actor ID">
        <br>
        <input type="number" name="film_id" placeholder="Film ID">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $aid = $_POST['actor_id'];
            $fid = $_POST['film_id'];

            //insert query
            $insert = "insert into film_actor (actor_id,film_id,last_update) 
            values ('$aid','$fid',NOW())";
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
        <input type="text" name="condition1" placeholder="Update (Column Name):">
        <br>
        <input type="text" name="condition2" placeholder="At Actor (ID):">
        <br>
        <input type="text" name="condition3" placeholder="And Film (ID):">
        <br>
        <input type="text" name="condition4" placeholder="To (?)">
        <br>
        <button type="summit" name="update">Update</button>
    </form>

    <?php
        if(isset($_POST['update'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];
            $condition3 = $_POST['condition3'];
            $condition4 = $_POST['condition4'];
        
            $update = sprintf("update film_actor set %s='%s', last_update = NOW() where actor_id = %s AND film_id=%s",$condition1,$condition4,$condition2,$condition3);
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
        <input type="text" name="condition2" placeholder="Actor ID">
        <input type="text" name="condition3" placeholder="Film ID">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition2 = $_POST['condition2'];
            $condition3 = $_POST['condition3'];

             //delete query
            $delete = sprintf("delete from film_actor where actor_id='%s' AND film_id='%s'",$condition2,$condition3);
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
        $search = sprintf("select actor_id, film_id, last_update FROM film_actor where %s= ' %s'",$cond1,$cond2);
        $query = $conn->query($search);
        if($query->num_rows > 0){
            Echo"Search Table";
            echo "<table>
            <tr>
            <th>actor_id</th>
            <th>film_id</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                <td>".$row["actor_id"]."</td>
                <td>".$row["film_id"]."</td>
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
        $select = "select actor_id, film_id, last_update FROM film_actor";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Film_Actor";
            echo "<table>
                    <tr>
                    <th>actor_id</th>
                    <th>film_id</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["actor_id"]."</td>
                    <td>".$row["film_id"]."</td>
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