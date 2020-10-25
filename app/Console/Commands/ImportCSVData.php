<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\CSVAggregator;

/**
 * Class importCSVDAta
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class ImportCSVDAta extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "import:csv-data";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "imports data from csv file directory";

    private $cSVAggregator;


    public function __construct(CSVAggregator $cSVAggregator)
    {
        parent::__construct();
        $this->cSVAggregator = $cSVAggregator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->cSVAggregator->importData();
        } catch (Exception $e) {
            $this->error('error importing files: ' . $e);
        }

        $this->info('Data import was succesful!');
    }
}
