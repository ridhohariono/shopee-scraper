<?php

namespace App\Jobs;

use App\Domain\Browser;
use App\Domain\CustomRemoteWebDriver;
use App\Domain\Models\Credential;
use App\Domain\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

/**
 * Class Job
 * @package App\Jobs
 */
abstract class Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
}