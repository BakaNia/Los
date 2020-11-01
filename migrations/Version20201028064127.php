<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201028064127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test ADD test2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CD6703629 FOREIGN KEY (test2_id) REFERENCES test2 (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CD6703629 ON test (test2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CD6703629');
        $this->addSql('DROP INDEX IDX_D87F7E0CD6703629 ON test');
        $this->addSql('ALTER TABLE test DROP test2_id');
    }
}
