<?php
function display_table($route){
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $db = "bus_details";
                        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                        $query='select * from bus_info where route=($route)';
                        $result=$conn->query($query);
                        echo "<table border='1' class=\"table table-striped\" id=\"bustable\"
                        style=\" margin-top:40px;right:40px; background: rgba(253, 253, 253, 0.384); color: white;\">";
                        echo "<thead>";
                        echo "<tr>
                                <th>Bus Id</th>
                                <th>Bus No</th>
                                </tr>";
                                echo "</thead>";
                             echo "<tbody>" ;
                                while($row = mysqli_fetch_array($result))
                                {
                                echo "<tr>";
                                echo "<td>" . $row['Bus_id'] . "</td>";
                                echo "<td>" . $row['Bus_no'] . "</td>";
                                echo "</tr>";
                                }
                                echo "<tbody>" ;
                                echo "</table>";
                            }
                                mysqli_close($conn);
                                ?>