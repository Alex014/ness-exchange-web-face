<?php

if (isset($_GET['darkmode'])) {
    if ($_GET['darkmode']) {
        setcookie("darkmode", 1);
    } else {
        setcookie("darkmode", 0);
    }
}