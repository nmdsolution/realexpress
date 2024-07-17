<!DOCTYPE html>
<html>
<head>
    <title>IDs by Date Range</title>
</head>
<body>
<h1>IDs by Date Range</h1>
<p>Start Date: {{ $startDate->toDateString() }}</p>
<p>End Date: {{ $endDate->toDateString() }}</p>
<ul>
    @foreach ($expeditions as $expedition)
        <li>{{ $expedition->id }}</li>
    @endforeach
</ul>
</body>
</html>
