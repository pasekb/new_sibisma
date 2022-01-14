<table>
    <thead>
        <tr>
            <th>Model Name</th>
            <th>Color</th>
            <th>Year</th>
            <th>Sender</th>
            <th>Qty</th>
            <th>Created By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->stock->unit->model_name }}</td>
            <td style="background-color: <?php echo $o->stock->unit->color->color_code ?>50 ;">
                {{ $o->stock->unit->color->color_name }}
            </td>
            <td>{{ $o->stock->unit->year_mc }}</td>
            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->in_qty }}</td>
            <td>{{ $o->createdBy->first_name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
