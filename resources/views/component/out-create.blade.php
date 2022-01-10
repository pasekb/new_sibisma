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
    @section('button-title','Out History')
    @include('component.button-history')
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
        <livewire:widget-stock-qty>
            <span id="color_code" style="
                width: 10px; height: 50%; 
                display: inline-block;
                position: absolute;
                left: 0px;
                top: 0px;">
            </span>
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Add Stock Out</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('out.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="out_date" type="date" class="form-control input-border-bottom"
                                name="out_date" value="{{ Session::has('input') ? Session::get('input.out_date') : $today }}" value="{{ old('out_date') }}" required>
                            <label for="out_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="stock_id" name="stock_id" value="{{ old('stock_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal"
                                data-target=".modalData" value="{{ old('model_name') }}" required>
                            <label for="model_name" class="placeholder">Select Stock *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color" value="{{ old('color') }}"
                                placeholder="Color *">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc" value="{{ old('year_mc') }}"
                                placeholder="Year MC *">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="on_hand" type="text" class="form-control input-border-bottom" name="on_hand" value="{{ old('on_hand') }}"
                                placeholder="Stock On Hand *" readonly>
                            <label for="on_hand" class="placeholder"></label>

                            <span class="invalid-feedback">
                                <strong><span id="error-msg"></span></strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ old('dealer_id') }}" required>
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ old('dealer_name') }}" data-toggle="modal"
                                data-target=".modalDealer" required>
                            <label for="dealer_name" class="placeholder">Select Destination *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom {{ Session::has('auto') ? 'is-invalid' : '' }}" name="frame_no" value="{{ old('frame_no') }}" @if(Session::has('auto')) autofocus="autofocus" onclick="this.select()" @endif style="text-transform: uppercase;" required>
                            <label for="frame_no" class="placeholder">Frame No. *</label>
                            @if(Session::has('auto'))
                                <span class="invalid-feedback">
                                    <strong>frame no. already out!</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="engine_no" type="text" class="form-control input-border-bottom" name="engine_no" value="{{ old('engine_no') }}" placeholder="Engine No.">
                            <label for="engine_no" class="placeholder"></label>
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
@include('component.modal-dealer')

@push('after-script')
<script>
    $(document).ready(function(){
        $('form').submit(function(e){
            let onHand = $('#on_hand').val();
            let stock = onHand - 1;
            console.log(onHand);
            console.log(stock);
            if (stock < 0) {
                e.preventDefault();
                $('#on_hand').addClass('is-invalid');
                $('#error-msg').text('out of stock!');
            } else {
                $('form').submit();
            }
        });
    });

    $('#on_hand').keypress(function(e){
        e.preventDefault();
    });

    $('#on_hand').keydown(function(e){
        e.preventDefault();
    });

    document.addEventListener('contextmenu', function(e){
        e.preventDefault();
    });
</script>
@endpush
