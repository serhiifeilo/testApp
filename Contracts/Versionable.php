<?php

namespace App\Contracts;

interface Versionable
{
    public function getVersionSnapshot(): array;

    public function getVersionableId(): int;
}