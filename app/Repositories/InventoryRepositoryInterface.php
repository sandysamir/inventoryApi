<?php

namespace App\Repositories;

interface InventoryRepositoryInterface
{
    public function search(array $filters, int $perPage = 15);
    public function find(int $id);
}

