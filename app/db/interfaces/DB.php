<?php

declare(strict_types=1);

namespace App\db\interfaces;

interface DB
{
    public function load(): void;
    public function save(): bool;
    public function addItem(): bool;
    public function isRecordExists(): bool;
    public function checkRecordField(): bool;
}
