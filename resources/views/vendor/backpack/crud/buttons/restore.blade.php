@if ($entry->deleted_at)
    <a href="{{ url($crud->route . '/' . $entry->getKey() . '/restore') }}" class="btn btn-sm btn-link">
        <i class="la la-undo-alt"></i>
        {{ trans('Restore') }}
    </a>
@endif
