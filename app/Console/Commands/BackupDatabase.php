<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:backupdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'データベースのバックアップ';

    protected $db_host;
    protected $db_user;
    protected $db_pass;
    protected $db_name;
    protected $store_path;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->db_host = env('DB_HOST');
        $this->db_user = env('DB_USERNAME');
        $this->db_pass = env('DB_PASSWORD');
        $this->db_name = env('DB_DATABASE');
        $this->store_path = '/tmp';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file_name = sprintf('%s.sql', date('YMDHis'));
        $file_path = sprintf('%s/%s', $this->store_path, $file_name);
        $command = sprintf(
            'mysqldump --single-transaction -h %s -u %s -p%s %s > %s',
            $this->db_host,
            $this->db_user,
            $this->db_pass,
            $this->db_name,
            $file_path
        );
        exec($command, $output, $ret);
    }
}
