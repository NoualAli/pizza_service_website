@php
$user = backpack_auth()->user();
$roles = $user->roles->pluck('name')->toArray();
$restaurants = in_array('admin', $roles) || in_array('root', $roles) ? App\Models\Restaurant::all() : $user->restaurants;
@endphp

<div id="app">
    <notify-restorer :restaurants="{{ $restaurants }}"></notify-restorer>
</div>
