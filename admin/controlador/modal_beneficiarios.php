
<!-- Modal -->
<div class="modal fade" id="newBenefiModal" tabindex="-1" role="dialog" aria-labelledby="newBenefiModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newBenefiModal">Detalles del Beneficiario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <?php foreach ($resultado as $dato): ?>

      <?php endforeach; ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>