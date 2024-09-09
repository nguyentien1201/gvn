<div id="contactNote" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('order.contact_note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="add-edit-frm" action="" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="website" value="">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{(__('order.latest_contact'))}}<span class="red"> *</span></label>
                            <div class="input-group date" id="latest_contact_date"
                                 data-target-input="nearest">
                                <input type="text" data-target="#latest_contact_date" name="latest_contact_date"
                                       value="" autocomplete="off"
                                       class="form-control datetimepicker-input datetimepicker">
                                <div class="input-group-append" data-target="#latest_contact_date"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <p class="invalid-feedback"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{(__('order.note'))}}</label>
                            <textarea name="contact_note" class="form-control" autocomplete="off"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitContactNote(this)">{{__('panel.update')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('panel.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
