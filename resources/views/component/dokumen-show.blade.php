@section('title','Detail Dokumen')
@section('page-title','Dokumen')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('document.index') }}">Data Dokumen {{$document->sale->customer_name}}</a>
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
                    <h4 class="card-title">Detail </h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('document.edit', $document->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
                style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
                   
            <form action="{{ route('document.update', $document->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Customer Name</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $document->sale->customer_name }}</p>
                        </div>

                        <div class="form-group form-group-default">
                            <label>Customer Name</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $document->sale->customer_name }}</p>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>