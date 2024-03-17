<?php

declare(strict_types=1);

namespace App\Util\Json;

use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator;
use Exception;

class JsonDesarializer
{
    public function deserialize(string $data): array
    {
        if (false === json_validate($data))
            throw new Exception('Invalid JSON data', 400);

        return json_decode($data, true);
    }

    public function validate(string $json, string $schema): bool
    {
        if (false === json_validate($schema))
            throw new Exception('Invalid JSON schema', 400);

        if (false === json_validate($json))
            throw new Exception('Invalid JSON data', 400);

        $validator = new Validator();
        $validator->validate($json, $schema, Constraint::CHECK_MODE_COERCE_TYPES);

        return $validator->isValid();
    }

    public function getData(string $json, JsonSchemaInterface $schema): string
    {
        if (!$this->validate($json, $schema->getJsonSchema()))
            throw new Exception('Invalid JSON data', 400);

        return json_decode($json, true);
    }
}