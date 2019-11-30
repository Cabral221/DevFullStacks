<?php

namespace App\Policies;

use App\Admin;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the Admin can create posts.
     *
     * @param  \App\Admin  $Admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->getPermission($admin,2);
    }

    /**
     * Determine whether the Admin can update the post.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(Admin $admin)
    {
        return $this->getPermission($admin,4);
    }

    /**
     * Determine whether the Admin can delete the post.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        return $this->getPermission($admin,3);
    }

    /**
     * Determine whether the Admin can restore the post.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the post.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }

    /**
     * Determine if user have permission to view and manage categories of posts 
     *
     * @param Admin $admin
     * @return mixed
     */
    public function category(Admin $admin)
    {
        return $this->getPermission($admin,9);
    }

    protected function getPermission($user, $p_id)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if($permission->id == $p_id){
                    return true;
                }
            }
        }
        return false;
    }
}
