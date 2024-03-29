<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-new.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Map</title>
</head>


<body style="overflow:hidden; height: 9700px; background-image: radial-gradient( rgb(115, 205, 221), rgb(182, 182, 253)); background-repeat: no-repeat; background-size: cover;">
    <div class="col-12 d-flex justify-content-between">
        <!-- <div class="col-4 display-6 text-white" style="padding: 20px">Welcome: </div> -->
        <div class="d-flex">
            <div class="display-5 text-black" style="padding: 20px">Welcome: </div>
            <div class="display-5 text-black" style=" padding: 20px" id="userName"></div>
        </div>
        <div class="display-4" style="position: absolute; left: 630px; font-family: Verdana, Geneva, Tahoma, sans-serif;color: rgb(27, 24, 168); text-shadow: 2px 2px white;">Smart Vehicle Management</div>
        <button class="btn-warning" style="padding: 10px; margin-top: 10px;margin-right: -5px;" onclick="logout();">Log Out</button>
    </div>
    <div class="row d-flex justify-content-start">
        <div class="col-1" style="margin-top:30px;">
            <div class="sidenav text-black" style="background: rgba(250, 245, 245, 0.281); height: 820px; border-radius: 80px;">
                <!-- <a class="h3 text-sidenav-le">Legend<br></a> -->
                <a><img src="assets/bus_bubble_green.png">
                    <div class="text-sidenav d-flex justify-content-center"><br>Speed 0-30<br></div>
                </a>
                <a><img src="assets/bus_bubble_red.png">
                    <div class="text-sidenav d-flex justify-content-center"><br>Speed &gt30<br></div>
                </a>
                <a><img src="assets/bus_blue.png">
                    <div class="text-sidenav d-flex justify-content-center"><br>&lt7 Satellites<br></div>
                </a>
                <a><img src="assets/bus_yellow.png">
                    <div class="text-sidenav d-flex justify-content-center"><br>Stopped<br></div>
                </a>
                <a><img src="assets/bus_red.png">
                    <div class="text-sidenav d-flex justify-content-center"><br>Maintenance<br></div>
                </a>
            </div>
        </div>
        <div class="col-7">
            <div id="map" class="right-element" style="height: 810px"></div>
        </div>

        <div class="col-4">
            <div class="row">

                <div class="col-4">
                <div class="wrapper">
                <div class="wrapper-content">
                    <button id="myBtn" class="btn btn-warning">Repair</button>
                </div>
                <!--  start modal    -->

                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <div class="modal_header">
                            BUSES:
                        </div>
                        <div class="modal_body">
                            <div class="row">
                                <div class="col-6" >
                                    RUNNING
                                    <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style=" border: 1px solid black; height:100%;">
                                        <img src="assets/bus_blue_60x40.png" draggable="true" ondragstart="drag(event)" id="drag1">
                                    </div>
                                </div>
                                <div class="col-6" >
                                    MAINTENANCE
                                    <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" style=" border: 1px solid black; height:100%;"></div>
                                </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button id="btn_close" class="btn btn-warning" style="width:20%; margin-left:40%;margin-top: 5%;">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--  End modal    -->
                </div>
                <div class="col-4">
                <div class="wrapper">
                <div class="wrapper-content">
                    <button id="myBtn1" class="btn btn-warning">Alarm</button>
                </div>
                <!--  start modal    -->
                <div id="myModal1" class="modal">
                    <div class="modal-content">
                        <div class="modal_header h4">
                            ALARM
                        </div>
                        <div class="modal_body">
                        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Bus ID</th>
      <th scope="col">Bus No</th>
      <th scope="col">Status</th>
      <th scope="col">Last Gps Reading</th>
    </tr>
  </thead>
  <tbody>
  <?php
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $db = "bus_details";
                        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                        $query='select * from bus_info';
                        $result=$conn->query($query);
                        date_default_timezone_set('Asia/Kolkata');
                                while($row = mysqli_fetch_array($result))
                                {
                                    $dum=$row['Bus_no'];
                                    $h=(int)date("H");//system hour
                                    $m=(int)date("i");//system min
                                    $result2=$conn->query("SELECT TIMESTAMP FROM bus where EQPT_ID='$dum' ORDER BY TIMESTAMP DESC LIMIT 1");
                                    $row2=mysqli_fetch_array($result2);
                                    echo "<tr>";
                                    echo "<td>" . $row['Bus_id'] . "</td>";
                                    echo "<td>" . $row['Bus_no'] . "</td>";

                                    $timeH=(int)substr($row2['TIMESTAMP'],11,2);//hour gps
                                    $timeM=(int)substr($row2['TIMESTAMP'],14,2);//min gps

                                    if($h - $timeH > 1){
                                       //Time gtreater than half hour
                                       echo "<td style=\"background:red;\">Not Active</td>";
                                    }
                                    elseif($h-$timeH==1){
                                            $timeM=60-$timeM;
                                            $timeM=$timeM+$m;
                                            if($timeM > 30){
                                                echo "<td style=\"background:red;\">Not Active</td>";
                                            }
                                            else{
                                                echo "<td style=\"background:#32CD32;\">Active</td>";
                                            }
                                    }
                                    elseif($h-$timeH==0){
                                                if($m - $timeM > 30){
                                                    echo "<td style=\"background:red;\">Not Active</td>";
                                                }else{
                                                    echo "<td style=\"background:#32CD32;\">Active</td>";
                                                }
                                    }
                                    else{
                                        echo "<td>LOGIC</td>";
                                        }
                                    echo "<td>" . $row2['TIMESTAMP']."</td>";

                                echo "</tr>";
                                }
                                mysqli_close($conn);
                                ?>
  </tbody>
</table>

                            <button id="btn_close1" class="btn btn-warning" style="width:15%; margin-left:42%;margin-top: 5%;">EXIT</button>


                        </div>
                    </div>
                </div>
                </div>
                <!--  End modal    -->
                </div>
                <div class="col-4">
                    <div class="wrapper">
                    <div class="wrapper-content">
                        <button id="myBtn2" class="btn btn-warning">Report</button>
                    </div>
                    <!--  start modal    -->
                    <div id="myModal2" class="modal">
                        <div class="modal-content">
                            <div class="modal_header h4">
                                REPORT
                            </div>
                            <div class="modal_body">
                            <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Bus ID</th>
          <th scope="col">Bus No</th>
          <th scope="col">Current Speed</th>
          <th scope="col">Running Time</th>
        </tr>
      </thead>
      <tbody>
      <?php
                            $dbhost = "localhost";
                            $dbuser = "root";
                            $dbpass = "";
                            $db = "bus_details";
                            $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                            $query='select * from bus_info';
                            $result=$conn->query($query);
                            date_default_timezone_set('Asia/Kolkata');
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $dum=$row['Bus_no'];
                                        $result2=$conn->query("SELECT TIMESTAMP,SPEED FROM bus WHERE EQPT_ID='$dum' AND IO_VALUE LIKE '1%' ORDER BY TIMESTAMP DESC LIMIT 1");
                                        $row2=mysqli_fetch_array($result2);
                                        echo "<tr>";
                                        echo "<td>" . $row['Bus_id'] . "</td>";
                                        echo "<td>" . $row['Bus_no'] . "</td>";
                                        $s=(int) $row2['SPEED'];
                                        if($s>30){
                                            echo "<td style=\"background:red\">" . $row2['SPEED']."</td>";
                                        }
                                        else{
                                            echo "<td style=\"background:green\">" . $row2['SPEED']."</td>";
                                        }
                                        $result3=$conn->query("SELECT TIMESTAMP,SPEED FROM bus WHERE EQPT_ID='$dum' AND IO_VALUE LIKE '0%' ORDER BY TIMESTAMP DESC LIMIT 1");
                                        $row3=mysqli_fetch_array($result3);
                                        $timeHON=(int)substr($row2['TIMESTAMP'],11,2);//hour gps on
                                        $timeMON=(int)substr($row2['TIMESTAMP'],14,2);//min gps on
                                        $timeHOFF=(int)substr($row3['TIMESTAMP'],11,2);//hour gps off
                                        $timeMOFF=(int)substr($row3['TIMESTAMP'],14,2);//hour gps off

                                        if($timeHOFF-$timeHON == 0){
                                            $h=0;
                                            $m=$timeMOFF-$timeMON;
                                        }
                                        elseif($timeHOFF-$timeHON > 0) {
                                            $m=60-$timeMON+$timeMOFF;
                                            $h=($timeHOFF-$timeHON -1)*60;
                                        }
                                        else{
                                            $m=0;
                                            $h=0;
                                        }
                                        $t=$m+$h;
                                        echo "<td>" . $t . " Mins</td>";


                                    echo "</tr>";
                                    }
                                    mysqli_close($conn);
                                    ?>
      </tbody>
    </table>

                                <button id="btn_close2" class="btn btn-warning" style="width:15%; margin-left:42%;margin-top: 5%;">EXIT</button>


                            </div>
                        </div>
                    </div>
                    </div>
                    <!--  End modal    -->
                    </div>

            </div>



            <div class="card"
                style=" margin-top:30px;margin-right: 10px; background: rgba(245, 245, 248, 0.404); text-align: center; color: black;">
                <div class="card-body">
                    <h5 class="card-title">ROUTES</h5>
                    <form id="mainForm" name="mainForm">
                        <div class="row">
                            <div class="col-4">
                                <div class="radio">
                                    <label><input type="radio" class="option-input radio" id="route1" value="route1"
                                            name="route"><span>Route 1</span></label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="radio">
                                    <label><input type="radio" class="option-input radio" id="route2" value="route2"
                                            name="route"><span>Route 2</span></label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="radio">
                                    <label><input type="radio" class="option-input radio" id="route3" value="route3"
                                            name="route"><span>Route 3</span></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script type="text/javascript">
                                    function hideme(){
                                         document.getElementById("bustable1").style.visibility="hidden";
                                         document.getElementById("bustable2").style.visibility="hidden";
                                         document.getElementById("bustable3").style.visibility="hidden";
                                    }
                                </script>


            <!-- ROUTE 1 -->
            <table class="table table-striped" id="bustable1"
                        style=" margin-top:44px;right:40px; background: rgba(253, 253, 253, 0.384); color: black;">


            <?php
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $db = "bus_details";
                        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                        $query='select * from bus_info where route=1';
                        $result=$conn->query($query);
                        date_default_timezone_set('Asia/Kolkata');
                        echo "<thead class=\"thead-dark\">";
                        echo "<tr>
                                <th><p class='h5'>Bus Id</p></th>
                                <th><p class='h5'>Bus No</p></th>
                                <th><p class='h5'>Timestamp</p></th>
                                </tr>";
                                echo "</thead>";
                             echo "<tbody>" ;
                                while($row = mysqli_fetch_array($result))
                                {
                                    $dum=$row['Bus_no'];
                                $result2=$conn->query("SELECT TIMESTAMP FROM bus where EQPT_ID='$dum' ORDER BY TIMESTAMP DESC LIMIT 1");
                                $row2=mysqli_fetch_array($result2);
                                echo "<tr>";
                                echo "<td>" . $row['Bus_id'] . "</td>";
                                echo "<td>" . $row['Bus_no'] . "</td>";
                                echo "<td>" . $row2['TIMESTAMP']."</td>";
                                echo "</tr>";
                                }
                                echo "<tbody>" ;
                                mysqli_close($conn);
                                echo '<script type="text/javascript">',
                                'hideme();',
                                '</script>'
                                ;

                                ?>
            </table>
            <table class="table table-striped" id="bustable2"
                        style=" margin-top:-220px;right:40px;  background: rgba(253, 253, 253, 0.384); color: black;">
                                <!-- Route2 -->
                                <?php
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $db = "bus_details";
                        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                        $query='select * from bus_info where route=2';
                        $result=$conn->query($query);
                        echo "<thead class=\"thead-dark\">";
                        echo "<tr>
                        <th><p class='h5'>Bus Id</p></th>
                        <th><p class='h5'>Bus No</p></th>
                        <th><p class='h5'>Timestamp</p></th>
                                </tr>";
                                echo "</thead>";
                             echo "<tbody>" ;
                                while($row = mysqli_fetch_array($result))
                                {
                                    $dum=$row['Bus_no'];
                                    $h=(int)date("H");
                                    $m=(int)date("i");

                                    $result2=$conn->query("SELECT TIMESTAMP FROM bus where EQPT_ID='$dum' ORDER BY TIMESTAMP DESC LIMIT 1");
                                    $row2=mysqli_fetch_array($result2);
                                    echo "<tr>";
                                    echo "<td>" . $row['Bus_id'] . "</td>";
                                    echo "<td>" . $row['Bus_no'] . "</td>";
                                    echo "<td>" . $row2['TIMESTAMP']."</td>";

                                echo "</tr>";
                                }
                                echo "<tbody>" ;

                                mysqli_close($conn);
                                 echo '<script type="text/javascript">',
                                'hideme();',
                                '</script>'
                                ;
                                ?>
                                </table>
                <!-- Route3 -->
                <table class="table table-striped" id="bustable3"
                        style=" margin-top:-270px;right:40px;  background: rgba(253, 253, 253, 0.384); color: black;">

                                <?php
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $db = "bus_details";
                        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                        $query='select * from bus_info where route=3';
                        $result=$conn->query($query);
                        echo "<thead class=\"thead-dark\">";
                        echo "<tr>
                        <th><p class='h5'>Bus Id</p></th>
                        <th><p class='h5'>Bus No</p></th>
                        <th><p class='h5'>Timestamp</p></th>
                                </tr>";
                                echo "</thead>";
                             echo "<tbody>" ;

                                while($row = mysqli_fetch_array($result))
                                {
                                    $dum=$row['Bus_no'];
                                    $result2=$conn->query("SELECT TIMESTAMP FROM bus where EQPT_ID='$dum' ORDER BY TIMESTAMP DESC LIMIT 1");
                                    $row2=mysqli_fetch_array($result2);
                                    echo "<tr>";
                                    echo "<td>" . $row['Bus_id'] . "</td>";
                                    echo "<td>" . $row['Bus_no'] . "</td>";
                                    echo "<td>" . $row2['TIMESTAMP']."</td>";
                                    // echo "<td>" . date("H:i")."</td>";
                                echo "</tr>";
                                }
                                echo "<tbody>" ;

                                mysqli_close($conn);
                                 echo '<script type="text/javascript">',
                                'hideme();',
                                '</script>'
                                ;
                                ?>
</table>

        </div>
        </div>
    </div>
    </div>
    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/6.1.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.1.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.1.1/firebase-firestore.js"></script>


    <script src="js/userDetails.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/alarm-modal.js"></script>
    <script src="js/report-modal.js"></script>
    <script src="js/drag_drop.js"></script>
    <script src="js/map.js"></script>
    <script src="js/route-selector.js"></script>


    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBp1iZsLLH53hUyU8BbNQu_2Xq6tJi3ICk",
            authDomain: "smart-fleet-tata-steel.firebaseapp.com",
            databaseURL: "https://smart-fleet-tata-steel.firebaseio.com",
            projectId: "smart-fleet-tata-steel",
            storageBucket: "smart-fleet-tata-steel.appspot.com",
            messagingSenderId: "26082732514",
            appId: "1:26082732514:web:f0aac8b3a7f2ca78"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>
    <!-- bootstrap -->
    <script src="js/bootstrap.js"></script>
    <!-- jQuery library -->
    <script src="js/jquery-min.js"></script>
    <!-- popper-js -->
    <script src="js/popper-min.js"></script>
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbaOxnzOfhcCTvgv_KWYvJMhr-NP7XnSk&callback=initMap"
        async defer></script>

</body>

</html>