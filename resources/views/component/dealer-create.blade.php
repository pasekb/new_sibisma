<div class="col-md-12">
    <button class="btn btn-success" id="btnDealerCreate" style="margin-bottom: 20px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Dealer</button>
</div>

<div class="col-md-12" id="dealerCreate" style="display: none;">
    <div class="card">
        <div class="card-header bg-dark">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title" style="color: white;">Add New Dealer</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseDealerCreate"><i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dealer.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text"
                                class="form-control input-border-bottom @if(session()->has('message')) is-invalid @endif"
                                name="dealer_code" value="{{ old('dealer_code') }}" autofocus required>
                            <label for="inputFloatingLabel" class="placeholder">Dealer Code</label>
                            
                            @if(session()->has('message'))
                            <span class="invalid-feedback">
                                <strong>{{ session('message') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ old('dealer_name') }}" required>
                            <label for="inputFloatingLabel" class="placeholder">Dealer Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ old('phone') }}" required>
                            <label for="inputFloatingLabel" class="placeholder">Phone</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ old('address') }}" required>
                            <label for="inputFloatingLabel" class="placeholder">Address</label>
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
        $(document).ready(function(){
            $('#btnDealerCreate').click(function(){
                $(this).css('display','none');
                $('#dealerCreate').fadeIn();
            });

            $('#btnCloseDealerCreate').click(function(){
                $('#dealerCreate').css('display','none');
                $('#btnDealerCreate').fadeIn();
            });
        });
    </script>
@endpush
