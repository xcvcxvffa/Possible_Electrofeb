<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    protected $repository;

    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDashboardData()
    {
        $stats = $this->repository->getStats();
        $stats['storage_used_formatted'] = $this->formatBytes($stats['storage_used']);

        $systemInfo = [
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
            'database' => DB::connection()->getDriverName(),
            'environment' => app()->environment(),
            'server_time' => now()->format('Y-m-d H:i:s'),
            'timezone' => config('app.timezone'),
        ];

        return [
            'stats' => $stats,
            'charts' => $this->repository->getChartData(),
            'recentActivity' => $this->repository->getRecentActivityStream(),
            'recentInquiries' => $this->repository->getRecentInquiries(),
            'recentApplications' => $this->repository->getRecentJobApplications(),
            'recentBlogs' => $this->repository->getRecentBlogs(),
            'recentProducts' => $this->repository->getRecentProducts(),
            'systemInfo' => $systemInfo,
        ];
    }

    /**
     * Format bytes to KB, MB, GB
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
