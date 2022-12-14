<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\RestoreOperation;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as ControllersUserCrudController;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends ControllersUserCrudController
{
    use ListOperation, CreateOperation, UpdateOperation, ShowOperation, RestoreOperation, DeleteOperation {
        destroy as traitDestroiy;
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $userRole = auth()->user()->roles->pluck('name')->toArray();
        abort_if(!in_array('root', $userRole) && !in_array('admin', $userRole), 403);

        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name'  => 'username',
                'label' => ucfirst(strtolower(__('username'))),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.role'), // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entity'    => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.role'), // foreign key model
            ],
            [
                'name'  => 'created_at',
                'label' => 'Created at',
                'type'  => 'date',
                'format' => 'Y-MM-DD HH:mm'
            ]
        ]);

        // Role Filter
        $this->crud->addFilter(
            [
                'name'  => 'role',
                'type'  => 'dropdown',
                'label' => trans('backpack::permissionmanager.role'),
            ],
            config('permission.models.role')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'roles', function ($query) use ($value) {
                    $query->where('role_id', '=', $value);
                });
            }
        );
        $this->crud->addFilter(
            [
                'type'  => 'simple',
                'name'  => 'trashed',
                'label' => 'Trashed'
            ],
            false,
            function ($values) { // if the filter is active
                $this->crud->query = $this->crud->query->onlyTrashed();
            }
        );
    }

    public function setupShowOperation()
    {
        $this->crud->addColumns([
            [
                'name'  => 'username',
                'label' => ucfirst(strtolower(__('username'))),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [
                'name'  => 'phone',
                'label' => ucfirst(strtolower(__('phone'))),
                'type'  => 'text',
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.role'), // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entity'    => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.role'), // foreign key model
            ],
            [
                'name'  => 'created_at',
                'label' => 'Created at',
                'type'  => 'date',
                'format' => 'Y-MM-DD HH:mm'
            ],
            [
                'name'  => 'updated_at',
                'label' => 'Last modification',
                'type'  => 'date',
                'format' => 'Y-MM-DD HH:mm'
            ]
        ]);
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitStore();
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitUpdate();
    }

    /**
     * Handle password input fields.
     */
    protected function handlePasswordInput($request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');
        $request->request->remove('roles_show');
        $request->request->remove('permissions_show');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }
        // dd($request->password);
        return $request;
    }

    protected function addUserFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'username',
                'label' => ucfirst(strtolower(__('username'))),
                'type'  => 'text',
                'wrapper' => DEFAULT_INPUT_CLASS
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
                'wrapper' => DEFAULT_INPUT_CLASS
            ],
            [
                'name'  => 'phone',
                'label' => ucfirst(strtolower(__('phone'))),
                'type'  => 'text',
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::permissionmanager.password'),
                'type'  => 'password',
                'wrapper' => DEFAULT_INPUT_CLASS
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::permissionmanager.password_confirmation'),
                'type'  => 'password',
                'wrapper' => DEFAULT_INPUT_CLASS
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
                'type'      => 'checklist',
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entity'    => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.role'), // foreign key model
            ],
        ]);
    }

    public function setupCreateOperation()
    {
        $this->addUserFields();
        $this->crud->setValidation(StoreRequest::class);
    }

    public function setupUpdateOperation()
    {
        $this->addUserFields();
        $this->crud->setValidation(UpdateRequest::class);
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        $item = $this->crud->model->withTrashed()->findOrFail($id);
        if ($item->deleted_at) {
            return $item->forceDelete();
        }
        return $item->delete();
    }
}