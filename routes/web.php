<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalBreedController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\RescuerController;
use App\Http\Controllers\AnimalDiseaseInjuryController;
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\MailController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\AdopterController;
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


Route::group(['middleware'=>'web'],function()
{
  Route::resource('animalbreed', 'App\Http\Controllers\AnimalBreedController', ['names' => [ 'create' => 'animalbreed.create' ]]);
  Route::resource('animaldisease_injury', 'App\Http\Controllers\AnimalDiseaseInjuryController');
  Route::post('restoremai/{id}',['uses' => 'App\Http\Controllers\MailController@restore','as' => 'mail.restore']);
  Route::post('restoreanimal/{id}',['uses' => 'App\Http\Controllers\AnimalController@restore','as' => 'animal.restore']);
  Route::post('restorerescuer/{id}',['uses' => 'App\Http\Controllers\RescuerController@restore','as' => 'rescuer.restore']);
  Route::post('restorepersonnel/{id}',['uses' => 'App\Http\Controllers\PersonnelController@restore','as' => 'personnel.restore']);
  Route::post('restoreadopter/{id}',['uses' => 'App\Http\Controllers\AdopterController@restore','as' => 'adopter.restore']);
  Route::post('restoreconditions/{id}',['uses' => 'App\Http\Controllers\AnimalDiseaseInjuryController@restore','as' => 'condition.restore']);
  Route::post('read/{id}',['uses' => 'App\Http\Controllers\MailController@read','as' => 'mail.read']);
  Route::get('rescuerdetail/{id}',['uses' => 'App\Http\Controllers\RescuerController@rescuershow','as' => 'rescuer.detail']);
  Route::get('animaltrash',['uses' => 'App\Http\Controllers\AnimalController@indexTrash','as' => 'animal.trash']);
  Route::get('rescuertrash',['uses' => 'App\Http\Controllers\RescuerController@indexTrash','as' => 'rescuer.trash']);
  Route::get('personneltrash',['uses' => 'App\Http\Controllers\PersonnelController@indexTrash','as' => 'personnel.trash']);
  Route::get('adopterltrash',['uses' => 'App\Http\Controllers\AdopterController@indexTrash','as' => 'adopter.trash']);
  Route::get('animalinjury',['uses' => 'App\Http\Controllers\AnimalDiseaseInjuryController@index2','as' => 'injury.index']);
 
});
 
Route::group(['middleware' => 'role:admin,employee,veterinarian'], function() {
      
  Route::resource('animal', 'App\Http\Controllers\AnimalController',
   ['names' => [ 'create' => 'animal.create' ]]); 
  Route::get('animaladopted',['uses' => 'App\Http\Controllers\AnimalController@indexadopted','as' => 'animal.adopted']);
  Route::resource('email', 'App\Http\Controllers\MailController')->except(['create', 'store']); 

  Route::resource('adopter', 'App\Http\Controllers\AdopterController'); 
  Route::resource('rescuer', 'App\Http\Controllers\RescuerController');
  Route::resource('personnel', 'App\Http\Controllers\PersonnelController')->except(['create', 'store']);


});
//admin
Route::group(['middleware' => 'role:admin'], function() {
   Route::get('admin/dashboard',['uses' => 'App\Http\Controllers\AdminController@dashboard','as' => 'admin.dashboard']);    
   Route::get('myadmin',['uses' => 'App\Http\Controllers\ProfileController@getAdmin','as' => 'admin.profile']);
   Route::resource('admin','App\Http\Controllers\AdminController')->only('update');
   Route::resource('updateadopted','App\Http\Controllers\AdoptedAnimalController')->only('update');
   Route::resource('destroyadopted', 'App\Http\Controllers\AdoptedAnimalController')->only(['destroy']);  


});

 //allroles
 Route::group(['middleware' => 'role:admin,employee,veterinarian,rescuer,adopter'], function() {
  Route::get('profile',['uses' => 'App\Http\Controllers\loginController@getProfile','as' => 'profile']);    
  Route::get('user/{id}/edit',['uses' => 'App\Http\Controllers\ProfileController@edit','as' => 'user.edit']);
  Route::resource('user','App\Http\Controllers\ProfileController')->only('update');
  
});
//veterinarian
Route::group(['middleware' => 'role:veterinarian'], function() {
   Route::get('vet',['uses' => 'App\Http\Controllers\ProfileController@newindex','as' => 'vet.profile']);
});
//rescuer
Route::group(['middleware' => 'role:rescuer'], function() {
  Route::get('rescuerprofile',['uses' => 'App\Http\Controllers\ProfileController@getRescue','as' => 'rescuer.profile']);

});
//adopter
Route::group(['middleware' => ['role:adopter' ,'verified']], function() {
  Route::get('myadopter',['uses' => 'App\Http\Controllers\ProfileController@getAdopter','as' => 'adopter.profile']);
  Route::resource('adopted', 'App\Http\Controllers\AdoptedAnimalController')->except(['update','destroy']);  

});

#general
  Route::get('search',['uses' => 'App\Http\Controllers\SearchController@search','as' => 'animal.search']);
  Route::get('animalshow/{id}',['uses' => 'App\Http\Controllers\AnimalController@animnalshow','as' => 'animalshow']);
  Route::post('signin',['uses' => 'App\Http\Controllers\loginController@postSignin','as' => 'personnel.loginnow']);
  Route::get('adopteraccount',['uses' => 'App\Http\Controllers\AdopterController@myaccount','as' => 'adopter.myaaccount']);
  Route::get('signup',['uses' => 'App\Http\Controllers\PersonnelController@create','as' => 'personnel.create']);
  Route::post('signup',['uses' => 'App\Http\Controllers\PersonnelController@store','as' => 'personnel.store']);
  Route::get('send',['uses' => 'App\Http\Controllers\MailController@create','as' => 'email.create']);
  Route::post('send',['uses' => 'App\Http\Controllers\MailController@store','as' => 'email.store']);
#Home
  Route::resource('home', 'App\Http\Controllers\HomeController'); 
  Route::prefix('/')->group(function ()
   {
    Route::get('signin',['uses' => 'App\Http\Controllers\loginController@loginpage','as' => 'user.login']);
    Route::get('logout', [
      'uses' => 'App\Http\Controllers\loginController@logout',
      'as' => 'user.logout',
      'middleware'=>'auth'
      ]);
      
    // Route::get('/logoutadopter',function()
    // { 
    //   Session::forget('adopter');
    //   return view('adopter/adopter_create');
    // });
});
// CommentController
Route::post('postcomment',['uses' => 'App\Http\Controllers\CommentController@postComment','as' => 'postComment']);

Auth::routes(['verify' => true]);

Route::get('/', function () {
  return redirect()->route('home.index');
});

Route::get('/mustverify', function () {
  return view('auth.verify');
});
Route::fallback(function () {

  return view("404");

});
