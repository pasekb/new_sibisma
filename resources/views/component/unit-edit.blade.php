@section('title','Edit Unit')
@section('page-title','Unit')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('unit.index') }}">Data Unit</a>
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
                    <h4 class="card-title">Edit Unit {{ $unit->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('unit.update', $unit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ $unit->model_name }}" autofocus required>
                            <label for="model_name" class="placeholder">Model Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="category" name="category"
                                required>
                                <option value=""></option>
                                <option value="Moped">Moped</option>
                                <option value="Matic">Matic</option>
                                <option value="Maxi">Maxi</option>
                                <option value="Sport">Sport</option>
                                <option value="Naked Bike">Naked Bike</option>
                                <option value="Off Road">Off Road</option>
                                <option value="CBU">CBU</option>
                            </select>
                            <label for="category" class="placeholder">Select Category</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="color_id" name="color_id"
                                required>
                                <option value=""></option>
                                @foreach($color as $o)
                                <option value="{{ $o->id }}">{{ $o->color_name }}</option>
                                @endforeach
                            </select>
                            <label for="color_id" class="placeholder">Select Color</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="number" class="form-control input-border-bottom"
                                name="year_mc" value="{{ old('year_mc') }}" required>
                            <label for="year_mc" class="placeholder">Year MC</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="price" type="number" class="form-control input-border-bottom"
                                name="price" value="{{ old('price') }}" required>
                            <label for="price" class="placeholder">Price</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="image" type="file" class="form-control input-border-bottom"
                                name="image" value="{{ old('image') }}">
                            <label for="image" class="placeholder">Image (optional)</label>

                            <span class="invalid-feedback">
                                <strong>format required: jpg|jpeg|png</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                    <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                            class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
