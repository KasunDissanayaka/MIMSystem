<?php

namespace App\Providers;

use App\Interfaces\CustomerRecordRepositoryInterface;
use App\Interfaces\MedicationInventoryRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\CustomerRecord;
use App\Models\MedicationInventory;
use App\Models\User;
use App\Repositories\CustomerRecordRepository;
use App\Repositories\MedicationInventoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, function ($app) {return new UserRepository(new User());});
        $this->app->bind(CustomerRecordRepositoryInterface::class, function ($app) {return new CustomerRecordRepository(new CustomerRecord());});
        $this->app->bind(MedicationInventoryRepositoryInterface::class, function ($app) {return new MedicationInventoryRepository(new MedicationInventory());});
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
