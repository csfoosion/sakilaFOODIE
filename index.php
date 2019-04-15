<html>
<style>
	body{
	font-family:Verdana,sans-serif;
	background-color:lightGray;	
	}
	h1{
	background-color:black;
	color:white;
	padding:25px;
	font-size:40px;
	}
    .myButton {
	-moz-box-shadow: 3px 4px 0px 0px #899599;
	-webkit-box-shadow: 3px 4px 0px 0px #899599;
	box-shadow: 3px 4px 0px 0px #899599;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #bab1ba));
	background:-moz-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:-webkit-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:-o-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:-ms-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#bab1ba',GradientType=0);
	background-color:#ededed;
	-moz-border-radius:15px;
	-webkit-border-radius:15px;
	border-radius:15px;
	border:1px solid #d6bcd6;
	display:inline-block;
	cursor:pointer;
	color:#3a8a9e;
	font-family:Arial;
	font-size:17px;
	padding:7px 25px;
	text-decoration:none;
	text-shadow:0px 1px 0px #e1e2ed;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bab1ba), color-stop(1, #ededed));
	background:-moz-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:-webkit-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:-o-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:-ms-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bab1ba', endColorstr='#ededed',GradientType=0);
	background-color:#bab1ba;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>
<head>
    <title>Sakila Dapabase Interface</title>
</head>

<body>
    <h1 align="center" >SAKILA</h1>
    <h2 align="center"> Select Table</h2>
	<div align="center">
    <a href="actor.php" class = "myButton">Actor</a><br><br>
    <a href="store.php" class = "myButton">Store</a><br><br>
    <a href="address.php" class = "myButton">Address</a><br><br>
    <a href="category.php" class = "myButton">Category</a><br><br>
    <a href="city.php" class = "myButton">City</a><br><br>
    <a href="country.php" class = "myButton">Country</a><br><br>
    <a href="customer.php" class = "myButton">Customer</a><br><br>
    <a href="film.php" class = "myButton">Film</a><br><br>
    <a href="film_actor.php" class = "myButton">Film Actor</a><br><br>
    <a href="film_category.php" class = "myButton">Film Category</a><br><br>
    <a href="inventory.php" class = "myButton">Inventory</a><br><br>
    <a href="language.php" class = "myButton">Language</a><br><br>
    <a href="payment.php" class = "myButton">Payment</a><br><br>
    <a href="rental.php" class = "myButton">Rental</a><br><br>
    <a href="staff.php" class = "myButton">Staff</a><br><br>
	</div>
</body>
</html>

