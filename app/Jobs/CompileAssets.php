<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Symfony\Component\Process\Exception\ProcessFailedException;


class CompileAssets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $env = 'dev';

    public function __construct(string $env = 'dev')
    {
        $this->env = $env;
    }
    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $process = new Process(['npm', 'run', $this->env]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        Log::info($process->getOutput());

        return true;
    }
}