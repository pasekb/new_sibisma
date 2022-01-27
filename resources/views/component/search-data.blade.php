@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Search')
@section('page-title','Search')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Data Search</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search "{{ $search }}"</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year MC</th>
                            <th>Dealer</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year MC</th>
                            <th>Dealer</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->model_name }}</td>
                            <td style="background-color: <?php echo $o->color_code ?>50 ;">
                            {{ $o->color_name }}</td>
                            <td>{{ $o->year_mc }}</td>
                            <td>{{ $o->dealer_name }}</td>
                            <td @if($o->qty == 0) style="background-color: maroon; color: #fff;" @endif >{{ $o->qty }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('stock.show', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
