<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;

class HeaderAdminComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $admin = Auth::guard('admin')->user();
        $view->with('admin', $admin);
    }

}