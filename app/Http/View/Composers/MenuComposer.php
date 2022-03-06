<?php

namespace App\Http\View\Composers; 
use Illuminate\View\View;
use App\Models\Menu;

class MenuComposer{

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus =  Menu::select('id','name','parent_id')->where('active',1)->orderbyDesc('id')->get();

        $view->with('menus', $menus);
    }
}