<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Restaurant\StoreRequest;
use App\Http\Requests\Restaurant\UpdateRequest;
use App\Models\RestaurantLocation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RestaurantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RestaurantCrudController extends CrudController
{
    use ListOperation, UpdateOperation, DeleteOperation, ShowOperation, InlineCreateOperation, BulkDeleteOperation;
    use CreateOperation {
        store as traitStore;
    }
    use UpdateOperation {
        update as traitUpdate;
    }

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
        CRUD::column('phone');
        CRUD::column('email');
        CRUD::column('address');
        CRUD::column('cover')->type('image');
        CRUD::column('minimum_order')->suffix(' €');
        CRUD::column('delivery_fee')->suffix(' €');
        CRUD::column('delivery_time')->suffix(' mins');
        CRUD::column('discount')->suffix(' %');
        CRUD::column('users')->type('relationship')->attribute('username');
        CRUD::column('categories')->type('relationship');
        CRUD::column('menus')->type('relationship');
        CRUD::column('time_slots')->label('Time slots')->type('table')->columns([
            'week_day' => 'Week day',
            'opening' => 'Opening',
            'closing' => 'Closing',
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('line', 'create_product_from_restaurant', 'create_product', 'beginning');
        CRUD::column('name');
        CRUD::column('phone');
        CRUD::column('email');
        CRUD::column('users')->type('relationship_count')->suffix('');
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
        CRUD::field('name')->tab('General')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('slug')->type('slug')->tab('General')->target('name')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('email')->type('email')->tab('General')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('phone')->tab('General')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('cover')->type('image')->filename(null)->crop(true)->tab('General');

        // Settings
        CRUD::field('minimum_order')->type('number')->prefix('€')->tab('Settings')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('delivery_time')->type('number')->tab('Settings')->wrapper(DEFAULT_INPUT_CLASS)->suffix('mins');
        CRUD::field('categories')->type('relationship')->tab('Settings');
        CRUD::field('menus')->type('relationship')->tab('Settings');
        CRUD::field('users')->type('relationship')->default(backpack_user())->tab('Settings');

        // Location
        CRUD::field('address')->type('address_algolia')->tab('location');
        CRUD::field('longitude')->type('number')->tab('location')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('latitude')->type('number')->tab('location')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);

        // Time slots
        CRUD::field('time_slots')->label('')->type('repeatable')->reorder(false)->min_rows(7)->max_rows(7)->subfields([
            [
                'name' => 'week_day',
                'label' => 'Week day',
                'type' => 'select_from_array',
                'wrapper' => WRAPPER_4_COL,
                'options' => [
                    'Monday' => 'Monday',
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    'Saturday' => 'Saturday',
                    'Sunday' => 'Sunday',
                ]
            ],
            [
                'name' => 'opening',
                'label' => 'Opening',
                'type' => 'time',
                'wrapper' => WRAPPER_4_COL
            ],
            [
                'name' => 'closing',
                'label' => 'Closing',
                'type' => 'time',
                'wrapper' => WRAPPER_4_COL
            ]
        ])->tab('Time slots');

        // Order
        CRUD::field('discount')->type('number')->prefix('%')->tab('Order settings')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('delivery_fee')->type('number')->prefix('€')->tab('Order settings')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('order_types[Delivery]')->type('checkbox')->label('Delivery')->tab('Order settings');
        CRUD::field('order_types[Pickup]')->type('checkbox')->label('Pickup')->tab('Order settings');
        CRUD::field('order_types[On the spot]')->type('checkbox')->label('On the spot')->tab('Order settings');
        // CRUD::field('order_types')->label('')->type('repeatable')->reorder(false)->min_rows(1)->max_rows(1)->subfields([
        //     [
        //         'name' => 'Delivery',
        //         'label' => 'Delivery',
        //         'type' => 'checkbox',
        //         'value' => 0
        //     ],
        //     [
        //         'name' => 'Pickup',
        //         'label' => 'Pickup',
        //         'type' => 'checkbox',
        //         'value' => 0
        //     ],
        //     [
        //         'name' => 'On the spot',
        //         'label' => 'On the spot',
        //         'type' => 'checkbox',
        //         'value' => 0
        //     ],

        // ])->tab('Order settings');
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
        CRUD::field('name')->tab('General')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('slug')->type('slug')->tab('General')->target('name')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('email')->type('email')->tab('General')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('phone')->tab('General')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('cover')->type('image')->filename(null)->crop(true)->tab('General');

        // Settings
        CRUD::field('minimum_order')->type('number')->prefix('€')->tab('Settings')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('delivery_time')->type('number')->tab('Settings')->suffix('mins')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('categories')->type('relationship')->tab('Settings')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('menus')->type('relationship')->tab('Settings')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('users')->type('relationship')->default(backpack_user())->tab('Settings');

        // Location
        CRUD::field('address')->type('address_algolia')->tab('location');
        CRUD::field('longitude')->type('number')->attributes(['step' => 'any'])->tab('location')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('latitude')->type('number')->attributes(['step' => 'any'])->tab('location')->wrapper(DEFAULT_INPUT_CLASS);

        // Time slots
        CRUD::field('time_slots')->label('')->type('repeatable')->reorder(false)->min_rows(7)->max_rows(7)->subfields([
            [
                'name' => 'week_day',
                'label' => 'Week day',
                'type' => 'select_from_array',
                'wrapper' => WRAPPER_4_COL,
                'options' => [
                    'Monday' => 'Monday',
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    'Saturday' => 'Saturday',
                    'Sunday' => 'Sunday',
                ]
            ],
            [
                'name' => 'opening',
                'label' => 'Opening',
                'type' => 'time',
                'wrapper' => WRAPPER_4_COL
            ],
            [
                'name' => 'closing',
                'label' => 'Closing',
                'type' => 'time',
                'wrapper' => WRAPPER_4_COL
            ],
        ])->tab('Time slots');

        // Order
        CRUD::field('discount')->type('number')->prefix('%')->tab('Order settings')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('delivery_fee')->type('number')->prefix('€')->tab('Order settings')->attributes(['step' => 'any'])->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('order_types[Delivery]')->type('checkbox')->label('Delivery')->tab('Order settings');
        CRUD::field('order_types[Pickup]')->type('checkbox')->label('Pickup')->tab('Order settings');
        CRUD::field('order_types[On the spot]')->type('checkbox')->label('On the spot')->tab('Order settings');
    }
}