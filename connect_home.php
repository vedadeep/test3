<?php  
$Surname = $_POST['Surname'];
$Name = $_POST['Name'];

$conn = new mysqli('localhost', 'root', 'root', 'erd');
if($conn ->connect_error){
    die('Connection Failed : '.$conn->connect_error );
}
else {
    
        $Surname = $_POST['Surname'];  
        $Name = $_POST['Name'];  
          
            
            $Surname = stripcslashes($Surname);  
            $Name = stripcslashes($Name);  
            $Surname = mysqli_real_escape_string($conn, $Surname);  
            $Name = mysqli_real_escape_string($conn, $Name);  
    
            $sql = "select *from mix where Surname = '$Surname' and Name = '$Name'";
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count == 1){  

                $stmt = $conn->prepare("insert into test(Surname, Name) 
                    values(?,?)");
                $stmt->bind_param("ss",$Surname, $Name );
                $stmt->execute();
                echo "New record inserted successfully";
                $stmt->close();
                $conn->close();

            echo "<h1><center> Login successful </center></h1>";  
            header("Location: about_parking.php ");
            }  
            else{  
                echo "<h1> Login failed. Invalid Surname or Name. </h1>";  
                echo '<h1> Please click on "create new account"</h1>';
                }  

    }
?>  
