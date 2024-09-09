<div id="confirmDelete" class="modal fade">
    <form action="" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="website" value="">
        <input type="hidden" name="id" value="">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fas fa-times"></i>
                    </div>
                    <h5 class="modal-title">{{__('panel.confirm-delete')}}</h5>
                    <span class="text-gray text-sm text-confirm"></span>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{__('panel.delete')}}</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{__('panel.cancel')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
