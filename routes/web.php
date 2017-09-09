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
use App\Category;
Route::get('/', function () {
    $categories = Category::all();
    return view('categories.index',compact('categories'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categories','CategoryController@index');
Route::get('/categories/{category}','CategoryController@show');
Route::get('/categories/{category}/quizzes/create','QuizController@create');

Route::post('/quizzes','QuizController@store');
Route::get('/quizzes','QuizController@index');
Route::get('/quizzes/create','QuizController@create');
Route::get('/quizzes/{quiz}/edit','QuizController@edit');
Route::patch('/quizzes/{quiz}','QuizController@update');
Route::get('/quizzes/{quiz}','QuizController@show');


Route::get('/quizzes/{quiz}/results','ResultController@index');
Route::post('/quizzes/{quiz}/results','ResultController@store');
Route::delete('/quizzes/{quiz}/results','ResultController@destroyAll');
Route::get('/results/{quiz}','ResultController@show');

Route::get('/quizzes/{quiz}/questions','QuizQuestionController@index');
Route::get('/quizzes/{quiz}/questions/create','QuizQuestionController@create');
Route::post('/quizzes/{quiz}/questions','QuizQuestionController@store');
Route::delete('/quizzes/{quiz}/questions/{question}','QuizQuestionController@destroy');

Route::get('/questions','QuestionController@index');
Route::get('/questions/create','QuestionController@create');
Route::post('/questions','QuestionController@store');
Route::delete('/questions/{question}','QuestionController@destroy');
Route::delete('/questions','QuestionController@destroyAll');
Route::get('/questions/{question}/edit','QuestionController@edit');
Route::post('/questions/{question}/update','QuestionController@update');

Route::get('/admins/create','HomeController@adminCreate');
Route::post('/admins','HomeController@addAdmin');
Route::delete('/account','HomeController@deleteAccount');
Route::delete('/','HomeController@reset');
