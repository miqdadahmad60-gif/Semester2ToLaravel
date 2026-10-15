<?php
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;
Route::get('/',[SchoolController::class,'home'])->name('home');
Route::get('/about',fn()=>redirect('/#about')); Route::get('/departments',fn()=>redirect('/#departments'));
Route::get('/login',[SchoolController::class,'loginForm'])->name('login'); Route::post('/login',[SchoolController::class,'login']);
Route::get('/register',[SchoolController::class,'registerForm'])->name('register'); Route::post('/register',[SchoolController::class,'register']);
Route::post('/logout',[SchoolController::class,'logout'])->name('logout');
Route::options('/api/login',[SchoolController::class,'apiLogin']); Route::post('/api/login',[SchoolController::class,'apiLogin']); Route::post('/api/auth/login',[SchoolController::class,'apiLogin']); Route::get('/api/me',[SchoolController::class,'apiMe']);
Route::middleware('school.auth')->group(function(){
 Route::get('/dashboard',[SchoolController::class,'dashboard'])->name('dashboard');
 Route::get('/academic',[SchoolController::class,'academic'])->name('academic'); Route::post('/academic/upload',[SchoolController::class,'uploadMaterial']); Route::get('/academic/edit/{id}',[SchoolController::class,'editMaterial']); Route::put('/academic/update/{id}',[SchoolController::class,'updateMaterial']); Route::delete('/academic/delete/{id}',[SchoolController::class,'deleteMaterial']); Route::get('/academic/download/{id}',[SchoolController::class,'downloadMaterial']);
 Route::get('/quizzes',[SchoolController::class,'quizzes'])->name('quizzes'); Route::post('/quizzes/create',[SchoolController::class,'createQuiz']); Route::get('/quizzes/edit/{id}',[SchoolController::class,'editQuiz']); Route::put('/quizzes/update/{id}',[SchoolController::class,'updateQuiz']); Route::delete('/quizzes/delete/{id}',[SchoolController::class,'deleteQuiz']); Route::get('/quizzes/take/{id}',[SchoolController::class,'takeQuiz']); Route::post('/quizzes/submit/{id}',[SchoolController::class,'submitQuiz']); Route::get('/quizzes/results/{id}',[SchoolController::class,'quizResults']);
 Route::get('/grades',[SchoolController::class,'grades'])->name('grades');
 Route::get('/facilities',[SchoolController::class,'facilities'])->name('facilities'); Route::post('/facilities/borrow',[SchoolController::class,'borrowFacility']); Route::get('/facilities/edit/{id}',[SchoolController::class,'editFacility']); Route::put('/facilities/update/{id}',[SchoolController::class,'updateFacility']); Route::patch('/facilities/status/{id}/{status}',[SchoolController::class,'facilityStatus']); Route::delete('/facilities/delete/{id}',[SchoolController::class,'deleteFacility']);
});
