<!DOCTYPE html>
<html>
<head>
    <title>Expedition Print</title>
    <style>
        /* Add any necessary styles for printing (optional) */
        body {
            font-family: sans-serif;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>
<body>

<h1>Expeditions</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>...</th> </tr>
    </thead>
    <tbody>
    @foreach ($expeditions as $expedition)
        <tr>
            <td>{{ $expedition->id }}</td>
            <td>{{ $expedition->name }}</td>
            <td>...</td> </tr>
    @endforeach
    </tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
