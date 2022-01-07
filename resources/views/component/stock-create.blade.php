@push('button')
    @section('button-title','Add New Stock')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" style="display: none;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Stock</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('stock.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="unit_id" name="unit_id"
                                required>
                                <option value=""></option>
                                @foreach($unit as $o)
                                <option value="{{ $o->id }}">{{ $o->model_name }}</option>
                                @endforeach
                            </select>
                            <label for="unit_id" class="placeholder">Select Unit</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                        <select class="form-control input-border-bottom" id="dealer_id" name="dealer_id"
                                required>
                                <option value=""></option>
                                @foreach($dealer as $o)
                                <option value="{{ $o->id }}">{{ $o->dealer_name }}</option>
                                @endforeach
                            </select>
                            <label for="dealer_id" class="placeholder">Select Dealer</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ old('qty') }}" placeholder="Qty">
                            <label for="model_name" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

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
