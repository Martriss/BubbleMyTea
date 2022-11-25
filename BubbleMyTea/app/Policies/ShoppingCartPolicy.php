<?php

namespace App\Policies;

use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ShoppingCart $shoppingCart)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ShoppingCart $shoppingCart)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ShoppingCart $shoppingCart)
    {
        return true;
    }
}
