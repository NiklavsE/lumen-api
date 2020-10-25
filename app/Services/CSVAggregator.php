<?php

namespace App\Services;

use App\Customer;

class CSVAggregator
{
    /**
     * path to csv file folder
     * @var string
     */
    private $path;

    public function __construct()
    {
        // path to csv files to import in data storage (in this case database)
        $this->path = storage_path() . '/customer_data';
    }   

    /**
     * Loads data from csv data folder into database
     *
     * @return bool returns boolean whether the import was succesful or not
    */
    public function importData()
    {
        $delimiter = ',';
        $files = array_diff(scandir($this->path), array('.', '..'));
        $expectedColumnNames = array('name', 'surname', 'email', 'address', 'city', 'gender', 'soc_security_num', 'balance');
        $data = array();

        foreach ($files as $file) {
            $filePath = $this->path . '/' . $file;
            $header = null;

            if (!file_exists($filePath) || !is_readable($filePath)) {
                return false;
            }

            $handle = fopen($filePath, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {

                    // fix incorrect enclosures as given in example csv files
                    $line = str_replace('”', '"', $line);

                    $row = str_getcsv($line);
                    if (!$header) {
                        if ($row === $expectedColumnNames) {
                            $header = $row;
                        } else {
                            return false;
                        }
                    } else {
                        $data[] = array_combine($header, $row);
                    }
                }

                fclose($handle);
            }
        }

        // load csv data array into database
        foreach ($data as $entry) {
            Customer::create($entry);
        }

        return true;
    }
}
