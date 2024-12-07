<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $report->type }} Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-info {
            margin-bottom: 20px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ ucfirst($report->type) }} Report</h1>
    </div>

    <div class="report-info">
        <p><strong>Generated Date:</strong> {{ $report->created_at->format('Y-m-d H:i:s') }}</p>
        <p><strong>Period:</strong> {{ $report->period_start }} to {{ $report->period_end }}</p>
        <p><strong>Farm:</strong> {{ $report->farm->name }}</p>
    </div>

    <div class="report-data">
        @if($report->type === 'stock')
            @include('reports.partials.stock-table')
        @elseif($report->type === 'activity')
            @include('reports.partials.activity-table')
        @endif
    </div>
</body>
</html> 