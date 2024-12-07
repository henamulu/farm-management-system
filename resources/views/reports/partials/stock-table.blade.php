<table class="data-table">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Category</th>
            <th>Current Quantity</th>
            <th>Unit</th>
            <th>Minimum Threshold</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($report->data['stocks'] as $stock)
            <tr>
                <td>{{ $stock['item_name'] }}</td>
                <td>{{ $stock['category'] }}</td>
                <td>{{ $stock['quantity'] }}</td>
                <td>{{ $stock['unit'] }}</td>
                <td>{{ $stock['minimum_threshold'] }}</td>
                <td>
                    @if($stock['quantity'] <= $stock['minimum_threshold'])
                        <span style="color: red;">Low Stock</span>
                    @else
                        <span style="color: green;">Adequate</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table> 