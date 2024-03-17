<?php

declare(strict_types=1);

namespace App\Util\Json;

interface JsonSchemaInterface
{
    public function getJsonSchema(): string;
}