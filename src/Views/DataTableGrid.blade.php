<table class="table table-bordered table-striped table-primary {{ $table_css or '' }}" id="{{ $table_id or 'datatable' }}">
    @if (isset($caption))
        <caption >{{$caption}}</caption>
    @endif
    <thead>
    <tr>
        @empty($buttons)
            <th>#</th>
        @endempty
        @foreach($header as $th)
            <th>{{$th}}</th>
        @endforeach
        @isset($buttons)
            <th style="width: 100px; text-align: center;">Azioni</th>
        @endisset
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index_row=>$row)
        @if(isset($customRow))
            <tr {!! $customRow($row) !!}>
        @else
        <tr>
        @endif
            @empty($buttons)
                <td><input type="radio" value="{{$row->$primaryKey}}" name="id"></td>
            @endempty

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
                            {{ $anon($row) }}
                        @endif
                    @else
                        {{ $row->$name }}
                    @endif
                </td>
            @endforeach

            @if(isset($buttons))
                <td style="text-align: center;" class="action">
                @foreach($buttons as $button)
                    @if(isset($customAction))
                        @if($customAction($button, $row))
                            @include('SimplyGrid::Button')
                        @endif
                    @else
                        @include('SimplyGrid::Button')
                    @endif
                @endforeach
                </td>
            @else
                <td style="text-align: center;" class="action">@include($action)</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>