<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('noticeboard', function () {
    return true;
});
