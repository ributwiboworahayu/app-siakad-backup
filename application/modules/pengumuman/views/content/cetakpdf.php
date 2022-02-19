<!DOCTYPE html>
<html>
<head>
	<title>PENGUMUMAN</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
	<style type="text/css">
		/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			background-color: #464646;
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
		.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
  height: 35px;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.navbar button{
	margin: 5px 400px 0px 44px;
	float: right;
}
.navbar label{
	color: white;
	float: left;
	margin:5px 0px 0px 400px;
	/*font-weight: bold;*/
	font-size: 15px;
}

	</style>


</head>
<body>
	<div class="navbar">
		<button id="btnPrint"><i class="fa fa-print"></i> Cetak</button>
		<label>Pengumuman.pdf </label>
	</div>
	<br>
	<div class="book" id="book">
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
			<div class="subpage-kaki" style="padding-top: 0;margin-left: 375px;">
				<p style="text-align: left;" >Bangkinang, <?=$date?> <br>Wakil Direktur 1<br>
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
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#book").html();
            var printWindow = window.open('', '', 'height=1000,width=800');
            // printWindow.document.write('<html><head><title></title>');
            // printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            // printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
</body>
</html>