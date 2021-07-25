<?php

namespace saeid\Payment\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use saeid\RolePermission\Models\Permission;

class PaymentPolicies
{
    use HandlesAuthorization;

    public function manage()
    {
        if($this->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS)) return true;
    }
}
