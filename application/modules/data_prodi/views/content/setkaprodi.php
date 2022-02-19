<div class="row">
                    

                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-header">

                          <hr>
                          <button type="button" class="btn btn-out btn-primary btn-square btn-sm " data-toggle="modal" href='#modal-add'><i class="ion-plus-round"></i> New data</button>
                       
                          <button type="button" class="btn btn-out btn-danger btn-square btn-sm"><i class="ion-trash-a"></i> Bulk Hapus</button>
                          <button type="button" class="btn btn-out btn-dark btn-square btn-sm"><i class="ion-refresh"></i> Refresh</button>
                          <a href="<?=base_url();?>data_prodi" class="btn btn-out btn-warning btn-square btn-sm " style="float: right;" ><i class="ion-arrow-left-c"></i> Kembali</a>
                          <hr>
                        </div>

                        <div class="card-block">
                          <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kode Prodi</th>
                                  <th>Nama Prodi</th>
                                  <th>Ketua Prodi</th>
                                  <th>Edit</th>
                                  <th><input type="checkbox" name="" value="" placeholder=""></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  
                                  <td>Edinburgh</td>
                                  <td>61</td>
                                  <td>2011/04/25</td>
                                  <td>$320,800</td>
                                  <td><button type="button" class="btn btn-out btn-warning btn-square btn-mini" data-toggle="modal" href='#modal-add'><i class="ion-edit"></i> Edit</button></td>
                                  <td><input type="checkbox" name="" value="" placeholder=""></td>
                                </tr>

                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>No</th>
                                  <th>Kode Prodi</th>
                                  <th>Nama Prodi</th>
                                  <th>Ketua Prodi</th>
                                  <th>Edit</th>
                                  <th><input type="checkbox" name="" value="" placeholder=""></th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>