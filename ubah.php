<?php
include "koneksi.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    mysqli_query($koneksi, "UPDATE `events` SET 
    title ='$title',
    start_event ='$start',
    end_event ='$end'
    WHERE  id ='$id'");
}
