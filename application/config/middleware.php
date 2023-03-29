<?php

$config['product_middleware'] = array(
    'route' => 'product/(:num)',
    'class' => 'ProductAuthorizationMiddleware',
    'method' => 'handle'
);