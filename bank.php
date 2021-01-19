<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, "money");
$query = "select * from bank";
$row = mysqli_query($conn, $query);
?>
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
    
    <div class="card text mb-3" style="max-width: 18rem;" id="imagecard">
        <div class="card-body">
            <h2 class="card-title"></h2>
            <h4 class="card-text">A safe way to save your money</h4>
        </div>
    </div>

    <article>
        <img src="./skyline-1925943_1920.jpg" class="img-fluid" id="welcomeimg"alt="...">

        <h1 id="firtext">Welcome to Sparks bank</h1>

        <div class="card" style="width: 18rem;" id="dashcard">
            <img src="./pexels-photo-4482900.jpeg" class="card-img-top" alt="Dashboard" id="dashimg">
            <div class="card-body">
                <h5 class="card-title">Dashboard</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#tabl" class="btn btn-primary">Customerlist</a>
            </div>
        </div>

        <div class="card" style="width: 18rem;" id="transfercard">
            <img src="./pexels-photo-259200.jpeg" class="card-img-top" alt="Transfer-money" id="transferimg">
            <div class="card-body">
                <h5 class="card-title">Money Transfer</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="./bank1.php" class="btn btn-primary">Show</a>
            </div>
        </div>

        <h1 id="cuslist">Customer List</h1>

        <table id="tabl" class="table table-bordered table-striped col-sm-5 col-lg-10">
            <thead>
                <tr>
                    <th class="center" scope="col">Client no</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Bank Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($r = mysqli_fetch_assoc($row)) {
                    $number = $r['No'];
                    $name = $r["Name"];
                    $email = $r["Email"];
                    $address = $r["Address"];
                    $bill = $r["Amount"];
                    echo "
                                <tr>
                                    <td>{$number}</td>
                                    <td>{$name}</td>
                                    <td>{$address}</td>
                                    <td>{$email}</td>
                                    <td>{$bill}</td>
                                </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="image"></div>
    </article>

    <footer id="copyright" style="text-align:center">
        <p>&copy; 2021 By Abinandhan B </p>
        <small>The Sparks Foundation</small>
    </footer>
</body>

</html>

<!-- view all customers, view only one, transfer money, select customer to transfer to, view all customers-->