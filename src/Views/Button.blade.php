<a href="{!! route($button['action'], ['id' => $row->{$button['key']}])!!}" class="btn btn-xs {{ $button['class'] }}"  title="{{ $button['description'] }}">{!! $button['string'] !!}</a>