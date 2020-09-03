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
                <!-- Cell with black background -->
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->category }}</td>
                <td>{{ $vehicle->name }}</td>
                <td>{{ $vehicle->state }}</td>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->created_at }}</td>
                <td>{{ $vehicle->updated_at }}</td>
                <td></td>

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