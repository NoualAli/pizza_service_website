<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\EchoTrait;
use App\Http\Controllers\Admin\Operations\BrowserPrintOperation;
use App\Models\Restaurant;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, ShowOperation, BrowserPrintOperation, EchoTrait;

    private $role;
    private $restaurants;
    private $restaurantsIds;
    private $restaurantsFilter;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {

        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.custom_prefixes.ps') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');
        $this->configureOrders();
        $this->crud->operation(['list', 'show'], function () {
            $this->data['widgets']['before_content'] = [
                [
                    'type' => 'iframe',
                ],
            ];
        });
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->setupButtons();
        $this->crud->enableExportButtons();
        $this->subscribeEchoPsChannel();
        // $this->crud->addClause('whereIn', 'restaurant_id', $this->restaurantsIds);

        // $this->crud->orderBy('created_at', 'desc');
        // Columns
        CRUD::column('id')->label('#');
        CRUD::column('state');
        CRUD::column('restaurant');
        if ($this->role !== 'user') {
            CRUD::column('full_name')->label('Client');
        }
        CRUD::column('order_type');
        CRUD::column('payment_method');
        CRUD::column('subtotal');
        CRUD::column('total');
        CRUD::column('lines')->type('relationship_count')->suffix('');
        CRUD::column('created_at')->label('Date')->type('datetime');

        $this->setupFilters();
    }

    protected function setupShowOperation()
    {
        $order = $this->crud->getEntry(request()->id);
        $this->setupButtons();

        $this->subscribeEchoPsChannel();

        CRUD::column('id')->label('#');
        CRUD::column('state');
        CRUD::column('order_type');
        CRUD::column('payment_method');
        CRUD::column('restaurant');
        CRUD::column('full_name')->label('Client');
        CRUD::column('phone')->type('phone');
        CRUD::column('email')->type('email');

        if ($order->order_type == 'Delivery') {
            CRUD::column('address')->label('Address')->type('textarea');
            // CRUD::column('appartment_number')->label('Apprtment number');
        }

        CRUD::column('subtotal');
        CRUD::column('tax')->label('VAT tax');
        CRUD::column('total');
        CRUD::column('lines')->type('relationship_count')->suffix('');
        CRUD::column('created_at')->label('Date')->type('datetime');

        Widget::add([
            'type'          => 'nldev_relation_table',
            'name'           => 'lines',
            'label'          => 'Order details',
            'backpack_crud'  => 'order-lines',
            'relation_attribute' => 'order_id',
            'button_create' => false,
            'buttons' => false,
            'columns' => [
                [
                    'label' => 'Product',
                    'name' => 'product.name'
                ],
                [
                    'label' => 'Quantity',
                    'name' => 'quantity',
                    'type' => 'number'
                ],
                [
                    'label' => 'Size',
                    'name' => 'size'
                ],
                [
                    'label' => 'Extras',
                    'name' => 'extra_str'
                ],
                [
                    'label' => 'Additional informations',
                    'name' => 'additional_informations',
                    'type' => 'textarea',
                ],
                [
                    'label' => 'Total',
                    'name' => 'price',
                ],
            ],
        ])->to('after_content');
    }

    private function configureOrders()
    {
        $this->role = backpack_user()->roles->pluck('name')->toArray()[0];
        if ($this->role == 'user') {
            $this->crud->addClause('where', 'user_id', backpack_user()->id);
            // $this->restaurants =
        } else {
            if ($this->role == 'restorer') {
                $this->restaurants = backpack_user()->restaurants;
                $this->restaurantsIds = $this->restaurants->pluck('id')->toArray();
                $this->restaurantsFilter = $this->restaurants->pluck('name', 'id')->toArray();
            } else {
                $this->restaurants = Restaurant::has('orders')->get();
                $this->restaurantsIds = $this->restaurants->pluck('id')->toArray();
                $this->restaurantsFilter = $this->restaurants->pluck('name', 'id')->toArray();
            }
            $this->crud->addClause('whereIn', 'restaurant_id', $this->restaurantsIds);
        }
        $this->crud->orderBy('created_at', 'desc');
    }

    private function setupButtons()
    {
        $this->crud->addButtonFromModelFunction('line', 'deliver_order', 'deliver', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'accept_order', 'accept', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'deny_order', 'deny', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'reset_order', 'reset', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'ready_order', 'ready', 'beginning');
        $this->crud->removeButton('create');
        $this->crud->removeButton('update');
        // $this->crud->removeButton('print');
        if ($this->role == 'user') {
            $this->crud->removeButton('delete');
            $this->crud->removeButton('deliver_order');
            $this->crud->removeButton('accept_order');
            $this->crud->removeButton('deny_order');
            $this->crud->removeButton('ready_order');
            $this->crud->removeButton('reset_order');
        }
    }

    private function setupFilters()
    {
        // Filters
        $this->crud->addFilter([
            'name' => 'state',
            'type' => 'dropdown',
            'label' => 'state'
        ], fn () => [
            'pending' => 'pending',
            'accepted' => 'accepted',
            'denied' => 'denied',
            'delivered' => 'delivered'
        ]);

        $this->crud->addFilter([
            'name' => 'order_type',
            'type' => 'dropdown',
            'label' => 'Order type'
        ], fn () => [
            'on-the-spot' => 'On the spot',
            'pickup' => 'Pickup',
            'delivery' => 'Delivery',
        ]);

        if ($this->restaurants?->count() > 1) {
            $this->crud->addFilter([
                'name' => 'restaurant_id',
                'type' => 'dropdown',
                'label' => 'Restaurant'
            ], fn () => $this->restaurantsFilter);
        }
    }
}