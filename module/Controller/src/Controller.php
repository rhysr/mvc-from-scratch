<?php

namespace Controller;

interface Controller
{
    public function __invoke(array $params);
}
