<table class="table table-bordered table-striped table-primary {{ $table_css or '' }}" id="{{ $table_id or 'datatable' }}">
    @if (isset($caption))
        <caption >{{$caption}}</caption>
    @endif
    <thead>
    <tr>
        @if($action === false)
            <th>#</th>
        @endif
        @foreach($header as $th)
            <th>{{$th}}</th>
        @endforeach
        @if($action !== false)
            <th style="width: 240px; text-align: center;">Azioni</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index_row=>$row)
        <tr>
            @if($action === false)
                <td><input type="radio" value="{{$row->$primaryKey}}" name="id"></td>
            @endif
            @foreach($column as $option=>$name)
                <td>
                    @if (isset($special[$name]))
                        @if ($special[$name][0] == 'concat')
                            @foreach($special[$name][1] as $key)
                                {{ ( $key & 1 )? $key : $row->$key }}
                            @endforeach
                        @elseif ($special[$name][0] == 'relation')
                            @if (isset($row->{$special[$name][1][0]}->{$special[$name][1][1]}))
                                {{ $row->{$special[$name][1][0]}->{$special[$name][1][1]} }}
                            @endif
                        @elseif ($special[$name][0] == 'timestamp')
                            {{ date($special[$name][1], $row->$name) }}
                        @elseif ($special[$name][0] == 'carbon')
                            {{ $row->$name->diffForHumans() }}
                        @elseif ($special[$name][0] == 'match')
                            @if (isset($special[$name][1][$row->$name]))
                                {{ $special[$name][1][$row->$name] }}
                            @else
                                {{ $row->$name }}
                            @endif
                        @elseif ($special[$name][0] == 'anon')
                            {{ $anon($row->$name) }}
                        @endif
                    @else
                        {{ $row->$name }}
                    @endif
                </td>

            @endforeach
            @if($action !== false)
                <td style="text-align: center;" class="action">@include($action)</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>