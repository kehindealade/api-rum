<?php

/*
|--------------------------------------------------------------------------
| API Routes(Must Read)
|--------------------------------------------------------------------------
|
| Here is where I register API routes for the application. These routes are 
| passing through the jwt:auth middleware and the assign.guard middleware which
| set the guard to be used for each request, e.g Login, Register.
| all Leaser's route are prefixed with 'leaser' and roomer's routes prefixed by
| 'roomer'. 
|
*/


/* 
|--------------------------------------------------------------------------
| Returns the user details of leaser/roomer
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'leaser', 'middleware' => ['assign.guard:leaser', 'cors']], function(){
    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::get('/user', function(){
            return response()->json(['leaser' => Auth::guard('leaser')->user()]); 
        });
    });
});


Route::group(['prefix' => 'roomer', 'middleware' => ['assign.guard:roomer', 'cors']], function(){
    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::get('/user', function(){
            return response()->json(['roomer' => Auth::guard('roomer')->user()]); 
        });
    });
});




/*
|--------------------------------------------------------------------------
| Leaser API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'leaser', 'middleware' => ['assign.guard:leaser', 'cors']], function(){
    Route::post('/auth/login', 'ApiController@leaserLogin');

    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::group(['prefix' => 'profile'], function(){
            Route::get('/', 'Leaser\LeaserProfileController@index');
            Route::put('/update', 'Leaser\LeaserProfileController@update');
        });

        Route::group(['prefix' => 'hostel'], function(){
            Route::get('/', 'Leaser\HostelController@index');
            Route::post('store', 'Leaser\HostelController@store');
            Route::get('show/{id}', 'Leaser\HostelController@show');
            Route::put('/update/{id}', 'Leaser\HostelController@update');
            Route::delete('/delete/{id}', 'Leaser\HostelController@destroy');

            
        });
    });
});


/*
|--------------------------------------------------------------------------
| Roomer API Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'roomer', 'middleware' => ['assign.guard:roomer', 'cors']], function(){
    Route::post('/auth/login', 'ApiController@roomerLogin');

        Route::group(['middleware' => 'jwt.auth'], function(){
            Route::group(['prefix' => 'profile'], function(){
                Route::get('/', 'Roomer\RoomerProfileController@index');
                Route::put('/update', 'Roomer\RoomerProfileController@update');
                
                
            });

            Route::group(['prefix' => 'hostel'], function(){
                Route::get('/', 'Roomer\RoomerRoomController@index');
                Route::post('/store', 'Roomer\RoomerHostelController@store');
                Route::put('/edit/{id}', 'Roomer\RoomerHostelController@update');
                Route::get('/all', 'Roomer\RoomerHostelController@showAllRoomerHostels');
                Route::get('/mine', 'Roomer\RoomerHostelController@showMyHostels');

                Route::group(['middleware' => ['check.owner.roomer']], function(){
                Route::post('/order', 'Roomer\RoomerBookHostelController@order');
            });

                
            });

         
            
        });
});



