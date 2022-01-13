@section('title','Edit Dokumen')
@section('page-title','Dokumen')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('document.index') }}">Data Dokumen</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit Dokumen {{ $document->sale->customer_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('document.update', $document->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="nik" type="text" class="form-control input-border-bottom"
                                name="nik" value="{{ $document->sale->nik }}" autofocus required>
                            <label for="nik" class="placeholder">NIK</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="customer_name" type="text" class="form-control input-border-bottom"
                                name="customer_name" value="{{ $document->sale->customer_name }}" autofocus required>
                            <label for="customer_name" class="placeholder">Customer Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ $document->sale->phone }}" autofocus required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ $document->sale->address }}" autofocus required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom"
                                name="frame_no" value="{{ $document->sale->frame_no }}" autofocus required>
                            <label for="frame_no" class="placeholder">Frame Number</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="engine_no" type="text" class="form-control input-border-bottom"
                                name="engine_no" value="{{ $document->sale->engine_no }}" autofocus required>
                            <label for="engine_no" class="placeholder">Engine Number</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="leasing" type="text" class="form-control input-border-bottom"
                                name="leasing" value="{{ $document->sale->leasing->leasing_name }}" autofocus required>
                            <label for="leasing" class="placeholder">Engine Number</label>
                        </div>
                    </div>
                </div>

                    <hr>

                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="form-group form-floating-label">
                                <input id="stck" type="text" class="form-control input-border-bottom"
                                    name="stck" value="{{ $document->stck }}" autofocus required>
                                <label for="stck" class="placeholder">STCK</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group form-floating-label">
                                <label for="stck_status">STCK status</label>
                                <input id="stck_status" type="text" class="form-control input-border-bottom"
                                    name="stck_status" value="{{ $document->stck_status }}" autofocus required readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin: 10px 10px;">
                        <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                        <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                        class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                    </div>
                    
                </div>
                
            </form>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#btnImage').on('click', function () {
        $('#formImage').css('display', 'block');
        $('#formImage').addClass('fadeInBawah');
    });
</script>
@endpush
