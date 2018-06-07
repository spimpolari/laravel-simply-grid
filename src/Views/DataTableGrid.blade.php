<table class="table table-bordered table-striped table-primary {{ $table_css or '' }}" id="{{ $table_id or 'datatable' }}">
    @if (isset($caption))
        <caption >{{$caption}}</caption>
    @endif
    <thead>
    <tr>
        @isset($ordering)
            <th></th>
        @endisset
        @empty($buttons)
            @isset($primaryKey)
            <th>#</th>
            @endisset
        @endempty
        @foreach($header as $th)
            <th>{{$th}}</th>
        @endforeach
        @isset($buttons)
            <th style="width: 96px; text-align: right; padding-right: 14px;">Azioni</th>
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
            @isset($ordering)
                <td style="text-align: center; vertical-align: middle; width: 36px;" class="">
                    @if($row->buildSortQuery()->limit(1)->ordered()->first()->{$ordering['orderColumn']} !== $row->{$ordering['orderColumn']})
                    <a href="{{ route($ordering['upRoute'], $row->{$ordering['fieldId']}) }}"><i class="fa fa-arrow-up"></i></a>&nbsp;
                    @endif
                    @if($row->getHighestOrderNumber() !== $row->{$ordering['orderColumn']})
                    <a href="{{ route($ordering['downRoute'], $row->{$ordering['fieldId']}) }}"><i class="fa fa-arrow-down"></i></a>
                    @endif
                </td>
            @endisset
            @empty($buttons)
                @isset($primaryKey)
                <td><input type="radio" value="{{$row->$primaryKey}}" name="id"></td>
                @endisset
            @endempty

            @foreach($fields as $option=>$name)
                <td>
                    @if (isset($customField[$name]))
                        @if ($customField[$name][0] == 'concat')
                            @foreach($customField[$name][1] as $key)
                                {{ ( $key & 1 )? $key : $row->$key }}
                            @endforeach
                        @elseif ($customField[$name][0] == 'relation')
                            @if (isset($row->{$customField[$name][1][0]}->{$customField[$name][1][1]}))
                                {{ $row->{$customField[$name][1][0]}->{$customField[$name][1][1]} }}
                            @endif
                        @elseif ($customField[$name][0] == 'timestamp')
                            {{ date($customField[$name][1], $row->$name) }}
                        @elseif ($customField[$name][0] == 'carbon')
                            {{ $row->$name->diffForHumans() }}
                        @elseif ($customField[$name][0] == 'translate')
                            {{ $row->getTranslation($name, $customField[$name][1]) }}
                        @elseif ($customField[$name][0] == 'match')
                            @if (isset($customField[$name][1][$row->$name]))
                                {{ $customField[$name][1][$row->$name] }}
                            @else
                                {{ $row->$name }}
                            @endif
                        @elseif ($customField[$name][0] == 'anon')
                            {{ $anon[$name]($row) }}
                        @endif
                    @else
                        {{ $row->$name }}
                    @endif
                </td>
            @endforeach

            @if(isset($buttons))
                <td style="text-align: right; vertical-align: middle; width: 96px;" class="action">
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
                @isset($action)
                <td style="text-align: center; vertical-align: middle; width: 96px;" class="action">@include($action)</td>
                @endisset
            @endif

        </tr>
    @endforeach
    </tbody>
</table>