<?php

namespace saeid\Payment\Providers;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use saeid\Payment\Gateways\Gateway;
use saeid\Payment\Gateways\Zarinpal\ZarinpalAdaptor;
use saeid\Payment\Model\Payment;
use saeid\Payment\Policies\PaymentPolicies;
use saeid\RolePermission\Models\Permission;

class PaymentServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/payment_route.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Payment');
        Gate::policy(Payment::class,PaymentPolicies::class);
    }
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });

        config()->set('sidebar.items.payments',[
            'icon'=>'i-transactions',
            'title'=>'تراکنش ها',
            'url'=>route('payments.index'),
            'permissions'=>[
                Permission::PERMISSION_MANAGE_PAYMENTS
            ]
        ]);
    }
}
