<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Prometheus\Collectors\Horizon\CurrentMasterSupervisorCollector;
use Spatie\Prometheus\Collectors\Horizon\CurrentProcessesPerQueueCollector;
use Spatie\Prometheus\Collectors\Horizon\CurrentWorkloadCollector;
use Spatie\Prometheus\Collectors\Horizon\FailedJobsPerHourCollector;
use Spatie\Prometheus\Collectors\Horizon\HorizonStatusCollector;
use Spatie\Prometheus\Collectors\Horizon\JobsPerMinuteCollector;
use Spatie\Prometheus\Collectors\Horizon\RecentJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueDelayedJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueOldestPendingJobCollector;
use Spatie\Prometheus\Collectors\Queue\QueuePendingJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueReservedJobsCollector;
use Spatie\Prometheus\Collectors\Queue\QueueSizeCollector;
use Spatie\Prometheus\Facades\Prometheus;
use App\Models\User;

class PrometheusServiceProvider extends ServiceProvider
{
    public function register()
    {
        /*
         * Here you can register all the exporters that you
         * want to export to prometheus
         */
        Prometheus::addGauge('My gauge')
            ->value(function() {
                return 123.45;
            });

        Prometheus::addGauge('User count')
            ->helpText('This is the number of users in our app')
            ->value(fn() => User::count());
        
        Prometheus::addGauge('server_ram_used_bytes')
            ->helpText('RAM actuellement utilisée par le serveur Ubuntu (en octets)')
            ->value(function () {
                // On lit le fichier système Linux qui contient les infos de la RAM
                $meminfo = @file_get_contents('/proc/meminfo');
                
                if (!$meminfo) {
                    return 0;
                }

                // On extrait la RAM totale et la RAM disponible (en kilo-octets)
                preg_match('/MemTotal:\s+(\d+)\s+kB/', $meminfo, $total);
                preg_match('/MemAvailable:\s+(\d+)\s+kB/', $meminfo, $available);

                if (isset($total[1]) && isset($available[1])) {
                    // Calcul : RAM Utilisée = Totale - Disponible
                    $usedKb = (int)$total[1] - (int)$available[1];
                    
                    return $usedKb/1024; // Convertir en Mo (mégaoctets) pour une meilleure lisibilité dans Prometheus
                }

                return 0;
            });

        /*
         * Uncomment this line if you want to export
         * all Horizon metrics to prometheus
         */
        //$this->registerHorizonCollectors();

        /*
         * Uncomment this line if you want to export queue metrics to Prometheus.
         * You need to pass an array of queues to monitor.
         */
        //$this->registerQueueCollectors(['default']);
    }

    public function registerHorizonCollectors(): self
    {
        Prometheus::registerCollectorClasses([
            CurrentMasterSupervisorCollector::class,
            CurrentProcessesPerQueueCollector::class,
            CurrentWorkloadCollector::class,
            FailedJobsPerHourCollector::class,
            HorizonStatusCollector::class,
            JobsPerMinuteCollector::class,
            RecentJobsCollector::class,
        ]);

        return $this;
    }

    public function registerQueueCollectors(array $queues = [], ?string $connection = null): self
    {
        Prometheus::registerCollectorClasses([
            QueueSizeCollector::class,
            QueuePendingJobsCollector::class,
            QueueDelayedJobsCollector::class,
            QueueReservedJobsCollector::class,
            QueueOldestPendingJobCollector::class,
        ], compact('connection', 'queues'));

        return $this;
    }
}
