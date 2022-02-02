<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Qty</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Opname</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Difference</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Updated By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->opname_date }}</td>
            <td>{{ $o->stock->unit->model_name }}</td>
            <td>{{ $o->stock->unit->color->color_name }}</td>
            <td>{{ $o->stock->unit->year_mc }}</td>
            <td>{{ $o->stock_system }}</td>
            <td>{{ $o->stock_opname }}</td>
            <td>{{ $o->difference }}</td>
            <td>{{ $o->updatedBy->first_name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
