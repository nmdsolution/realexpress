<?php

namespace App\Console\Commands;

use App\Models\schedule_list;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SyncDatabase extends Command
{
    protected $signature = 'sync:database2';

    protected $description = 'Synchronize local database with online database';

    public function handle()
    {
        // List of tables to synchronize
        $tables = ['buses',
            //'cache',
           // 'cache_locks',
            'expeditions',
            'failed_jobs',
            'jobs',
            'job_batches',
            'locations',
            'migrations',
            'model_has_permissions',
            'has_roles',
            'password_reset_tokens',
            'permissions',
            'roles',
            'role_has_permissions',
            'schedule_lists',
            'sessions',
            'users',]; // Add more tables as needed

        foreach ($tables as $table) {
            $this->syncTable($table);
        }

        $this->info('Database synchronization completed successfully.');
    }

    protected function syncTable($tableName)
    {
        try {
            // Fetch records from the online database
            $localRecords = DB::connection('sqlite')->table($tableName)->get();
            $this->info("Synchronizing from local table '{$tableName}', found " . $localRecords->count() . " records.");

            foreach ($localRecords as $record) {
                // Convert the record to an array and remove the 'id' field to ensure a new one is generated
                $recordArray = (array) $record;
                unset($recordArray['id']);

                // Insert or update the record into the corresponding table in the local database
                DB::connection('mysql_online')->table($tableName)->updateOrInsert(
                    ['id' => $record->id], // Use 'id' for update or insert
                    $recordArray
                );
                $this->info("Record with id {$record->id} synchronized.");
            }

            $this->info("Table '{$tableName}' synchronized successfully.");
        } catch (QueryException $e) {
            // Log the error message and continue with the next table
            $this->error("Error synchronizing table '{$tableName}': " . $e->getMessage());
        } catch (\Exception $e) {
            // Catch any other exceptions and log the error
            $this->error("Unexpected error with table '{$tableName}': " . $e->getMessage());
        }
    }
}

