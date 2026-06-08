<?php

namespace App\Repositories\Contracts;

interface ReturnBookRepositoryInterface extends BaseRepositoryInterface
{
    public function findByBorrowing(int $borrowingId);
    public function findWithFine();
    public function findDamageReturns();
}