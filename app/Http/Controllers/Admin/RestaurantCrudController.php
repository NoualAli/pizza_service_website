<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Restaurant\StoreRequest;
use App\Http\Requests\Restaurant\UpdateRequest;
use App\Models\RestaurantLocation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class RestaurantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RestaurantCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Restaurant::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/restaurant');
        CRUD::setEntityNameStrings('restaurant', 'restaurants');
    }

    public function setupShowOperation()
    {
        CRUD::column('name');
        CRUD::column('description')->type('textarea');
        CRUD::column('thumbnail')->type('image');
        CRUD::column('slots')->label('Opening hour');
        CRUD::column('minimum_order')->suffix(' €');
        CRUD::column('users')->type('relationship')->attribute('username');
        CRUD::column('locations')->type('relationship');
        CRUD::column('categories')->type('relationship');
        CRUD::column('menus')->type('relationship');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('description')->limit(100);
        CRUD::column('users')->type('relationship_count')->suffix('');
        CRUD::column('categories')->type('relationship_count')->suffix('');
        CRUD::column('categories')->type('relationship_count')->suffix('');
        CRUD::column('menus')->type('relationship_count')->suffix('');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StoreRequest::class);

        // General
        CRUD::field('name')->tab('General');
        CRUD::field('description')->type('textarea')->tab('General');
        CRUD::field('thumbnail')->type('image')->filename(null)->crop(true)->tab('General');

        // Settings
        CRUD::field('minimum_order')->type('number')->prefix('€')->tab('Settings')->attributes(['step' => 'any']);
        CRUD::field('opening')->type('time')->wrapper(DEFAULT_INPUT_CLASS)->tab('Settings');
        CRUD::field('closing')->type('time')->wrapper(DEFAULT_INPUT_CLASS)->tab('Settings');
        CRUD::field('categories')->type('relationship')->tab('Settings');
        CRUD::field('menus')->type('relationship')->tab('Settings');
        CRUD::field('users')->type('relationship')->default(backpack_user())->tab('Settings');

        // Location
        CRUD::field('address')->type('address_algolia')->tab('location');
        CRUD::field('longitude')->type('number')->tab('location')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('latitude')->type('number')->tab('location')->wrapper(DEFAULT_INPUT_CLASS);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(UpdateRequest::class);

        // General
        CRUD::field('name')->tab('General');
        CRUD::field('description')->type('textarea')->tab('General');
        CRUD::field('thumbnail')->type('image')->filename(null)->crop(true)->tab('General');

        // Settings
        CRUD::field('minimum_order')->type('number')->prefix('€')->tab('Settings')->attributes(['step' => 'any']);
        CRUD::field('opening')->type('time')->wrapper(DEFAULT_INPUT_CLASS)->tab('Settings');
        CRUD::field('closing')->type('time')->wrapper(DEFAULT_INPUT_CLASS)->tab('Settings');
        CRUD::field('categories')->type('relationship')->tab('Settings');
        CRUD::field('menus')->type('relationship')->tab('Settings');
        CRUD::field('users')->type('relationship')->default(backpack_user())->tab('Settings');

        // Location
        CRUD::field('address')->type('address_algolia')->tab('location');
        CRUD::field('longitude')->type('number')->tab('location')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('latitude')->type('number')->tab('location')->wrapper(DEFAULT_INPUT_CLASS);
    }
}