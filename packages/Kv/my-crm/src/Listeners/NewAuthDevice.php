<?php

namespace Kv\MyCrm\Listeners;

use Lab404\AuthChecker\Events\DeviceCreated;

class NewAuthDevice
{
    public function handle(DeviceCreated $event)
    {
        // Create a notification for new devices
    }
}
