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
                    <h4 class="card-title">Add Sales</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal"
                                data-target=".modalData" required>
                            <label for="model_name" class="placeholder">Select Stock *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                                placeholder="Color *">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                placeholder="Year MC *">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="on_hand" type="number" class="form-control input-border-bottom" name="on_hand"
                                placeholder="Stock On Hand *">
                            <label for="on_hand" class="placeholder">Stock On Hand *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no" required>
                            <label for="frame_no" class="placeholder">Frame No. *</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="leasing_id" name="leasing_id" required>
                                <option value=""></option>
                                @foreach($leasing as $o)
                                <option value="{{ $o->id }}">{{ $o->leasing_code }}</option>
                                @endforeach
                            </select>
                            <label for="leasing_id" class="placeholder">Select Leasing *</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="nik" type="number" class="form-control input-border-bottom" name="nik"
                                placeholder="Customer's NIK">
                            <label for="nik" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="customer_name" type="text" class="form-control input-border-bottom" name="customer_name"
                                placeholder="Customer's Name">
                            <label for="customer_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                placeholder="Customer's Phone">
                            <label for="phone" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                placeholder="Customer's Address">
                            <label for="address" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Stock')
@include('component.modal-data')

@push('after-script')
<script>
    $(document).ready(function () {
        $('#btnCreate').click(function () {
            $(this).css('display', 'none');
            $('#dataCreate').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataCreate').css('display', 'none');
            $('#btnCreate').fadeIn();
        });
    });
</script>
@endpush

