@section('title','Detail Sale Delivery')
@section('page-title','Sale Delivery')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale-delivery.index') }}">Data Sale Delivery</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Detail {{ $saledelivery->sale->frame_no }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('sale-delivery.edit', $saledelivery->id) }}" data-toggle="tooltip" data-placement="top"
                title="Edit" style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $saledelivery->sale->stock->unit->image == '' ? asset('img/nopict.jpg') : asset('img/motorcycle/'.$saledelivery->sale->stock->unit->image.'') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $saledelivery->sale->stock->unit->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label>Delivery Date</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->sale_delivery_date }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Delivery Time</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->delivery_time }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Arrivel Time</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->arrival_time }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->sale->stock->unit->model_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Frame No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{  $saledelivery->sale->frame_no  }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label>Address</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->sale->address }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Phone</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->sale->phone }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Driver</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->mainDriver->name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>PIC</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $saledelivery->backupDriver->name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Status.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{  $saledelivery->status  }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
