<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat kegiatan di Kalender</title>
</head>
<style>
    .fc-sun {
        background-color: #ff7979;
    }
</style>

<!-- yg dibutuhkan:
1. libray fullcalender
    2. boostrap 4
    3 jquery
    4 jquery ui
    5 momen js -->
<link rel="stylesheet" href="assets/fullcalendar.bundle.css">
<link rel="stylesheet" href="assets/bootstrap.css">

<script src="assets/jquery.min.js"></script>
<script src="assets/jquery-ui.min.js"></script>
<script src="assets/moment.min.js"></script>
<script src="assets/fullcalendar.bundle.js"></script>
<!-- <link href="assets/fullcalendar.bundle.js" rel="stylesheet" type="text/css" /> -->

<body>
    <br>
    <h2 class="text-center"><a href="#">Membuat Kegiatan Dangan Full kalender dan mysql</a></h2>
    <br>
    <div class="container">
        <div id="calender"></div>
    </div>


    <script>
        // perisapan jquery
        $(document).ready(function() {

            var calender = $('#calender').fullCalendar({
                // izinkan tabel bisa di edit
                editable: true,
                // atur header kalender
                header: {
                    left: 'prev, next, today, list',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay'
                },
                // tampilkan data dari database
                events: 'tampil.php',
                // izinkan kalender bisa dipilih dan edit
                selectable: true,
                selectHelper: true,

                // melakukan aksi tambah
                select: function(start, end, allDay) {
                    var title = prompt("Tampilkan Judul kegiatan");
                    if (title) {
                        // tampung tgl di pilih kedalam variabel start dan end
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        // siapkan ajax lempar data untuk disimpan
                        $.ajax({
                            url: "simpan.php",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end
                            },
                            success: function() {
                                //jika simpan sukses refrresh kalender tampi pesan
                                calender.fullCalendar('refetchEvents');
                                alert('Simpan Sukses ....');
                            }
                        });
                    }
                },
                // event update ketika di pindahkan
                eventDrop: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    // siapkan ajax untuk update
                    $.ajax({
                        url: "ubah.php",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            //jika simpan sukses refrresh kalender tampi pesan
                            calender.fullCalendar('refetchEvents');
                            alert('Tgl Berhasil Ubah ....');
                        }
                    });
                },
                // event klik judul di hapus
                eventClick: function(event) {
                    if (confirm("Apakah Kegiatan Akan dihapus?")) {
                        var id = event.id;
                        // siapkan ajax untuk hapus
                        $.ajax({
                            url: "hapus.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                //jika simpan sukses refrresh kalender tampi pesan
                                calender.fullCalendar('refetchEvents');
                                alert('Kegiatan Berhasil dihapus ....');
                            }
                        });
                    }
                },

            });

        });







        // Kemudian, tambahkan acara hari libur ke kalender
    </script>
</body>

</html>