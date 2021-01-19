<?php

require APPROOT . '/views/inc/header.php';

if( $data["load"] ){
    echo "<div class=\"search-con\">";
        echo "<h2 class=\"pb-20\">Search records</h2>";
        echo "<form method=\"POST\">";
            echo "<input class=\"search-ip\" type=\"text\" name=\"search-input\" placeholder=\"Search by first or last name\" />";
            echo "<input class=\"search-sb\" type=\"submit\" name=\"search-address\" value=\"Search\" />";
        echo "</form>";
    echo "</div>";
    echo "<table>";
        echo "<thead>";
        echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Phone</th>";
            echo "<th>Email</th>";
            echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $count = 0;
        if( isset( $data["search"] ) ){
            foreach( $data["search"][0] as $result ){
                if( $result["last_name"] ==  $data["search"][1] || $result["first_name"] ==  $data["search"][1]  ){
                    echo "<tr>";
                    $name = $result["first_name"] . " " . $result["last_name"];
                    echo "<td>{$name}</td>";
                    echo "<td>{$result["phone"]}</td>";
                    echo "<td>{$result["email"]}</td>";
                    echo "<td>";
                        echo "<a class=\"action-btn\" href=\"".URLROOT."/add?email={$result["email"]}\">Edit</a>";
                        echo "<label for=\"delete-{$count}\" class=\"action-btn red-bck\">Delete</label>";
                        echo "<form method=\"POST\">";
                            echo "<input type=\"hidden\" name=\"delete-ID\" value=\"{$result["email"]}\" />";
                            echo "<input type=\"submit\" id=\"delete-{$count}\" class=\"hidden-ip\" name=\"delete-record\" />";
                        echo "</form>";
                    echo "</td>";
                echo "</tr>";
                } 
            }
        } else {
            foreach( $data["load"] as $record ){
                echo "<tr>";
                    $name = $record["first_name"] . " " . $record["last_name"];
                    echo "<td>{$name}</td>";
                    echo "<td>{$record["phone"]}</td>";
                    echo "<td>{$record["email"]}</td>";
                    echo "<td>";
                        echo "<a class=\"action-btn\" href=\"".URLROOT."/add?email={$record["email"]}\">Edit</a>";
                        echo "<label for=\"delete-{$count}\" class=\"action-btn red-bck\">Delete</label>";
                        echo "<form method=\"POST\">";
                            echo "<input type=\"hidden\" name=\"delete-ID\" value=\"{$record["email"]}\" />";
                            echo "<input type=\"submit\" id=\"delete-{$count}\" class=\"hidden-ip\" name=\"delete-record\" />";
                        echo "</form>";
                    echo "</td>";
                echo "</tr>";
            }  
        }
        echo "</tbody>";
    echo "</table>";
} else {
    echo "<h2 class=\"form-title pt-50 pb-20\">No records to show, <a href=\"".URLROOT."/add\">click here</a> to add a new record.</h2>";
}

require APPROOT . '/views/inc/footer.php';