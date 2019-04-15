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
    <title>Select Task on Film_Category</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Film_Category</h2>
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

    <h3>Search for Data from Film_Category Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="film_id" select>Film ID</option>
        <option value="category_id" select>Category ID</option>
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
        <input type="number" name="film_id" placeholder="Film ID">
        <br>
        <input type="number" name="category_id" placeholder="Category ID">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $fid = $_POST['film_id'];
            $cid = $_POST['category_id'];

            //insert query
            $insert = "insert into film_category (film_id,category_id,last_update) 
            values ($fid,'$cid',NOW())";
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
        <option value="film_id" select>Film ID</option>
        <option value="category_id" select>Category ID</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Film (ID):">
        <br>
        <input type="text" name="condition3" placeholder="And Category (ID):">
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
        
            $update = sprintf("update film_category set %s='%s', last_update = NOW() where film_id = '%s' AND category_id='%s'",$condition1,$condition4,$condition2,$condition3);
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
        <input type="text" name="condition1" placeholder="Film ID">
        <input type="text" name="condition2" placeholder="Category ID">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from film_category where film_id='%s' AND category_id='%s'",$condition1,$condition2);
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
        $search = sprintf("select film_id, category_id, last_update FROM film_category where %s='%s'",$cond1,$cond2);
        $query = $conn->query($search);
        if($query->num_rows > 0){
            Echo"The Table for Film_Category";
            echo "<table>
            <tr>
            <th>film_id</th>
            <th>category_id</th>
            <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                 <td>".$row["film_id"]."</td>
                 <td>".$row["category_id"]."</td>
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
        $select = "select film_id, category_id, last_update FROM film_category";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Film_Category";
            echo "<table>
                    <tr>
                    <th>film_id</th>
                    <th>category_id</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>

                    <td>".$row["film_id"]."</td>
                    <td>".$row["category_id"]."</td>
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