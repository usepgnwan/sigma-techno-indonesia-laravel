<div class="iconslist">
    <div class="icon">
      <i class="bi bi-facebook"></i>
      <div class="label">facebook</div>
    </div>
    <div class="icon">
        <i class="bi bi-twitter"></i>
        <div class="label">twitter</div>
      </div>
    <div class="icon">
        <i class="bi bi-instagram"></i>
        <div class="label">Instagram</div>
      </div>
    <div class="icon">
        <i class="bi bi-linkedin"></i>
        <div class="label">linkedin</div>
      </div>
    <div class="icon">
        <i class="bi bi-gift"></i>
        <div class="label">gift</div>
    </div>
    <div class="icon">
        <i class="bi bi-globe"></i>
        <div class="label">globe</div>
    </div>
    <div class="icon">
        <i class="bi bi-globe2"></i>
        <div class="label">globe2</div>
    </div>
    <div class="icon">
        <i class="bi bi-graph-up"></i>
        <div class="label">graph-up</div>
    </div>
    <div class="icon">
        <i class="bi bi-hammer"></i>
        <div class="label">hammer</div>
      </div>
      <div class="icon">
        <i class="bi bi-bank2"></i>
        <div class="label">bank2</div>
      </div>
      <div class="icon">
        <i class="bi bi-bookshelf"></i>
        <div class="label">bookshelf</div>
      </div>
      <div class="icon">
        <i class="bi bi-bricks"></i>
        <div class="label">bricks</div>
      </div>
      <div class="icon">
        <i class="bi bi-bucket-fill"></i>
        <div class="label">bucket-fill</div>
      </div>
      <div class="icon">
        <i class="bi bi-brush"></i>
        <div class="label">brush</div>
      </div>
      <div class="icon">
        <i class="bi bi-building"></i>
        <div class="label">building</div>
      </div>
      <div class="icon">
        <i class="bi bi-calendar2-date"></i>
        <div class="label">calendar2-date</div>
      </div>
      <div class="icon">
        <i class="bi bi-cash-coin"></i>
        <div class="label">cash-coin</div>
      </div>
      <div class="icon">
        <i class="bi bi-eraser"></i>
        <div class="label">eraser</div>
      </div>
      <div class="icon">
        <i class="bi bi-eyedropper"></i>
        <div class="label">eyedropper</div>
      </div>

      <div class="icon">
        <i class="bi bi-file-earmark-image"></i>
        <div class="label">file-earmark-image</div>
      </div>
      <div class="icon">
        <i class="bi bi-paint-bucket"></i>
        <div class="label">paint-bucket</div>
      </div>
      <div class="icon">
        <i class="bi bi-recycle"></i>
        <div class="label">recycle</div>
      </div>
</div>

<style>
    .iconslist .icon{
        cursor: pointer;
    }
    .iconslist .icon:hover{
        color: white;
        background: linear-gradient(180deg, #65BAC0 0%, #8DC78A 100%) !important;
    }
    
</style>

<script>
    $('.icon').click(function(){
        let $this = $(this);
        let icon = $this.find('i').attr('class');
        $(this).closest('.modal-content').find('.close-btn').trigger('click');
        $(this).closest('body').find('input[name="icon"]').val(icon)
    });
</script>