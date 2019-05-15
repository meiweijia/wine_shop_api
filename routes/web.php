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
Route::get('/',function (){
    $miniProgram = \Overtrue\LaravelWeChat\Facade::miniProgram();
    $sessionKey = $miniProgram->auth->session('033Iz74B0dqPlh20mE4B0rgM3B0Iz743');
    var_dump($sessionKey);
    $decryptedData = $miniProgram->encryptor->decryptData($sessionKey['session_key'], '2ZVuf7ecULoK9ia/eP750w==', 'd/DKESuVCg1xikKq8Swav+MaovNshoZDHQmhljHe1aUsII5Aa5b5qq0UsrWwLUPg6CtcqyqHSASL+gMvfh53v7xI6DXanzQBoom9sSaDdCdeGPrhT2NTlflGxeC7eSoARrYEe73oW5EwU3tOF7QI4cpGn1U3VwkN85qxHhm697toWxeYlXFaAi3kaL94XDm05J2nxU7ejHyY6iu9xJfqH6vtYF8o88PncKDaCuTJTMIrhHzrqXHWv22C9xiswsDpmzVI1OdvOUNmfF9BD86EHCFxbDXhWBPWcPWaIWX/ujPq2fUKhVLMXdpkjmRunyXn2Y2IqtKFJO+0wJ9QgpqtgEKeFjA9fwE6WxAmAQyX01YPC7AtrUPu92XhkvqxsCbi6jHTfaUWCLUF6rtEf5oZnp2lEAkMumgtpevgoXTameBIEP+OWH5e03cwbMiR43Xan9ZryrrWuem9BI+eCn1G5MYDTLkIqK9E2yW/ZrTb7uAv7JQW8JDqQtfjleRCX4YP');
    dd($decryptedData);
});
