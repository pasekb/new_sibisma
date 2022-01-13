@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }

    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }

</style>
@endpush

@push('button')
@section('button-title','Branch Delivery History')
@include('component.button-history')
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <span id="color_code" style="
                width: 10px; height: 50%; 
                display: inline-block;
                position: absolute;
                left: 0px;
                top: 0px;">
            </span>
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Add Branch Delivery</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('branch-delivery.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="branch_delivery_date" type="date" class="form-control input-border-bottom"
                                name="branch_delivery_date"
                                value="{{ Session::has('input') ? Session::get('input.branch_delivery_date') : $today }}"
                                value="{{ old('branch_delivery_date') }}" required>
                            <label for="branch_delivery_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="out_id" name="out_id" value="{{ old('out_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal" data-target=".modalData"
                                value="{{ old('model_name') }}" required>
                            <label for="model_name" class="placeholder">Select Unit Out *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                                value="{{ old('color') }}" placeholder="Color *">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                value="{{ old('year_mc') }}" placeholder="Year MC *">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no"
                                value="{{ old('frame_no') }}" placeholder="Frame No.">
                            <label for="frame_no" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" name="dealer_id" id="dealer_id">
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ old('dealer_name') }}" placeholder="Dealer's Name">
                            <label for="dealer_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                value="{{ old('phone') }}" placeholder="Phone">
                            <label for="phone" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ old('address') }}" placeholder="Address">
                            <label for="address" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="delivery_time" type="time" class="form-control input-border-bottom"
                                name="delivery_time" value="{{ old('delivery_time') }}" value="{{ $time }}" required>
                            <label for="delivery_time" class="placeholder">Delivery Time *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="arrival_time" type="time" class="form-control input-border-bottom"
                                name="arrival_time" value="{{ old('arrival_time') }}" value="{{ $time }}">
                            <label for="arrival_time" class="placeholder">Arrival Time</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="main_driver" name="main_driver" value="{{ old('main_driver') }}"
                                required>
                            <input id="driver_name" type="text" class="form-control input-border-bottom"
                                name="driver_name" value="{{ old('driver_name') }}" data-toggle="modal"
                                data-target=".modalMainDriver" required>
                            <label for="driver_name" class="placeholder">Select Driver *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="backup_driver" name="backup_driver"
                                value="{{ old('backup_driver') }}" required>
                            <input id="pic_name" type="text" class="form-control input-border-bottom" name="pic_name"
                                value="{{ old('pic_name') }}" data-toggle="modal" data-target=".modalBackupDriver"
                                required>
                            <label for="pic_name" class="placeholder">Select PIC *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea id="note" type="text" class="form-control input-border-bottom"
                                name="note" value="{{ old('note') }}"
                                placeholder="Note"></textarea>
                            <label for="note" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Out')
@include('component.modal-data')
@include('component.modal-main-driver')
@include('component.modal-backup-driver')
