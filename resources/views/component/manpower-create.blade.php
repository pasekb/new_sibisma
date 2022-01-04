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
<button class="btn btn-success btn-round" id="btnCreate" style="margin-bottom: 20px;"><i class="fa fa-plus"></i>&nbsp;&nbsp; <strong>Add New Manpower</strong> </button>
@endpush

<div class="col-md-12" id="dataCreate" style="display: none;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Manpower</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('manpower.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="dealer_id" name="dealer_id"
                                autofocus required>
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
                            <input id="name" type="text" class="form-control input-border-bottom"
                                name="name" value="{{ old('name') }}" required>
                            <label for="name" class="placeholder">Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ old('address') }}" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ old('phone') }}" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="birthday" type="date" class="form-control input-border-bottom"
                                name="birthday" value="{{ old('birthday') }}" required>
                            <label for="birthday" class="placeholder">Birthday</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="gender" name="gender"
                            required>
                                <option value=""></option>
                                <option value="L">Male</option>
                                <option value="P">Female</option>
                            </select>
                            <label for="gender" class="placeholder">Select Gender</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="join_date" type="date" class="form-control input-border-bottom"
                                name="join_date" value="{{ old('join_date') }}" required>
                            <label for="join_date" class="placeholder">Join Date</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="position" name="position"
                                required>
                                <option value=""></option>
                                <option value="Branch Head">Branch Head</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Sales Counter">Sales Counter</option>
                                <option value="Salesman">Salesman</option>
                                <option value="Service Advisor">Service Advisor</option>
                                <option value="Chief Mechanic">Chief Mechanic</option>
                                <option value="Mechanic">Mechanic</option>
                                <option value="Mechanic Helper">Mechanic Helper</option>
                                <option value="Service Counter">Service Counter</option>
                                <option value="Workshop Head">Workshop Head</option>
                                <option value="Sparepart Counter">Sparepart Counter</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Administration">Administration</option>
                                <option value="Invoice Admin">Invoice Admin</option>
                                <option value="Tax Admin">Tax Admin</option>
                                <option value="Sparepart Admin">Sparepart Admin</option>
                                <option value="Finance">Finance</option>
                                <option value="Accounting">Accounting</option>
                                <option value="CRM">CRM</option>
                                <option value="Warehouse Staff">Warehouse Staff</option>
                                <option value="Driver">Driver</option>
                                <option value="Office Boy">Office Boy</option>
                                <option value="Security">Security</option>
                            </select>
                            <label for="position" class="placeholder">Select Position</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="education" name="education"
                                required>
                                <option value=""></option>
                                <option value="SMA">SMA</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <label for="education" class="placeholder">Select Education</label>
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
