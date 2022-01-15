<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Sale Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Customer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Phone</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Qty</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Created By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->stock->dealer->dealer_code }}</td>
            <td>{{ $o->stock->dealer->dealer_name }}</td>
            <td>{{ $o->sale_date }}</td>
            <td>{{ $o->stock->unit->model_name }}</td>
            <td>{{ $o->frame_no }}</td>
            <td>{{ $o->engine_no }}</td>
            <td>{{ $o->stock->unit->color->color_name }}</td>
            <td>{{ $o->stock->unit->year_mc }}</td>
            <td>{{ $o->customer_name }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ $o->address }}</td>
            <td>{{ $o->sale_qty }}</td>
            <td>{{ $o->createdBy->first_name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="13" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
