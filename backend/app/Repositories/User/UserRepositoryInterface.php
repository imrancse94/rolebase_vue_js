<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * Find the user with the given username.
     * @param string $slug
     * @return mixed
     */
    public function findByUsername(string $username);

    public function insertData($inputData);

    public function getUserById($id, $cols = []);

    public function updateById($id,$inputData);

    public function geAllusers($limit);

    public function deleteById($id);
}
