<?php


use App\Models\LAEvent;
use App\Policies\LAEventPolicy;

protected $policies = [
    LAEvent::class => LAEventPolicy::class,
];
