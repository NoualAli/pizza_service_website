<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

trait RestoreOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupRestoreRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/restore', [
            'as'        => $routeName . '.restore',
            'uses'      => $controller . '@restore',
            'operation' => 'restore',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupRestoreDefaults()
    {
        $this->crud->allowAccess('restore');

        $this->crud->operation('restore', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'restore', 'view', 'crud::buttons.restore');
            $this->crud->addButton('line', 'restore', 'view', 'crud::buttons.restore');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function restore()
    {
        $this->crud->hasAccessOrFail('restore');
        if ($this->crud->model->withTrashed()->findOrFail(request()->id)->restore()) {
            Alert::success(trans('Item restored succesfully'))->flash();
        } else {
            Alert::error(trans('Error when trying to restore item'))->flash();
        }

        return redirect()->back();
    }
}