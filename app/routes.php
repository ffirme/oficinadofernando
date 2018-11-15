<?php

$route[] = ['/', 'HomeController@index'];
$route[] = ['/companies', 'CompanyController@index'];
$route[] = ['/company/{id}/show', 'CompanyController@show'];
$route[] = ['/company/create', 'CompanyController@create'];
$route[] = ['/company/store', 'CompanyController@store'];
$route[] = ['/company/{id}/edit', 'CompanyController@edit'];
$route[] = ['/company/{id}/update', 'CompanyController@update'];
$route[] = ['/company/{id}/delete', 'CompanyController@delete'];

return $route;


