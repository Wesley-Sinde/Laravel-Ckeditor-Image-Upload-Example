# Laravel Ckeditor Image Upload Example
Laravel CKEditor image upload example; Through this tutorial, i am going to show you how to install and use CKEditor for image upload in laravel apps.

<p align="center"><a href="https://wesley.io.ke" target="_blank"><img src="https://laratutorials.com/wp-content/uploads/2022/02/Laravel-9-Ckeditor-Image-Upload-Example-1024x499.jpg" width="400"></a></p>


# Laravel Ckeditor Image Upload Example
Use the below given steps to upload image using CKEditor 5 in laravel 9 apps:

* Step 1 – Install Laravel 9 App
* Step 2 – Install CKEditor Package in Laravel
* Step 3 – Register CKEditor package in Laravel
* Step 4 – Publish the Ckeditor package by command
* Step 5 – Add Route
* Step 6 – Create Controller Using Artisan Command
* Step 7 – Create Blade View
* Step 8 – upload and Insert Image in laravel using CKEditor
* Step 1 – Install Laravel 9 App
Run the following command on the command prompt to install or download Laravel 9 app:
```
 composer create-project --prefer-dist laravel/laravel Blog
 ```
# Step 2 – Install CKEditor In Laravel
Run the following command on command prompt to install CKEditor in Laravel. So, open the terminal execute the following command on it:
```
composer require ckeditor/ckeditor
```
or when using laravel 5 and below
```
composer require unisharp/laravel-ckeditor
```
Above command will install CKEditor packages in laravel app vendor directory.

# Step 3 – Register CKEditor package in Laravel
Then registered the package in laravel. So, open config/app.php and place the below line to the providers array.
```
Unisharp\Ckeditor\ServiceProvider::class,
```
# Step 4 – Publish the Ckeditor package by command
Run the following command on command prompt to copies some of the files and folders from ‘vendor\unisharp\laravel-ckeditor’ to ‘public\vendor\unisharp\laravel-ckeditor’:

```php
php artisan vendor:publish --tag=ckeditor
```
# Step 5 – Add Route
Then visit to web.php file and add the following routes into it, which is placed inside routes directory:
```php
use App\Http\Controllers\CkeditorController;

Route::get('ckeditor', [CkeditorController::class, 'index']);
```
# Step 6 – Create Controller Using Artisan Command
Run the following command on command prompt to create controller:
```
php artisan make:controller CkeditorController
```
Then open CkeditorController.php file and add the following code into it, which is placed inside app/http/controllers directory:

```php
<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
 
class CkeditorController extends Controller
{
 
    public function index()
    {
        return view('ckeditor');
    }  
}
```
# Step 7 – Create Blade View
Visit to resources/views directory and inside this directory create one file name ckeditor.blade.php.

Then add the following code into ckeditor.blade.php file:
```html
<!DOCTYPE html>
<html>
<head>
<title>Install and Use CKEditor in Laravel 9 with Image Upload - wesley.io.ke</title>
 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <textarea class="form-control" id="description" name="description"></textarea>
</div>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>
</body>
</html>
```
* Note:- If the package of ckeditor is having some problem installing your Laravel web application. Then you add the following cdn file to your blade view file:
```js
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
```
# Step 8 – Upload and Insert Image in laravel using CKEditor
CKEditor by default does not give the option to upload the image from your computer. If someone looking to give this option then read on. It needs to add a route, image upload and some JavaScript code to our application. At first, to enable image upload option you need to call CKEditor in the following way.

```js
<script>
    CKEDITOR.replace( 'description', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
```
Now, create a route for uploading images in laravel 9 app using CKEditor. Open your route/web.php file and add the following route into it:
```php
Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');
```
To use an image uploaded to CKEditor we need to upload the image to our application folder and send back an image URL. To store an image on a server, we will use the Laravel storage facility where we create a symbol of an on storage folder.

Next, open terminal and run the below command:
```
php artisan storage:link
```
Next, add the following method in CkeditorController.php file. This method will store the image or files in the server and return the image URL.

```php
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }
    ```
# Conclusion
Through this tutorial, you have learned how to install and use CKEditor with image upload in laravel .

