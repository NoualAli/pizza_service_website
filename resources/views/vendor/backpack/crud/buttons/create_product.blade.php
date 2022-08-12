@if ($crud->hasAccess('update'))
    <a href="{{ url('admin/product/create/?menu=' . $entry->getKey() . '') }} " class="btn btn-sm btn-link">
        <i class="las la-boxes"></i>
        add products
    </a>
@endif
