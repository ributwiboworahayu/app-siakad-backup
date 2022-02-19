<!DOCTYPE html>
<html>
<head>
	<title>PENGUMUMAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<style type="text/css">
/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
         font-family: "Times New Roman", Times, serif;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #fff solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    /* .subpage { */
        /*padding: 1cm;*/
        /*border: 5px red solid;*/
        /*height: 257mm;*/
        /*outline: 2cm #fff solid;*/
    /* } */
    .subpage-isi {
        padding: 1cm;
        /*border: 5px red solid;*/
        height: auto;
        min-height: 190mm;
        /*outline: 2cm #fff solid;*/
    }
    .subpage-kaki {
        padding: 1cm;
        /*border: 5px red solid;*/
        height: 50mm;
        width: 100mm;
        /*outline: 2cm #fff solid;*/
    }
p{
    margin: 0;
}


    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
</head>
<body>
<div class="book">
    <div class="page" style="padding-top: 10mm;">
        <div class="subpage">
            <img src="<?=base_url()?>assets/img/kop.jpg" width="100%" style="display: block; margin: auto;" >
            <!-- <button onclick="window.print()">Cetak Halaman Web</button> -->
        </div>  
        <div class="subpage-isi" style="padding-top: 0">
            <h3 style="text-align: center;text-decoration: underline;margin-bottom: 5px" >PENGUMUMAN</h3>
            <p style="text-align: center;font-size: 16px;margin-top:0px">NO : <?=$isi->no_pengumuman?></p>
            <br style="margin-top:50px;">
       
                <?= $isi->isi_pengumuman ?>
                
         
        </div>  
        <div class="subpage-kaki" style="padding-top: 0;margin-left: 310px;">
            <p style="text-align: left;" >Bangkinang, 20 Oktober 2020 <br>Wakil Direktur 1<br>
            Bidang Akademik dan Kemahasiswaan</p>
            <br>
            <br>
            <br>
            <br>
            <p style="font-weight:bold;margin: 0">
                Fenty Kurnia Oktorina, S.T., M.Sc.
                <hr style="width: 65mm;float: left;margin: 0">
            </p>
            
            <p style="font-weight:bold;margin: 0;float: left;">NRP : 110306006</p>
        </div>
    </div>

</div>
</body>
</html>