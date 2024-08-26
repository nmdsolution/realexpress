<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncLocal extends Command
{
    protected $signature = 'sync:database';

    protected $description = 'Synchronize local database with online database';

    public function handle()
    {
        // List of tables to synchronize
        $tables = ['users', 'buses', 'locations','expeditions']; // Add more tables as needed

        foreach ($tables as $table) {
            $this->syncTable($table);
        }

        $this->info('Database synchronization completed successfully.');
    }

    protected function syncTable($tableName)
    {
        $localRecords = DB::connection('mysql_online')->table($tableName)->get();

        foreach ($localRecords as $record) {
            // Remove the 'id' field to ensure a new one is generated
            unset($record->id);

            // Insert the record into the corresponding table in the online database
            DB::connection('sqlite')->table($tableName)->insertOrIgnore((array) $record);
        }

        $this->info("Table '{$tableName}' synchronized successfully.");
    }



}

