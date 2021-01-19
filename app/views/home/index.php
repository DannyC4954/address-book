<?php

require APPROOT . '/views/inc/header.php';
if( $data["load"] ){
    echo "<div class=\"error-modal\">";
        echo "<div class=\"error-content\">";
            echo "<h2 class=\"pb-20\">Form error</h2>";
            echo "<p class=\"pb-50\">Please make sure that you complete the required (<span class=\"red\">*</span>) fields 
            before submitting a new record. Remember to include 11 digits for phone numbers and a valid @ for email addresses.</p>";
            echo "<a class=\"action-btn red-bck close-btn\">Close</a>";
        echo "</div>";
    echo "</div>";
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
                        echo "<label for=\"delete-{$result["email"]}\" class=\"action-btn red-bck\">Delete</label>";
                        echo "<form method=\"POST\">";
                            echo "<input type=\"hidden\" name=\"delete-ID\" value=\"{$result["email"]}\" />";
                            echo "<input type=\"submit\" id=\"delete-{$result["email"]}\" class=\"hidden-ip\" name=\"delete-record\" />";
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
                        echo "<label for=\"delete-{$record["email"]}\" class=\"action-btn red-bck\">Delete</label>";
                        echo "<form class=\"ajax-delete\" action=\"".URLROOT."/home/ajaxdelete\" method=\"POST\">";
                            echo "<input type=\"hidden\" name=\"delete-ID\" value=\"{$record["email"]}\" />";
                            echo "<input type=\"submit\" id=\"delete-{$record["email"]}\" class=\"hidden-ip\" name=\"delete-record\" />";
                        echo "</form>";
                    echo "</td>";
                echo "</tr>";
            }  
        }
        echo "</tbody>";
    echo "</table>";
    echo "<div class=\"main-form-con\">";
    echo "<h2 class=\"pb-20\">Add a record</h2>";
        echo "<form id=\"ajax-form\" action=\"".URLROOT."/home/ajaxadd\" method=\"POST\">";
            echo "<label class=\"record-lb\">First Name <span class=\"red\">*</span></label>";
            echo "<input class=\"main-record-ip\" type=\"text\" name=\"first_name\" placeholder=\"Enter first name\" />";
            echo "<label class=\"record-lb\">Last Name <span class=\"red\">*</span></label>";
            echo "<input class=\"main-record-ip\" type=\"text\" name=\"last_name\" placeholder=\"Enter last name\" />";
            echo "<label class=\"record-lb\">Phone <span class=\"red\">*</span></label>";
            echo "<input class=\"main-record-ip\" type=\"text\" name=\"phone\" placeholder=\"Enter phone number\" />";
            echo "<label class=\"record-lb\">Email <span class=\"red\">*</span></label>";
            echo "<input class=\"main-record-ip\" type=\"email\" name=\"email\" placeholder=\"Enter an email address\" />";
            echo "<input class=\"record-sb\" type=\"submit\" name=\"ajax-add\" />";
        echo "</form>";
    echo "</div>";

} else {
    echo "<h2 class=\"form-title pt-50 pb-20\">No records to show, <a href=\"".URLROOT."/add\">click here</a> to add a new record.</h2>";
}
require APPROOT . '/views/inc/footer.php';