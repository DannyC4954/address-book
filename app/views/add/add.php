<?php
require APPROOT . '/views/inc/header.php';
echo "<div class=\"form-con\">";
    if( isset( $_GET["email"] ) ){
        echo "<h2 class=\"form-title\">Edit {$data["view"]["first_name"]}'s record</h2>";
    } else {
        echo "<h2 class=\"form-title\">Add a record</h2>";
    }
    if( isset( $data["add"] ) ){
        if( is_array( $data["add"] ) ){
            foreach( $data["add"] as $error ){
                echo "<p class=\"red\">{$error}</p>";
            }
        } else {
            echo "<p class=\"red\">{$data["add"]}</p>";
        }
    }
    if( isset( $data["update"] ) ){
        echo "<p class=\"red\">{$data["update"]}</p>";
    }
    if( isset( $_GET["email"] ) ){
        echo "<form method=\"POST\">";
            echo "<label class=\"record-lb\">First Name <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"first_name\" value=\"{$data["view"]["first_name"]}\" />";
            echo "<label class=\"record-lb\">Last Name <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"last_name\" value=\"{$data["view"]["last_name"]}\" />";
            echo "<label class=\"record-lb\">Phone <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"phone\" value=\"{$data["view"]["phone"]}\" />";
            echo "<label class=\"record-lb\">Email <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"email\" value=\"{$data["view"]["email"]}\" />";
            echo "<input class=\"record-sb\" type=\"submit\" name=\"update-record\" value=\"Update\" />";
        echo "</form>";
    } else {
        echo "<form method=\"POST\">";
            echo "<label class=\"record-lb\">First Name <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"first_name\" placeholder=\"Enter first name\" />";
            echo "<label class=\"record-lb\">Last Name <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"last_name\" placeholder=\"Enter last name\" />";
            echo "<label class=\"record-lb\">Phone <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"phone\" placeholder=\"Enter phone number\" />";
            echo "<label class=\"record-lb\">Email <span class=\"red\">*</span></label>";
            echo "<input class=\"record-ip\" type=\"text\" name=\"email\" placeholder=\"Enter email address\" />";
            echo "<input class=\"record-sb\" type=\"submit\" name=\"add-record\" value=\"Add record\" />";
        echo "</form>";
    }
echo "</div>";
require APPROOT . '/views/inc/footer.php';