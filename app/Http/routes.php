<?php

use App\Staff;
use App\Photo;
use App\Product;


Route::get('/', function () {
    return view('welcome');
});

//Ploymorphic insert Staff photo for some one staff
Route::get('/insert/staff', function () {

	$staff = Staff::findOrFail(1);
	$photo = Photo::create(['path'=>'fadwa.jpg']);
	$staff->photos()->save($photo);
});


//Ploymorphic insert product photo for some one product
Route::get('/insert/product', function () {

	$product = Product::findOrFail(1);
	$photo = Photo::create(['path'=>'latop.jpg']);
	$product->photos()->save($photo);
});

//some trick here
Route::get('/assign',function(){

	$staff = Staff::findOrFail(1);
	$photo = Photo::findOrFail(2);
	$staff->photos()->save($photo);
});


//Ploymorphic read product photo for some one product
Route::get('/read/product', function () {

	$product = Product::findOrFail(1);
	foreach ($product->photos as $photo) {
		return $photo->path;
	}
	
});



//Ploymorphic read Staff photo for some one staff
Route::get('/read/staff', function () {

	$staff = Staff::findOrFail(1);
	foreach ($staff->photos as $photo) {
		return $photo->path;
	}
	
});

//Ploymorphic update Staff photo for some one staff
Route::get('/update/staff', function () {

	$staff = Staff::findOrFail(1);
	$photo = Photo::where('id','=',1)->first();
	$staff->photos()->update(['path'=>'Updated Fdawa.jpg']);

	
});

//anthor way to update Data
//Ploymorphic update Staff photo for some one staff
Route::get('/update/staff/two_way', function () {

	$staff = Staff::findOrFail(1);
	$photo = $staff->photos()->where('id',1)->first();//the photo is me now so what do you want to work with it?
	$photo->path = "update2 example.jpg";
	$photo->save();

	
});

/*Delete the satff photo */
Route::get('delete',function(){

	$staff = Staff::findOrFail(1);
	$photo = Photo::whereId(3)->first();
	$staff->photos()->delete($photo);
});

/*Delete the satff photo */
Route::get('delete/staff',function(){

	$staff = Staff::findOrFail(1);
	$photo = $staff->photos()->where('id',3)->first();
	$photo->delete();
});
