<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Icon -->
    <link href="{{ asset('img/logo.png') }}" rel="ICON"/>

    <title>Absensi Magang</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

    <style>
        
        .navbar{
            background: #fff;
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0px -6px 16px 8px grey;
        }

        .navbar-brand{
            margin-left: 2%;
        }

        .navbar-text{
            font-family: Montserrat;
            font-size: 30px;
            padding-top: 1rem;
            padding-bottom: unset !important;
        }

        .btn{
            width: 100%;
        }

        .container-fluid{
            padding: 0px 50px;
        }

        .form-control[readonly]{
        background-color: unset;
        color: #000;
        cursor: unset;
        }

        .form-control[disabled]{
            background-color: unset;
            color: #000;
            cursor: unset;
        }

    </style>

</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-absolute">
        <div class="navbar-brand">
            <img src="{{ asset('img/brand.png') }}">
        </div>
        <div class="navbar-text">
            - Absensi Magang    
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <div class="row col-md-6 mb-2">
                <h4>
                    Isikan data dengan benar !
                </h4>
            
                <div class="col-md-12 mb-2">
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama.">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Pilih tanggal">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Jam Masuk</label>
                    <input type="time" name="masuk" id="masuk" class="form-control" placeholder="Masukkan jam masuk.">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Jam Pulang</label>
                    <input type="time" name="pulang" id="pulang" class="form-control" placeholder="Masukkan jam pulang.">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Tugas yang Dikerjakan</label>
                    <input type="text" name="tugas" id="tugas" class="form-control" placeholder="Tuliskan tugas.">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Kendala yang Dialami</label>
                    <textarea class="form-control" rows="3" id="kendala" name="kendala" placeholder="Ceritakan kendala apa saja yang kamu alami saat mengerjakan tugas."></textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <input type="button" name="submit" id="submit" class="btn btn-success" value="Submit" onclick="proses()">
                </div>
            </div>

            <div id="hasil" class="col-md-6" style="border-left: 2px solid black" hidden="">

                <h4>
                    HASIL INPUTAN !
                </h4>
            
                <div class="col-md-12 mb-2">
                    <label >Nama</label>
                    <input type="text" name="hnama" id="hnama" class="form-control" placeholder="-" readonly="">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Tanggal</label>
                    <input type="date" name="htanggal" id="htanggal" class="form-control" placeholder="-" readonly="">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Lama Magang di Kantor</label>
                    <input type="text" name="lama" id="lama" class="form-control" placeholder="-" readonly="">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Tugas yang Dikerjakan</label>
                    <input type="text" name="htugas" id="htugas" class="form-control" placeholder="-" readonly="">
                </div>

                <div class="col-md-12 mb-2">
                    <label>Kendala yang Dialami</label>
                    <textarea class="form-control" rows="3" id="hkendala" name="hkendala" disabled="" placeholder="-"></textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <input type="button" name="hide" id="hide" class="btn btn-danger" value="Sembunyikan Hasil" onclick="hide()">
                </div>
            </div>
            
        </div>
    </div>

</body>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript" ></script>

<script src="{{ asset('js/popper.min.js') }}"></script>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    function proses(){
        var nama = $('#nama').val();
        var tanggal = $('#tanggal').val();
        var masuk = $('#masuk').val();
        var pulang = $('#pulang').val();
        var tugas = $('#tugas').val();
        var kendala = $('#kendala').val();

    // #Hitung Jam Magang
        hours = pulang.split(':')[0] - masuk.split(':')[0],
        minutes = pulang.split(':')[1] - masuk.split(':')[1];
        // Istirahat 1
        if (masuk <= "12:00:00" && pulang >= "12:59:59"){
            a = 1;
        } else {
            a = 0;
        }
        // Istirahat 2
        if (masuk <= "16:00:00" && pulang >= "16:59:59"){
            b = 1;
        } else {
            b = 0;
        }
        // Istirahat 3
        if (masuk <= "18:00:00" && pulang >= "18:59:59"){
            c = 1;
        } else {
            c = 0;
        }
        minutes = minutes.toString().length<2?'0'+minutes:minutes;
        if(minutes<0){ 
            hours--;
            minutes = 60 + minutes;
        }
        hours = hours.toString().length<2?'0'+hours:hours;

    // #Hasil
        $('#hasil').prop('hidden', false);
        $('#hnama').val(nama);
        $('#htanggal').val(tanggal);
        $('#lama').val(hours - a - b - c + ' Jam ' + minutes + ' Menit');
        $('#htugas').val(tugas);
        $('#hkendala').val(kendala);
    };
</script>

<script type="text/javascript">
    function hide(){
        $('#hasil').prop('hidden', true);
    }
</script>

</html>
