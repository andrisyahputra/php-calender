<?php

// pangil koneksi
include 'koneksi.php';
$tampil = mysqli_query($koneksi, "SELECT * FROM events ORDER BY id");
$dataArr = array();
while ($data = mysqli_fetch_array($tampil)) {
    $dataArr[] = array(
        'id' => $data['id'],
        'title' => $data['title'],
        'start' => $data['start_event'],
        'end' => $data['end_event'],
    );
}

echo json_encode($dataArr);
