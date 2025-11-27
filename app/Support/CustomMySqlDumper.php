<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomMySqlDumper
{
    protected $connection;
    protected $database;

    public function __construct()
    {
        $this->connection = DB::connection();
        $this->database = config('database.connections.mysql.database');
    }

    public function dumpToFile($dumpFile)
    {
        try {
            Log::info('Starting custom MySQL dump to: ' . $dumpFile);

            $dump = $this->generateDump();

            // Ensure directory exists
            $directory = dirname($dumpFile);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Write to file
            file_put_contents($dumpFile, $dump);

            Log::info('Custom MySQL dump completed. Size: ' . filesize($dumpFile) . ' bytes');

            return true;
        } catch (\Exception $e) {
            Log::error('Custom MySQL dump failed: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function generateDump()
    {
        $dump = "-- MySQL Dump\n";
        $dump .= "-- Generated at: " . date('Y-m-d H:i:s') . "\n\n";
        $dump .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
        $dump .= "SET time_zone = \"+00:00\";\n\n";
        $dump .= "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n";
        $dump .= "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n";
        $dump .= "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n";
        $dump .= "/*!40101 SET NAMES utf8mb4 */;\n\n";
        $dump .= "USE `{$this->database}`;\n\n";

        // Get all tables
        $tables = $this->getTables();

        foreach ($tables as $table) {
            $dump .= $this->dumpTable($table);
        }

        $dump .= "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n";
        $dump .= "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n";
        $dump .= "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n";

        return $dump;
    }

    protected function getTables()
    {
        $tables = [];
        $results = $this->connection->select("SHOW TABLES");

        foreach ($results as $result) {
            $tableArray = (array) $result;
            $tables[] = reset($tableArray);
        }

        return $tables;
    }

    protected function dumpTable($table)
    {
        $dump = "--\n-- Table structure for table `{$table}`\n--\n\n";
        $dump .= "DROP TABLE IF EXISTS `{$table}`;\n";

        // Get CREATE TABLE statement
        $createTable = $this->connection->select("SHOW CREATE TABLE `{$table}`");
        $createStatement = $createTable[0]->{'Create Table'};
        $dump .= $createStatement . ";\n\n";

        // Get table data
        $dump .= "--\n-- Dumping data for table `{$table}`\n--\n\n";

        $rows = $this->connection->select("SELECT * FROM `{$table}`");

        if (count($rows) > 0) {
            $columns = array_keys((array) $rows[0]);
            $columnList = '`' . implode('`, `', $columns) . '`';

            foreach ($rows as $row) {
                $values = [];
                foreach ((array) $row as $value) {
                    if ($value === null) {
                        $values[] = 'NULL';
                    } else {
                        $escapedValue = $this->connection->getPdo()->quote($value);
                        $values[] = $escapedValue;
                    }
                }

                $dump .= "INSERT INTO `{$table}` ({$columnList}) VALUES (" . implode(', ', $values) . ");\n";
            }

            $dump .= "\n";
        }

        return $dump;
    }
}
