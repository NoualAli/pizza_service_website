<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, ShowOperation, BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->removeButton('create');
        CRUD::column('name');
        CRUD::column('restaurant');
        CRUD::column('menu');
        CRUD::column('price_norm')->suffix(' €');
        CRUD::column('updated_at');
    }

    protected function setupShowOperation()
    {
        CRUD::column('name');
        CRUD::column('thumbnail')->type('image');
        CRUD::column('restaurant');
        CRUD::column('price_norm')->suffix(' €');
        CRUD::column('price_perhe')->suffix(' €');
        CRUD::column('price_pannu')->suffix(' €');
        CRUD::column('menu');
        CRUD::column('recipe')->label('Recipe')->attribute('name');
        // CRUD::column('extra')->label('Extra')->attribute('name');
        CRUD::column('created_at');
        CRUD::column('updated_at');
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
        $menu_id = request()->has('menu') ? request()->menu : null;
        $restaurant_id = request()->has('restaurant') ? request()->restaurant : null;

        CRUD::field('restaurant')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS)->default($restaurant_id);
        CRUD::field('menu')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS)->default($menu_id);
        CRUD::field('name');
        CRUD::field('description')->type('textarea');
        CRUD::field('price_norm')->type('number')->wrapper(WRAPPER_4_COL)->prefix('€')->attributes(['step' => 'any']);
        CRUD::field('price_perhe')->type('number')->wrapper(WRAPPER_4_COL)->prefix('€')->attributes(['step' => 'any']);
        CRUD::field('price_pannu')->type('number')->wrapper(WRAPPER_4_COL)->prefix('€')->attributes(['step' => 'any']);
        CRUD::field('ingredients')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('extras')->label('Extras')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS);
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

        CRUD::field('restaurant')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('menu')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('name');
        CRUD::field('description');
        CRUD::field('price_norm')->type('number')->wrapper(WRAPPER_4_COL)->prefix('€')->attributes(['step' => 'any']);
        CRUD::field('price_perhe')->type('number')->wrapper(WRAPPER_4_COL)->prefix('€')->attributes(['step' => 'any']);
        CRUD::field('price_pannu')->type('number')->wrapper(WRAPPER_4_COL)->prefix('€')->attributes(['step' => 'any']);
        CRUD::field('ingredients')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS);
        CRUD::field('extras')->label('Extras')->type('relationship')->wrapper(DEFAULT_INPUT_CLASS);
    }
}