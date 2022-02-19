<div class="row">
  <div class="col-sm-12" id="form-menu" style="display: block;">

   <div class="j-wrapper j-wrapper-640">
     <?= form_open(base_url().'chating/kirim', array('id' =>"f-menu" ,'class'=>"j-pro" )); ?>

      <div class="j-content">
       <legend style="text-align: center;margin-bottom: 10px;">FORM MENU</legend>
       <div class="j-unit">
        <label class="j-label">Pesan</label>
        <div class="j-input j-select">
          <label class="j-input j-select">
            <textarea class="form-control" name="pesan"></textarea>
            <i></i>
          </label>
          </div>
        </div>
      </div>
      <!-- end /.content -->
      <div class="j-footer">
        <span class="pull-right">Kata : <span id="cont"></span></span>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" id="cancel-form">Cancel</button>
      </div>
      <!-- end /.footer -->
        <?= form_close(); ?>
  </div>
</div>
</div>
<script type="text/javascript">
  $(function() {
    ajaxcsrf();
    $('[name="pesan"]').change(function(event) {
      /* Act on the event */
      var text=$(this).val();
      var numWords = 0;
            for (var i = 0; i < text.length; i++) {
                var currentCharacter = text[i];
                if (currentCharacter == " ") {
                    numWords += 1;
                }
            }
            numWords += 1;
      $('#cont').text(numWords);
    });
    $('form#f-menu').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),
        success : function(res) {
          if(res.status){
            success(res.msg);
            // console.log(res.pesan);
          }
        }
      })
      
      
    });
  });
</script>