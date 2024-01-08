<?php
    function security($text) {
        $clean = trim($text); // remove spaces from start and end
        $clean = strip_tags($clean); // remove HTML and PHP tags
        $clean = htmlspecialchars($clean); // convert special characters to HTML entities
        $clean = str_replace("insert", "", $clean);
        $clean = str_replace("INSERT", "", $clean);
        $clean = str_replace("delete", "", $clean);
        $clean = str_replace("DELETE", "", $clean);
        $clean = str_replace("drop", "", $clean);
        $clean = str_replace("DROP", "", $clean);
        return $clean;
    }
?>