<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDF;
class MakePDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dompdf:make_pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =  'Make pdf use dompdf with template';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pdf = PDF::loadView('pdf.sample');//Load view
        $pdf->save(public_path('sample.pdf'));//Tạo file
        $pdf = PDF::loadView('pdf.base');
        $pdf->save(public_path('base.pdf'));
    }
}
