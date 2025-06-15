
<div class="modal fade" id="confirmApprove" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST">
        @method('PUT')
        @csrf
      <input type="hidden" name="id">
       <input type="hidden" name="is_active">
        <input type="hidden" name="approve">
      <div class="modal-content">
        <div class="modal-heade">
          <h5 class="modal-title"><i class="fas fa-user-check"></i> Confirm Approval</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-confirm"></p>
          <p><strong class="user-name text-success"></strong></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Yes, Approve</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
