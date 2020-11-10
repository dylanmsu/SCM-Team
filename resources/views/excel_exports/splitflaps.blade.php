<table>
    <thead>
    <tr>
        <th><b>Id</b></th>
        <th><b>Bord</b></th>
        <th><b>Uitlijnen</b></th>
        <th><b>Text</b></th>
        <th><b>Icoon index</b></th>
        <th><b>Vertrekt op</b></th>
        <th><b>Gemaakt door</b></th>
        <th><b>Gemaakt op</b></th>
        <th><b>Bijwerkt op</b></th>
    </tr>
    </thead>
    <tbody>
        <!-- refer to App/Exports/SplitflapExport.php -->
        @foreach($splitflaps as $splitflap)
            <tr>
                <td>{{ $splitflap->id }}</td>
                <td>{{ $splitflap->board }}</td>
                <td>{{ $splitflap->align }}</td>
                <td>{{ $splitflap->first_text }} {{ $splitflap->second_text }}</td>
                @switch($splitflap->icon_index)
                    @case(1)
                        <td>IC</td>
                        @break
                    @case(2)
                        <td>IR</td>
                        @break
                    @case(3)
                        <td>L</td>
                        @break
                    @case(4)
                        <td>P</td>
                        @break
                    @case(5)
                        <td>EXT</td>
                        @break
                    @case(6)
                        <td style="color: red">INT</td>
                        @break
                    @case(7)
                        <td>T</td>
                        @break
                    @case(8)
                        <td>STOOM</td>
                        @break
                    @case(9)
                        <td>DIESEL</td>
                        @break
                    @case(10)
                        <td>MOTORWAGEN</td>
                        @break
                    @case(11)
                        <td>GROEP</td>
                        @break
                    @case(12)
                        <td style="color: red">SINT</td>
                        @break
                    @case(13)
                        <td>EVENT</td>
                        @break
                    @case(14)
                        <td>DINING</td>
                        @break
                    @case(15)
                        <td style="color: red">DIENST</td>
                        @break
                    @default
                        <td>[blank]</td>
                @endswitch
                <td>{{ $splitflap->time }}</td>
                <td>{{ $splitflap->User->username }}</td>
                <td>{{ $splitflap->created_at }}</td>
                <td>{{ $splitflap->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>