<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<link rel="Stylesheet" type="text/css" href="sbank.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
<header class="jumbotron shadow" id='bg'>
        <h1 id='title'>SPARKS BANK</h1>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active tabs" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tabs" href="./transaction.php">Transactions</a>
                </li>
            </ul>
    </header> 
    <div class="jumbotron">
        <h1 id="heading"> Transfer Money</h1>
    </div>

        <script>
        function appendURL(){
            var id = document.getElementById("senderId");
            var actionSrc="transfer.php?id=" + id.value ;
        }
        </script>
    
    <article class="container" id="fom">

       <form method="POST" onsubmit="appendURL()" name="myform">  
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Recipient</label>
                <input type="text" name="reciever" class="form-control" id="exampleFormControlInput1" placeholder="Name">
            </div>

            <div>
                <label for="exampleFormControlInput1" class="form-label">Amount</label>
                <input type="text" name="money" class="form-control" id="exampleFormControlInput1" placeholder="Value">
               
                <input type="hidden" value= <?php
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                    else  
                    $url = "http://";
                    $url.= $_SERVER['HTTP_HOST'];      
                    $url.= $_SERVER['REQUEST_URI'];
                    
                    $url_c=parse_url($url);
                    if (strpos($url,'?id=') !== false)
                    {
                        parse_str($url_c['query'],$params);
                        $sender=$params['id'];
                        echo $sender;
                    }
                    else echo '';
                    
                    ?>  id="senderId" />
            </div>
            <br>
            <button class="btn btn-primary" name="submit" id="submit">Transfer</button>
        </form>
        
        <!--alert tags-->
        <div  class="text-success" role="alert" id="sucalert">Money Transferred Successfully!</div>
        <div style="display:none;" class="text-danger" role="alert" id="fillalert">The above information is are required!</div>
        <div style="display:none;" class="text-danger" role="alert" id="dangalert">Transfer Unsuccessful!</div>
        <div style="display:none;" class="text-danger" role="alert" id="samealert">Chosen user is the sender. Please choose a differernt recipient!</div> 
        
        <!--data recieving and updating data in the database at transfer.php-->
        
        <?php
        if(isset($_POST['submit']))
        {                       
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                $url = "https://";   
                else  
                $url = "http://";
                $url.= $_SERVER['HTTP_HOST'];      
                $url.= $_SERVER['REQUEST_URI'];
                $sender =0;
                $url_c=parse_url($url);
                if (strpos($url,'?id=') !== false)
                {
                    parse_str($url_c['query'],$params);
                    $sender=(int)$params['id'];
                }
            
            $servername = "remotemysql.com";
            $username = "PDITTFXTCF";
            $password = "pPLPlGdZzn";
            $conn = mysqli_connect($servername, $username, $password, "PDITTFXTCF");
            $reciever=$_POST['reciever'];
            $amount=$_POST['money'];
            $query="select id from bank1 where name='$reciever';";
            $resultid=mysqli_query($conn,$query);
            $result=mysqli_fetch_assoc($resultid);
            if($result["id"]==$sender){
            ?>
                    <script type="text/javascript">
                    function cancel(){
                        $("#samealert").show();
                        return false;
                    }
                    cancel();
                    </script>
            <?php
            }
            else if($reciever=="" && $amount==""){
            ?>
                    <script type="text/javascript">
                        function fill(){
                            $("#fillalert").show();
                            return false;
                        }
                        fill();
                    </script>
            <?php    
            }
            else{
            $q1 = "update bank1 set sent=sent+'$amount',  balance=balance-'$amount' where id='$sender';";
            mysqli_query($conn,$q1);
            $q2 = "update bank1 set recieved=recieved+'$amount',  balance=balance+'$amount' where name = '$reciever';";
            mysqli_query($conn,$q2); 
            $q3 = "update bank set Amount=Amount-'$amount' where No='$sender';";
            mysqli_query($conn,$q3);
            $q4 = "update bank set Amount=Amount+'$amount' where name = '$reciever';";
            mysqli_query($conn,$q4);
            }
            ?>
            <script type="text/javascript">
                        function success(){
                            $("#sucalert").show();
                        }
                        success();
                </script>
            <?php
        }
    ?>
    </article>
    <br><br><br><br><br><br><br><br><br><br><br>
    <footer id="copyright" style="text-align:center">
        <p>&copy; 2021 By Abinandhan B </p>
        <small>The Sparks Foundation</small>
    </footer>
</body>
</html>