<?php

namespace Controller;

use \Http\Request;
use \Http\Response;

interface Controller
{
    public function __invoke(Request $request): Response;
}
