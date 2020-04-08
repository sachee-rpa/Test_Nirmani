<?php

namespace App\Providers;
use Laravel\Passport\Passport;
 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\SparePart\SparePo' => 'App\Policies\SparePart\PoPolicy',
        'App\Model\SparePart\SpareGrn' => 'App\Policies\SparePart\GrnPolicy',
        'App\Model\SparePart\SpareInvoice' => 'App\Policies\SparePart\InvoicePolicy',
        'App\Model\SparePart\SpareGin' => 'App\Policies\SparePart\GinPolicy',   
        'App\Model\SparePart\SpareDn' => 'App\Policies\SparePart\DnPolicy',  
        'App\Model\SparePart\SpareGrf' => 'App\Policies\SparePart\GrfPolicy',       
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       
        // Passport::routes();
    }
}