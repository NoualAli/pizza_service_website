<?php

namespace App\Concerns;

use Backpack\CRUD\app\Library\Widget;

trait EchoTrait
{
    private function subscribeEchoPsChannel()
    {
        Widget::add([
            'type' => 'view',
            'view' => 'backpack::widgets.notify_restorer',
        ]);

        Widget::add()->type('script')
            ->to('before_content')
            ->content(env('APP_URL') . ':6001/socket.io/socket.io.js');
        Widget::add()->type('script')
            ->to('before_content')
            ->content(asset(mix('website/js/echo-config.js')));
    }
}