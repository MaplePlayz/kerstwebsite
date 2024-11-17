<?php
include 'dbconn.php';  
if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo '<script>
        if(confirm("weet je zeker dat je dit wil verwijderen?")){
            window.location.href="cruddelete.php?id='.$id.'&confirm=true";
        } else {
            window.location.href="index.php";
        }
    </script>';
    if(isset($_GET['confirm']) && $_GET['confirm'] == "true"){
        $sql = "DELETE FROM student WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: index.php");
    } 
} else {
    echo "kan niet verwijderen";
    echo "<a href='crudchallenge'>terug</a>";
}
?>


