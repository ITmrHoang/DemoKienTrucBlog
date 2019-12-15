<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			App\Repositories\General\RepositoryInterface::class,
			App\Repositories\CommentRepository\CommentEloquentRepository::class
		);

		$this->app->singleton(
			App\Repositories\General\RepositoryInterface::class,
			App\Repositories\PostRepository\PostEloquentRepository::class
		);
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Schema::defaultStringLength(191);
	}
}
