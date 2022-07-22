# Laravel8_Multi_Breeze_Auth
# ---------------------------------

# All Are Right but Application Not Running as expected 
 - So Please 'Clear view, config, cache with command' 
     - php artisan view:clear
     - php artisan config:clear
     - php artisan cache:clear
     - php artisan route:clear 


# For Using Package and Setup Steps (Multi_Breeze_Auth)
   # Package Installtion ----- (i)  
   # New Model and Migration Creation ----- (ii)
   # New Model and Migration SetUp ----- (iii)
   # Configuartion: In config/auth.php ----- (iv)
     (Editing and customizing related topic here, such as 'guard' & 'provider') 
   # Middleware Setup ----- (v)
   # Controller ----- (vi)
   # view ----- (vii)

# Laravel 8 - Build Advance Ecommerce Project A-Z
# -----------------------------------------------------------

182. Install Laravel in your system
     - composer create-project laravel/laravel Laravel8_Multi_Breeze_Auth

     # Package Instralltion ----- (i)
183. Install Breeze in laravel
     - composer require laravel/breeze --dev
     - php artisan breeze:install
     - npm install
     - npm run dev

   # 'Database creation'  // general 
     - on phpmyadmin

   # '.env setup' // general 
     - database name 

   # 'Database Migration' // general 
     - php artisan migrate 
     - see Database phpmyadmin
     
   # 'Check Application' // general 
     - php artisan serve
     - Register and login and logout 
     - after logout redirecting page setup  
          - find the route in html page
          - go to the route in web.php , auth.php 
          - see the route -> controller -> change controller route 

 184. Multi Auth With Admin Guard Part 1

     # New Model and Migration Creation: ----- (ii)
     - Model and Migration file for admin as named 'Admin'
          - php artisan make:model Admin -m

     # New Model and Migration SetUp: ----- (iii)
     - created migration file set up

     In 'Admin.php' model  
     - Copy the main part 
          - extendeted class(Authenticatable) 
          - and class all properties of 'in {}'
          - and use paths of 'User.php' model then paste  
          - add new:
               - protected $guard = 'admin'; // 'web' is default // 'web' is for user 
               - protected $fillable = [
                    'status' // add this (new) 
               ]
          - php artisan migrate 

     # Configuartion: In config/auth.php ----- (iv)
     - edit and add new guard for 'admin' in gaurds 
          - 'providers' contains 'admin's datatable name'  
               Ex:

                    'admin' => [
                         'driver' => 'session',
                         'provider' => 'admins', // database
                    ],

     - edit and add new provider for 'admin' in providers
          - 'model' contains 'model's path and model name'       
               Ex: 

               'admins' => [
                    'driver' => 'eloquent',
                    'model' => App\Models\Admin::class,
               ],

185. Multi Auth With Admin Guard Part 2

     # Middleware ----- (v)
     - php artisan make:middleware Admin 
     - in middleware Admin.php: use Auth; 
     - putting condition in middleware Admin.php  
     - supports this middleware in karnel.php 
          Ex: 'admin' => \App\Http\Middleware\Admin::Class
     - Route creation with admin prefix Applying middleware in route 
          Ex: 
          Route::prefix('admin')->group(function(){
               Route::get('/login',[AdminController::class,'Index'])->name('login_form');
               Route::get('/login/owner',[AdminController::class,'Login'])->name('admin.login');
               Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard')->middleware('admin');
          })
     
     # Controller ----- (vi)
     - php artisan make:controller AdminController
     - write function or methods on AdminController.php 

186. Admin Login & Logout Guard Part 1
187. Admin Login & Logout Guard Part 2
     # view ----- (vii)
     - put all resources on public folder 
     - admin folder creation and admin mastering 
          - admin_master.blade.php
          - index.blade.php 
     -  run 'admin_master.blade.php' with AdminController Dashboard function with the help of route
     -  run 'index.blade.php' with AdminController.php Index method
     - 'admin_login.blade.php' creation and code paste 
     - login first 'error session message' showing with bootstrap in login card 
     - Route::get('/login/owner',[AdminController::class,'Login'])->name('admin.login');
     took change 'get' method to 'post' 
     - according to 'route name' give 'action' in form fro admin login 
          Ex: {{ route('admin.login'))}}
     - @csrf token giving in form 
     - creating login method in AdminController.php 
          - dd($request->all()); // debuging and chaeking all right or not 
          - function/method: 

               public function Login(Request $request){
               // dd($request->all());
               $check = $request->all();
               if(Auth::guard('admin')->attemp(['email' => $check['email'], 'password' => $check['password']])){
                    return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully'); 
                    // redirecting with session message
               } 
               } 
188. Admin Login & Logout Guard Part 3
189. Admin Login & Logout Guard Part 4
190. Admin Register
          


 