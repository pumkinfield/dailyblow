<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312201454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
IF NOT EXISTS(SELECT * FROM information_schema.tables where table_name like "user")
CREATE TABLE "user" (
    id INT PRIMARY KEY UNIQUE,
    username VARCHAR(50),
    input_date timestamp,
    password text,
    email varchar(255) NOT NULL UNIQUE,
    uuid uuid
)
SQL
);

    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
IF EXISTS(SELECT * FROM information_schema.tables where table_name like "user")
DROP TABLE "user"
SQL
);

    }
}
