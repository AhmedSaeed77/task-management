<?php

namespace App\Repositories;

interface ProjectRepositoryInterface extends RepositoryInterface
{
    public function getProjects();
    public function getProjectsCount();
    public function getProjectsStatusCount(bool $count = false);
    public function getProjectsId();
}
