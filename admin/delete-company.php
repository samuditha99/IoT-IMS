<?php
session_start();
if(!isset($_SESSION["admin"])){
    ?>
    <script type="text/javascript">
            window.location = "../index.php";
        </script>
    <?php
}
?>
<?php
include "../user/connection.php";
$id=$_GET['id'];
$sql = "DELETE FROM companies WHERE id='$id'";
mysqli_query($conn, $sql);
?>

<script type="text/javascript">
    window.location = "add-new-company.php";
</script>