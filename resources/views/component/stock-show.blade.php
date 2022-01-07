@section('title','Detail Stock')
@section('page-title','Stock')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('stock.index') }}">Data Stock</a>
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
        <span style="background-color: <?php echo $stock->unit->color->color_code ?>;
        width: 10px; height: 50%; 
        display: inline-block;
        position: absolute;
        left: 0px;
        top: 0px;"></span>
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Detail {{ $stock->unit->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $stock->unit->image == '' ? asset('img/nopict.jpg') : asset('img/motorcycle/'.$stock->unit->image.'') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <input type="hidden" value="{{ $stock->unit->image }}" name="img_prev">
                            <p class="card-category text-info mb-1"><a href="#">File name :
                                    {{ $stock->unit->image == '' ? 'No image available' : $stock->unit->image }}</a></p>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $stock->unit->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row row-card-no-pd mt--2">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-motorcycle" style="color: <?php echo $stock->unit->color->color_code ?>;"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Stocks</p>
                                                <h4 class="card-title">{{ $stock->qty }} Unit(s)</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-coins text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Revenue</p>
                                                <h4 class="card-title">$ 1,345</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $stock->unit->model_name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Category</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $stock->unit->category }}
                        </p>
                    </div>

                    <div class="form-group form-group-default" style="background-color: <?php echo $stock->unit->color->color_code ?>50;">
                        <label>Color</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $stock->unit->color->color_name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Year MC</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $stock->unit->year_mc }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Price</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">Rp
                            {{  number_format($stock->unit->price, 0, ',','.')  }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
