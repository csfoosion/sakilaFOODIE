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
    <title>Select Task on Film</title>
</head>

<body>
<h1 align="center">Sakila</h1>
    <h2 align="center">Select Task on Film</h2>
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

    <h3>Search for Data from Film Here:<h3>
        <form method = "POST">
        <select name="cond1">
        <option value="" disabled selected>Search Column</option>
        <option value="film_id" select>Film ID</option>
        <option value="title" select>Title</option>
        <option value="description" select>Description</option>
        <option value="release_year" select>Release Year</option>
        <option value="language_id" select>Language ID</option>
        <option value="original_language_id" select>Original Language ID</option>
        <option value="rental_duration" select>Rental Duration</option>
        <option value="rental_rate" select>Rental rate</option>
        <option value="length" select>Length</option>
        <option value="replacement_cost" select>Replacement Cost</option>
        <option value="rating" select>Rating</option>
        <option value="special_features" select>Special Features</option>
        </select>
        </select>
        <input type="text" name="cond2" placeholder="Data">
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
        <input type="text" name="title" placeholder="Title">
        <br>
        <input type="text" name="description" placeholder="Description">
        <br>
        <input type="text" name="release_year" placeholder="Release Year">
        <br>
        <input type="text" name="language_id" placeholder="Language ID">
        <br>
        <input type="number" name="original_language_id" placeholder="Original Language ID">
        <br>
        <input type="number" name="rental_duration" placeholder="Rental Duration">
        <br>
        <input type="text" name="rental_rate" placeholder="Rental Rate">
        <br>
        <input type="number" name="length" placeholder="Length">
        <br>
        <input type="text" name="replacement_cost" placeholder="Replacement Cost">
        <br>
        <input type="text" name="rating" placeholder="Rating">
        <br>
        <input type="text" name="special_features" placeholder="Special Features">
        <br>
        <button type="summit" name="insert">Insert</button>
    </form>

    <?php 
        if(isset($_POST['insert'])){
            $fid = $_POST['film_id'];
            $title = $_POST['title'];
            $descp = $_POST['description'];
            $ryear = $_POST['release_year'];
            $lid = $_POST['language_id'];
            $olid = $_POST['original_language_id'];
            $red = $_POST['rental_duration'];
            $rer = $_POST['rental_rate'];
            $len = $_POST['length'];
            $rec = $_POST['replacement_cost'];
            $rat = $_POST['rating'];
            $sfe = $_POST['special_features'];

            //insert query
            $insert = "insert into film (film_id,title,description,release_year,language_id,original_language_id,rental_duration,rental_rate,length,replacement_cost,rating,special_features,last_update) 
            values ('$fid','$title','$descp','$ryear','$lid','$olid','$red','$rer','$len','$rec','$rat','$sfe',NOW())";
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
        <option value="title" select>Title</option>
        <option value="description" select>Description</option>
        <option value="release_year" select>Release Year</option>
        <option value="language_id" select>Language ID</option>
        <option value="original_language_id" select>Original Language ID</option>
        <option value="rental_duration" select>Rental Duration</option>
        <option value="rental_rate" select>Rental rate</option>
        <option value="length" select>Length</option>
        <option value="replacement_cost" select>Replacement Cost</option>
        <option value="rating" select>Rating</option>
        <option value="special_features" select>Special Features</option>
        </select>
        <br>
        <input type="text" name="condition2" placeholder="At Film (ID):">
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
        
            $update = sprintf("update film set %s='%s', last_update = NOW() where film_id = %s",$condition1,$condition3,$condition2);
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
        <option value="film_id" select>Film ID</option>
        <option value="title" select>Title</option>
        <option value="description" select>Description</option>
        <option value="release_year" select>Release Year</option>
        <option value="language_id" select>Language ID</option>
        <option value="original_language_id" select>Original Language ID</option>
        <option value="rental_duration" select>Rental Duration</option>
        <option value="rental_rate" select>Rental rate</option>
        <option value="length" select>Length</option>
        <option value="replacement_cost" select>Replacement Cost</option>
        <option value="rating" select>Rating</option>
        <option value="special_features" select>Special Features</option>
        </select>
        <input type="text" name="condition2" placeholder="Input">
        <button type="summit" name="delete">Delete</button>
    </form>

    <?php
        if(isset($_POST['delete'])){
            $condition1 = $_POST['condition1'];
            $condition2 = $_POST['condition2'];

             //delete query
            $delete = sprintf("delete from film where %s='%s'",$condition1,$condition2);
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
        $search = sprintf("select film_id,title,description,release_year,language_id,original_language_id,rental_duration,rental_rate,length,replacement_cost,rating,special_features,last_update FROM film where %s='%s'",$cond1,$cond2);
        $query = $conn->query($search);
            echo"test";
        if($query->num_rows > 0){
            Echo"The Table for Film";
            echo "<table>
            <tr>
            <th>film_id</th>
            <th>title</th>
            <th>description</th>
            <th>release_year</th>
            <th>language_id</th>
            <th>rental_duration</th>
            <th>rental_rate</th>
            <th>length</th>
            <th>replacement_cost</th>
             <th>rating</th>
            <th>special_features</th>
             <th>last_update</th>
            </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                 echo"<tr>

                 <td>".$row["film_id"]."</td>
                 <td>".$row["title"]."</td>
                 <td>".$row["description"]."</td>
                 <td>".$row["release_year"]."</td>
                 <td>".$row["language_id"]."</td>
                 <td>".$row["rental_duration"]."</td>
                 <td>".$row["rental_rate"]."</td>
                 <td>".$row["length"]."</td>
                 <td>".$row["replacement_cost"]."</td>
                 <td>".$row["rating"]."</td>
                 <td>".$row["special_features"]."</td>
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
        $select = "select film_id,title,description,release_year,language_id,original_language_id,rental_duration,rental_rate,length,replacement_cost,rating,special_features,last_update FROM film";
        $query = $conn->query($select);

        if($query->num_rows > 0){
            Echo"The Table for Actor";
            echo "<table>
                    <tr>
                    <th>film_id</th>
                    <th>title</th>
                    <th>description</th>
                    <th>release_year</th>
                    <th>language_id</th>
                    <th>original_language_id</th>
                    <th>rental_duration</th>
                    <th>rental_rate</th>
                    <th>length</th>
                    <th>replacement_cost</th>
                    <th>rating</th>
                    <th>special_features</th>
                    <th>last_update</th>
                    </tr>";
            //output data for each row
            while($row = $query->fetch_assoc()) {
                echo"<tr>
                    <td>".$row["film_id"]."</td>
                    <td>".$row["title"]."</td>
                    <td>".$row["description"]."</td>
                    <td>".$row["release_year"]."</td>
                    <td>".$row["language_id"]."</td>
                    <td>".$row["original_language_id"]."</td>
                    <td>".$row["rental_duration"]."</td>
                    <td>".$row["rental_rate"]."</td>
                    <td>".$row["length"]."</td>
                    <td>".$row["replacement_cost"]."</td>
                    <td>".$row["rating"]."</td>
                    <td>".$row["special_features"]."</td>
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