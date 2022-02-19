<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title><?= $title ?></title>

    <style>
        .row {
            background: #2980b9;
            color: #fff;
        }

        h2 {
            font-family: 'Times New Roman', Times, serif;
        }

        .btn {
            border: 1px solid #fff;
        }
    </style>
</head>

<body>
    <?php if ($sk != null) : ?>
        <div class="container-fluid">
            <div class="display-5 pt-5 pb-5"></div>
            <div class="card-deck mb-5">

                <div class="card col-md-5 mx-auto shadow">
                    <div class="card-header text-center bg-info text-white pt-5 pb-5">
                        <h4>Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">No. Surat</p>
                        <h5 class="card-title"> : <?= $sk->no_sk ?></h5>
                        <p class="card-text">Tanggal Surat</p>
                        <h5 class="card-title"> : <?= $tglsk ?></h5>
                        <p class="card-text">Penandatangan</p>
                        <h5 class="card-title"> : <?= $userttd->nama_dsn ?> - Direktur Politeknik Kampar</h5>
                        <p class="card-text">Perihal</p>
                        <h5 class="card-title"> : Pembagian Tugas Mengajar Semester <?= $ta->ta_tipe ?> Tahun Akademik <?= $ta->thun_akademik ?></h5>
                        <p class="card-text">Unit Kerja</p>
                        <h5 class="card-title"> : POLITEKNIK KAMPAR - RIAU</h5>
                    </div>

                </div>

            </div>
        </div>
    <?php else : ?>
        <h5 class="text-center">No Data Here!</h5>

    <?php endif ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
</body>

</html>