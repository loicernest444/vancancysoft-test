<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908114844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, division VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY fk_jobs_divisions');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY fk_jobs_professions');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY fk_jobs_companies');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY fk_jobs_roles');
        $this->addSql('DROP TABLE divisions');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE professions');
        $this->addSql('DROP TABLE jobs');
        $this->addSql('DROP INDEX ix_companies_company ON companies');
        $this->addSql('ALTER TABLE companies CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE company company VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE divisions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, division VARCHAR(255) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE roles (id INT UNSIGNED AUTO_INCREMENT NOT NULL, role VARCHAR(255) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE professions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, profession VARCHAR(255) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jobs (id CHAR(36) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, company_id INT UNSIGNED NOT NULL, profession_id INT UNSIGNED NOT NULL, division_id INT UNSIGNED NOT NULL, role_id INT UNSIGNED NOT NULL, job VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, job_ref VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, link VARCHAR(2000) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, date_published DATE DEFAULT NULL, refkey CHAR(32) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX ix_jobs_division_id (division_id), INDEX ix_jobs_role_id (role_id), INDEX ix_jobs_company_id (company_id), INDEX ix_jobs_date_published (date_published), INDEX ix_jobs_profession_id (profession_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT fk_jobs_divisions FOREIGN KEY (division_id) REFERENCES divisions (id) ON UPDATE CASCADE');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT fk_jobs_professions FOREIGN KEY (profession_id) REFERENCES professions (id) ON UPDATE CASCADE');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT fk_jobs_companies FOREIGN KEY (company_id) REFERENCES companies (id) ON UPDATE CASCADE');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT fk_jobs_roles FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE CASCADE');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('ALTER TABLE companies CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE company company VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX ix_companies_company ON companies (company)');
    }
}
