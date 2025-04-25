<?php
use \Core\Route;

return [
    new Route('/hello/', 'hello', 'index'),
    new Route('/test/1/', 'test', 'act1'),
    new Route('/test/2/', 'test', 'act2'),
    new Route('/test/3/', 'test', 'act3'),
    new Route('/nums/:n1/:n2/:n3/', 'num', 'sum'),
    new Route('/user/all/', 'user', 'all'),      
    new Route('/user/first/:n/', 'user', 'first'),
    new Route('/user/:id/:key/', 'user', 'info'), 
    new Route('/user/:id/', 'user', 'show'),
    new Route('/product/:n/', 'product', 'show'),
    new Route('/products/all/', 'product', 'all'),
    new Route('/page/:id/', 'page', 'show'),
    new Route('/page/', 'page', 'test'),
    new Route('/page/:id', 'page', 'one'),
    new Route('/page/',   'page', 'all'),
    new Route('/products/:id', 'products', 'one'),
    new Route('/products/',   'products', 'Pall'),
];