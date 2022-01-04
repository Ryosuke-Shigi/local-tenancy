<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;

Route::get('create_tenant',function(){

	$website = new Website;

	app(WebsiteRepository::class)->create($website);

	$hostname = new Hostname;

	$hostname->fqdn = 'luceos.localhost';

	$hostname = app(HostnameRepository::class)->create($hostname);

	app(HostnameRepository::class)->attach($hostname, $website);

	return redirect('/');

});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
