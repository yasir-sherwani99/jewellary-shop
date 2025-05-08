<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $mainNav = [
                [
                    'name' => 'Home',
                    'route' => 'home',
                    'params' => '',
                    'url' => '/',
                    'path' => '/'
                ],
                [
                    'name' => 'Jewelry',
                    'route' => 'product.collection',
                    'params' => '',
                    'url' => '/collections',
                    'path' => 'collections',
                    'children' => [
                        ['name' => 'Rings', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=rings'],
                        ['name' => 'Necklace Sets', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=necklace-sets'],
                        ['name' => 'Earrings', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=earrings'],
                        ['name' => 'Bracelets', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=bracelets'],
                        ['name' => 'Bangles', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=bangles'],
                        ['name' => 'Anklets', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=anklets'],
                        ['name' => 'Pendants', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=pendants'],
                        ['name' => 'Buttons', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=buttons'],
                        ['name' => 'Nose Pins', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=nose-pins']
                    ]
                ],
                [
                    'name' => 'Best Sellers',
                    'route' => 'product.best-selling',
                    'params' => '',
                    'url' => '/collection/best-selling',
                    'path' => 'collection/best-selling'
                ],
                [
                    'name' => 'Men\'s Category',
                    'route' => '#',
                    'params' => '',
                    'url' => '',
                    'path' => '',
                    'children' => [
                        ['name' => 'Men Rings', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=men-rings'],
                        ['name' => 'Men Bracelets', 'route' => 'product.collection', 'params' => '', 'url' => '/collections?q=men-bracelets']
                    ]
                ],
                [
                    'name' => 'Contact',
                    'route' => 'contact.create',
                    'params' => '',
                    'url' => '/contact',
                    'path' => 'contact'
                ],
            ];

            $view->with('mainNav', $mainNav);
        });
    }
}
