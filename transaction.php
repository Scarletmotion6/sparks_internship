<?php
            $servername="localhost";
            $username="root";
            $password="";
            $conn=mysqli_connect($servername,$username,$password,"money");
            $query1="select * from bank1";
            $row=mysqli_query($conn,$query1);
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <link rel="Stylesheet" type="text/css" href="sbank.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
</head> 

<body>
<header class="jumbotron shadow" id='bg'>
        <h1 id='title'>SPARKS BANK</h1>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active tabs" aria-current="page" href="./bank.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tabs" href="./transaction.php">Transactions</a>
                </li>
            </ul>
    </header>
    <div class="jumbotron">
        <h1 id="heading">Transaction List</h1>
    </div>

    <article class="container" id="fom">
    <table class="table table-bordered table-striped col-sm-5 col-md-3 col-lg-10" id="review">
            <thead>
            <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Sent</th>
                    <th>Recieved</th>
                    <th>Total Balance</th>
            </tr>
            </thead>

            <?php
            while($rs=mysqli_fetch_assoc($row)){
                $id=$rs['id'];
                $name=$rs['name'];
                $email=$rs['email'];
                $sent=$rs['sent'];
                $recieved=$rs['recieved'];
                $balance=$rs['balance'];
                echo "<tr>
                <td>{$id}</td>
                <td>{$name}</td>
                <td>{$email}</td>
                <td>{$sent}</td>
                <td>{$recieved}</td>
                <td>{$balance}</td>
                </tr>";
            }
            ?>
    </table>
    </article>
    <br><br><br><br><br><br><br><br><br><br><br>
    <footer id="copyright" style="text-align:center">
        <p>&copy; 2021 By Abinandhan B </p>
        <small>The Sparks Foundation</small>
    </footer>
</body>
</html>