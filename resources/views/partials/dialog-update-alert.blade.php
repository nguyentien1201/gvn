<div id="add-update-item" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('panel.alerts')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="add-edit-frm" action="" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="">
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <input type="hidden" name="website" value="{{$order->website}}">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{(__('alert.content'))}} <span class="red"> *</span></label>
                            <textarea name="content" class="form-control" autocomplete="off"></textarea>
                            <p class="invalid-feedback"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{(__('alert.publish_time'))}}<span class="red"> *</span></label>
                            <div class="input-group date-time" id="publish_time"
                                 data-target-input="nearest">
                                <input type="text" data-target="#publish_time" name="publish_time"
                                       value="" autocomplete="off"
                                       class="form-control datetimepicker-input datetimepicker">
                                <div class="input-group-append" data-target="#publish_time"
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
                            <label>{{(__('alert.status'))}} <span class="red"> *</span></label>
                            <select autocomplete="off" name="status"
                                    class="form-control custom-select">
                                @foreach($alertStatus as $key => $alertSta)
                                    <option value="{{$key}}">{{$alertSta}}</option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback">
                                {{ $errors->first('staff_id') }}
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitAlert(this)">{{__('panel.save')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('panel.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
