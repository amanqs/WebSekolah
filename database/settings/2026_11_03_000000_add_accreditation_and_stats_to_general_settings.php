<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.accreditation', 'A (Unggul)');
        $this->migrator->add('general.accreditation_body', 'BAN-S/M');
        $this->migrator->add('general.curriculum', 'Kurikulum Merdeka');
        $this->migrator->add('general.total_students', 240);
        $this->migrator->add('general.total_teachers', null);
        $this->migrator->add('general.total_classes', 12);
        $this->migrator->add('general.total_alumni', 450);
    }
};

