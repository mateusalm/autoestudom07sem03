<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Sample page</h1>
<?php

  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  VerifyProductTable($connection, DB_DATABASE);

  $product_name = htmlentities($_POST['NAME']);
  $product_price = htmlentities($_POST['PRICE']);
  $product_quantity = htmlentities($_POST['QUANTITY']);

  if (strlen($product_name)) {
    AddProduct($connection, $product_name, $product_price, $product_quantity);
  }
?>

<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>PRICE</td>
      <td>QUANTITY</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="number" name="PRICE" maxlength="45" size="30" />
      </td>
      <td>
        <input type="number" name="QUANTITY" maxlength="45" size="30" />
      </td>
      <td>
        <input type="submit" value="Add Product" />
      </td>
    </tr>
  </table>
</form>

<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>NAME</td>
    <td>PRICE</td>
    <td>QUANTITY</td>
    <td>ADDED AT</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM PRODUCTS");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>";
  echo "</tr>";
}
?>

</table>

<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>


<?php

function AddProduct($connection, $name, $price, $quantity) {
   $n = mysqli_real_escape_string($connection, $name);
   $p = mysqli_real_escape_string($connection, $price);
   $q = mysqli_real_escape_string($connection, $quantity);

   $query = "INSERT INTO PRODUCTS (name, price, quantity) VALUES ('$n', '$p', '$q');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

function VerifyProductTable($connection, $dbName) {
  if(!TableExists("PRODUCTS", $connection, $dbName))
  {
     $query = "CREATE TABLE PRODUCTS (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255),
      price DECIMAL(10, 2),
      quantity INT,
      added_at DATETIME DEFAULT CURRENT_TIMESTAMP
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>                        
                
