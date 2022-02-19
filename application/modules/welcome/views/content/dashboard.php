 <div class="row">
     <?php if ($this->session->userdata('id_jabatan') != 8) { ?>
         <div class="col-xl-12 col-md-12">
             <div class="card user-card-full">
                 <div class="row m-l-0 m-r-0">
                     <div class="col-sm-4 bg-c-lite-green user-profile">
                         <div class="card-block text-center text-white">
                             <div class="m-b-25">
                                 <img src="<?= base_url() ?>assets\plkm.png" style="max-width: 200px;" class="img-radius" alt="User-Profile-Image">
                             </div>
                             <h6 class="f-w-600"><?= $this->session->userdata('user'); ?></h6>
                             <p><?= $this->session->userdata('role_st'); ?></p>
                             <!-- <i class="feather icon-edit m-t-10 f-16"></i> -->
                         </div>
                     </div>
                     <div class="col-sm-8">
                         <div class="card-block">
                             <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                             <div class="row">
                                 <div class="col-sm-6">
                                     <p class="m-b-10 f-w-600">Email</p>
                                     <h6 class="text-muted f-w-400"><?= $this->session->userdata('email'); ?></h6>
                                 </div>
                                 <div class="col-sm-6">
                                     <p class="m-b-10 f-w-600">Phone</p>
                                     <h6 class="text-muted f-w-400">--</h6>
                                 </div>
                             </div>
                             <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>
                             <div class="row">
                                 <div class="col-sm-6">
                                     <p class="m-b-10 f-w-600">Recent</p>
                                     <h6 class="text-muted f-w-400">Guruable Admin</h6>
                                 </div>
                                 <div class="col-sm-6">
                                     <p class="m-b-10 f-w-600">Most Viewed</p>
                                     <h6 class="text-muted f-w-400">Able Pro Admin</h6>
                                 </div>
                             </div>
                             <ul class="social-link list-unstyled m-t-40 m-b-10">
                                 <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook"><i class="feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                 <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter"><i class="feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                 <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram"><i class="feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     <?php } else { ?>
         <div class="col-xl-3 col-md-6">
             <div class="card bg-c-yellow text-white">
                 <div class="card-block">
                     <div class="row align-items-center">
                         <div class="col">
                             <p class="m-b-5">Mahasiswa</p>
                             <h4 class="m-b-0">852</h4>
                         </div>
                         <div class="col col-auto text-right">
                             <i class="feather icon-users f-50 text-c-yellow"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-md-6">
             <div class="card bg-c-green text-white">
                 <div class="card-block">
                     <div class="row align-items-center">
                         <div class="col">
                             <p class="m-b-5">Dosen</p>
                             <h4 class="m-b-0">70</h4>
                         </div>
                         <div class="col col-auto text-right">
                             <i class="feather icon-users f-50 text-c-green"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-md-6">
             <div class="card bg-c-pink text-white">
                 <div class="card-block">
                     <div class="row align-items-center">
                         <div class="col">
                             <p class="m-b-5">Program Studi</p>
                             <h4 class="m-b-0">4</h4>
                         </div>
                         <div class="col col-auto text-right">
                             <i class="feather icon-book 
                            text-c-pink"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-md-6">
             <div class="card bg-c-blue text-white">
                 <div class="card-block">
                     <div class="row align-items-center">
                         <div class="col">
                             <p class="m-b-5">Kelas</p>
                             <h4 class="m-b-0">15</h4>
                         </div>
                         <div class="col col-auto text-right">
                             <i class="feather icon-list f-50 text-c-blue"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-8 col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h5>Grafik Jumlah Mahasiswa Pertahun</h5>

                 </div>
                 <div class="card-block">
                     <canvas id="perda"></canvas>
                     <div id="graph"></div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h5>Grafik Jumlah Mahasiswa PerProdi</h5>

                 </div>
                 <div class="card-block bg-c-white" style="height: 355px;">
                     <div id="prodi"></div>
                 </div>

             </div>
         </div>
         <div class="col-xl-12 col-md-12">
             <div class="card">
                 <div class="card-header">
                     <h5>Grafik Jumlah Mahasisa Perprodi Dalam Tahun</h5>

                 </div>
                 <div class="card-block">
                     <div id="proditahun"></div>
                 </div>
             </div>
         </div>
     <?php } ?>
 </div>
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
 <script type="text/javascript">
     $(document).ready(function() {
         jumlahmhs();
         jumlahprodi();
         moris();

         function jumlahmhs() {
             $.ajax({
                 url: "<?= base_url() ?>welcome/grafik",
                 method: "GET",
                 success: function(data) {
                     console.log(data);
                     var label = [];
                     var value = [];
                     for (var i in data) {
                         label.push(data[i].tahun);
                         value.push(data[i].jumlahdata);

                     }
                     var ctx = document.getElementById('perda').getContext('2d');
                     var chart = new Chart(ctx, {
                         type: 'bar',
                         data: {
                             labels: label,
                             datasets: [{

                                 label: 'Jumlah Mahasisw Per tahun',
                                 backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                                 borderColor: 'rgb(255, 255, 255)',
                                 data: value
                             }]
                         },
                         options: {}
                     });
                 }
             });
         }

         function jumlahprodi() {
             $.ajax({
                 url: "<?= base_url() ?>welcome/grafikprodi",
                 method: "GET",
                 success: function(res) {
                     console.log(res);
                     Morris.Bar({
                         element: 'prodi',
                         data: res.data,
                         xkey: res.xkeys,
                         ykeys: [res.ykeys],
                         labels: [res.labels],
                         hideHover: 'auto',
                         barColors: function(row, series, type) {
                             console.log("--> " + row.label, series, type);
                             if (row.label == "ABI") return "#AD1D28";
                             else if (row.label == "PPM") return "#0000FF";
                             else if (row.label == "TIF") return "#BF00FF";
                             else if (row.label == "TPS") return "#1AB244";
                         }
                     });
                 }
             });
         }

         function moris() {
             $.ajax({
                 url: '<?= base_url() ?>welcome/morisjs',
                 type: 'GET',
                 dataType: 'JSON',
                 success: function(res) {
                     new Morris.Area({
                         element: 'graph',
                         data: res.data,
                         xkey: res.xkeys,
                         ykeys: [res.ykeys],
                         labels: [res.labels],
                         hideHover: 'auto',
                     });
                 }
             })
         }
         proditahun();

         function proditahun() {
             $.ajax({
                 url: '<?= base_url() ?>welcome/grafikjmlprodi',
                 type: 'GET',
                 dataType: 'JSON',
                 success: function(res) {
                     new Morris.Bar({
                         element: 'proditahun',
                         data: res.data,
                         xkey: 'tahun',
                         ykeys: res.ykeys,
                         labels: res.xlabels
                     });
                 }
             })

         }
     });
 </script>