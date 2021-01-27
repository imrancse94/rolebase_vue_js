<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    /**
     * Get one by slug collumn.
     * @param string $slug
     * @return mixed
     */
    public function insertData($inputData);

    /**
     * Get all most popular Modules.
     * @return mixed
     */
    public function getRoleById($id, $cols = []);

    /**
     * Get all recent created Modules.
     * @return mixed
     */
    public function updateById($id,$inputData);

    /**
     * Get all posts only published
     * @return mixed
     */
    public function geAllroles($limit);

    /**
     * Get post only published
     * @return mixed
     */
    public function deleteById($id);
}
