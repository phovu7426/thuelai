<!DOCTYPE html>
<html>
<head>
    <title>Showroom Test</title>
</head>
<body>
    <h1>Showroom Test</h1>
    
    @if(isset($showrooms))
        <ul>
        @foreach($showrooms as $showroom)
            <li>{{ $showroom->name }}</li>
        @endforeach
        </ul>
    @else
        <p>No showrooms found.</p>
    @endif
</body>
</html> 