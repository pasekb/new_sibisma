@forelse($data as $o)
<div class="col-md-12" id="dealerCreate">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title" style="color: white;">Edit Dealer {{ $o->dealer_code }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dealer.edit') }}" method="post">
                @csrf
                
                <input type="hidden" name="id" value="{{ $o->id }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ $o->dealer_name }}" autofocus required>
                            <label for="dealer_name" class="placeholder">Dealer Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ $o->phone }}" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ $o->address }}" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>
@empty
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <center>
                <h4 class="card-title">No Data Available</h4>
            </center>
        </div>
    </div>
</div>
@endforelse
