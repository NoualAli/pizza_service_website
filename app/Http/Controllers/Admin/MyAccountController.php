<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Account\AccountAddressRequest;
use App\Http\Requests\Account\AccountInfoRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Prologue\Alerts\Facades\Alert;

class MyAccountController extends Controller
{
    protected $data = [];
    protected $crud;

    public function __construct()
    {
        $this->middleware(backpack_middleware());
        $this->crud = app()->make('crud');
        $this->crud->setModel(User::class);
    }

    /**
     * Show the user a form to change their personal information & password.
     */
    public function getAccountInfoForm()
    {
        $this->data['title'] = trans('backpack::base.my_account');
        $this->data['user'] = $this->guard()->user();

        $this->accountAddress();
        return view(backpack_view('my_account'), ['data' => $this->data, 'crud' => $this->crud]);
    }

    public function accountAddress()
    {
        $this->crud->setEntityNameStrings('Update address', '');
        $this->crud->field('address')->type('address_google')->required('required')->value($this->data['user']->address)->storeAsJson(true);
        $this->crud->field('address')->type('address_google')->required('required')->value($this->data['user']->address);
        // $this->crud->field('street')->wrapper(DEFAULT_INPUT_CLASS)->value($this->data['user']->street);
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountInfoForm(AccountInfoRequest $request)
    {
        $result = $this->guard()->user()->update($request->validated());

        if ($result) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountAddressForm(AccountAddressRequest $request)
    {
        $result = $this->guard()->user()->update($request->validated());

        if ($result) {
            Alert::success(__('Address updated successfully'))->flash();
        } else {
            Alert::error(__('An error occurred while trying to update the address'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Save the new password for a user.
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $user = $this->guard()->user();
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            Alert::success(__('Password updated successfully'))->flash();
        } else {
            Alert::error(__('an error occurred while trying to update the password'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return backpack_auth();
    }
}