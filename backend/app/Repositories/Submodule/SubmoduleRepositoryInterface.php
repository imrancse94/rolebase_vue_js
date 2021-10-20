<?php

namespace App\Repositories\Submodule;

interface SubmoduleRepositoryInterface
{
    /**
     * Get one by slug collumn.
     * @param string $slug
     * @return mixed
     */
    public function findBySlug(string $slug);

    /**
     * Get all most popular Modules.
     * @return mixed
     */
    public function getAllSubModules();

    /**
     * Get all recent created Modules.
     * @return mixed
     */
    public function getRecentCreatedModules();

    /**
     * Get all posts only published
     * @return mixed
     */
    public function getAllPublished();

    /**
     * Get post only published
     * @return mixed
     */
    public function findOnlyPublished($id);
}
