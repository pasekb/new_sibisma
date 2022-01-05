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

@section('title','Edit Manpower')
@section('page-title','Manpower')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('manpower.index') }}">Data Manpower</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit {{ $manpower->name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('manpower.update', $manpower->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="dealer_id" name="dealer_id" autofocus
                                required>
                                <option value="{{ $manpower->dealer_id }}">{{ $manpower->dealer->dealer_name }}</option>
                                <option>Select Dealer</option>
                                @foreach($dealer as $o)
                                <option value="{{ $o->id }}">{{ $o->dealer_name }}</option>
                                @endforeach
                            </select>
                            <label for="dealer_id" class="placeholder">Dealer Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="name" type="text" class="form-control input-border-bottom" name="name"
                                value="{{ $manpower->name }}" required>
                            <label for="name" class="placeholder">Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ $manpower->address }}" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                value="{{ $manpower->phone }}" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="birthday" type="date" class="form-control input-border-bottom" name="birthday"
                                value="{{ $manpower->birthday }}" required>
                            <label for="birthday" class="placeholder">Birthday</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="gender" name="gender" required>
                                <option value="{{ $manpower->gender }}">
                                    {{ $manpower->gender == 'L' ? 'Male' : 'Female' }}</option>
                                <option>Select Gender</option>
                                <option value="L">Male</option>
                                <option value="P">Female</option>
                            </select>
                            <label for="gender" class="placeholder">Gender</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="join_date" type="date" class="form-control input-border-bottom" name="join_date"
                                value="{{ $manpower->join_date }}" required>
                            <label for="join_date" class="placeholder">Join Date</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="position" name="position" required>
                                <option value="{{ $manpower->position }}">{{ $manpower->position }}</option>
                                <option>Select Position</option>
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
                            <label for="position" class="placeholder">Position</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="education" name="education" required>
                                <option value="{{ $manpower->education }}">{{ $manpower->education }}</option>
                                <option>Select Education</option>
                                <option value="SMA">SMA</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <label for="education" class="placeholder">Education</label>
                        </div>
                    </div>

                    <div class="col-md-4" id="statusManpower">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="status" name="status" required>
                                <option value="{{ $manpower->status }}">{{ ucfirst($manpower->status) }}</option>
                                <option disabled>Select Status</option>
                                <option value="active">Active</option>
                                <option value="mutation">Mutation</option>
                                <option value="resign">Resign</option>
                            </select>
                            <label for="status" class="placeholder">Select Status</label>
                        </div>
                    </div>

                    <div class="col-md-2" style="display: none;" id="resignDate">
                        <div class="form-group form-floating-label">
                            <input id="resign_date" type="date" class="form-control input-border-bottom" name="resign_date"
                                value="{{ $manpower->resign_date }}">
                            <label for="resign_date" class="placeholder">Resign Date</label>

                            <span class="invalid-feedback">
                                <strong><span id="error-msg"></span></strong>
                            </span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@push('after-script')
    <script>
        // Show input resign date when status is resign
        $(document).ready(function(){
            $('#statusManpower').on('change', function(){
                let status = $('#statusManpower select').val();
                if (status == 'resign') {
                    $('#statusManpower').removeClass('col-md-4');
                    $('#statusManpower').addClass('col-md-2');
                    $('#resignDate').addClass('fadeInKanan');
                    $('#resignDate').css('display','block');
                }else{
                    $('#statusManpower').removeClass();
                    $('#statusManpower').addClass('col-md-4');
                    $('#resignDate').css('display','none');
                }
            });
        });

        // Form validation for resign date
        $(document).ready(function(){
            $('form').submit(function(e){
                let status = $('#statusManpower select').val();
                let resignDate = $('#resign_date').val();

                if (status == 'resign' && resignDate == '') {
                    e.preventDefault();
                    $('#resign_date').addClass('is-invalid');
                    $('#error-msg').text('field required');
                } else if (status != 'resign') {
                    $('#resign_date').val('');
                    $('form').submit();
                } else {
                    $('form').submit();
                }
            });
        });

        $(document).ready(function(){
            let status = $('#statusManpower select').val();
            if (status == 'resign') {
                $('#statusManpower').removeClass('col-md-4');
                $('#statusManpower').addClass('col-md-2');
                $('#resignDate').addClass('fadeInKanan');
                $('#resignDate').css('display','block');
            }
        });
    </script>
@endpush
