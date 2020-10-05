<!DOCTYPE html>
<html>
<head>
    <style>
        td {
            border: 2px solid #000000;
        }
    </style>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th><b>Id</b></th>
            <th><b>Categorie</b></th>
            <th><b>Naam</b></th>
            <th><b>Status</b></th>
            <th><b>Spoor</b></th>
            <th><b>Gemaakt op</b></th>
            <th><b>Bijwerkt op</b></th>
            <th><b>---------------</b></th>
            <th><b>gebruikersnaam</b></th>
            <th><b>Commentaar</b></th>
        </tr>
        </thead>
        <tbody>
            <!-- refer to App/Exports/VehicleExport.php -->
            @foreach($vehicles as $vehicle)
                <tr>
                    <!-- vehicle id -->
                    <td>{{ $vehicle->id }}</td>
    
                    <!-- vehicle category -->
                    <td>{{ $vehicle->category }}</td>
    
                    <!-- vehicle name -->
                    <td>{{ $vehicle->name }}</td>
    
                    <!-- vehicle state -->
                    @switch($vehicle->state)
                        @case('in_dienst')
                            <td style="background-color: #90ee90; border: 2px solid #d3d3d3;">{{ $vehicle->state }}</td>
                            @break
                        @case('buiten_dienst')
                            <td style="background-color: #fa8072; border: 2px solid #d3d3d3;">{{ $vehicle->state }}</td>
                            @break
                        @case('onder_voorwaarde')
                            <td style="background-color: #ffd549; border: 2px solid #d3d3d3;">{{ $vehicle->state }}</td>
                            @break
                        @default
                            <td>{{ $vehicle->state }}</td>
                    @endswitch
    
                    <!-- vehicle type -->
                    <td>{{ $vehicle->type }}</td>
    
                    <!-- dates -->
                    <td>{{ $vehicle->created_at }}</td>
                    <td>{{ $vehicle->updated_at }}</td>
    
                    <!-- loop through comments and select the last one -->
                    @forelse ($vehicle->vehicle_comment as $comment)
                        @if($loop->last)

                            <td>{{$comment->user->username}}</td>
                            <td>{{ $comment->remarks }}</td>
                            
                        @endif
                    @empty
                        <td>/</td>
                        <td>Geen commentaar</td>
                    @endforelse
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>