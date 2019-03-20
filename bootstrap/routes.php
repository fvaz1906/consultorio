<?php 

//Autenticação
$app->get('/auth/sign', '\App\Controllers\AuthController:getSign')->setName('auth.sign');
$app->post('/auth/sign', '\App\Controllers\AuthController:postSign');
#$app->get('/auth/signup', '\App\Controllers\AuthController:getSignUp')->setName('auth.signup');
#$app->post('/auth/signup', '\App\Controllers\AuthController:postSignUp');

//Home
$app->get('/', '\App\Controllers\HomeController:index')->add( new \App\Middleware\Middleware($container));
$app->get('/logout', '\App\Controllers\HomeController:logout')->setName('logout');

//Pacientes
$app->get('/patient/list', '\App\Controllers\PatientController:index')->add( new \App\Middleware\Middleware($container));
$app->get('/patient/add', '\App\Controllers\PatientController:addPatient')->add( new \App\Middleware\Middleware($container))->setName('patient.add');
$app->post('/patient/add', '\App\Controllers\PatientController:add')->add( new \App\Middleware\Middleware($container));
$app->get('/patient/edit/{id}', '\App\Controllers\PatientController:editPatient')->add( new \App\Middleware\Middleware($container));
$app->post('/patient/edit', '\App\Controllers\PatientController:edit')->add( new \App\Middleware\Middleware($container))->setName('patient.edit');
$app->get('/patient/remove/{id}', '\App\Controllers\PatientController:remove')->add( new \App\Middleware\Middleware($container));

//Admnistração
// -- Convênios
$app->get('/administration/agreement/list', '\App\Controllers\AdministrationController:index')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/agreement/add', '\App\Controllers\AdministrationController:add')->add( new \App\Middleware\Middleware($container))->setName('administration.agreement.add');
$app->post('/administration/agreement/add', '\App\Controllers\AdministrationController:postAgreement')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/agreement/edit/{id}', '\App\Controllers\AdministrationController:editAgreement')->add( new \App\Middleware\Middleware($container));
$app->post('/administration/agreement/edit', '\App\Controllers\AdministrationController:edit')->add( new \App\Middleware\Middleware($container))->setName('administration.agreement.edit');
$app->get('/administration/agreement/remove/{id}', '\App\Controllers\AdministrationController:remove')->add( new \App\Middleware\Middleware($container));
// -- Usuários
$app->get('/administration/users/list', '\App\Controllers\AdministrationController:listUsers')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/users/add', '\App\Controllers\AdministrationController:addUsers')->add( new \App\Middleware\Middleware($container))->setName('administration.users.add');
$app->get('/administration/users/edit/{id}', '\App\Controllers\AdministrationController:editUsers')->add( new \App\Middleware\Middleware($container));
$app->post('/administration/users/edit', '\App\Controllers\AdministrationController:postEditUser')->add( new \App\Middleware\Middleware($container));
$app->post('/administration/users/add', '\App\Controllers\AdministrationController:postUsers')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/users/remove/{id}', '\App\Controllers\AdministrationController:removeUsers')->add( new \App\Middleware\Middleware($container));
// -- CID
$app->get('/administration/cid/list', '\App\Controllers\AdministrationController:listCid')->add( new \App\Middleware\Middleware($container));
// -- Exames
$app->get('/administration/exam/list', '\App\Controllers\AdministrationController:listExam')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/exam/add', '\App\Controllers\AdministrationController:addExam')->add( new \App\Middleware\Middleware($container))->setName('administration.exam.add');
$app->post('/administration/exam/add', '\App\Controllers\AdministrationController:postAddExam')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/exam/edit/{id}', '\App\Controllers\AdministrationController:editExam')->add( new \App\Middleware\Middleware($container));
$app->post('/administration/exam/edit', '\App\Controllers\AdministrationController:postEditExam')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/exam/remove/{id}', '\App\Controllers\AdministrationController:removeExam')->add( new \App\Middleware\Middleware($container));
// -- Medicamentos
$app->get('/administration/medicine/list', '\App\Controllers\AdministrationController:listMedicine')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/medicine/add', '\App\Controllers\AdministrationController:addMedicine')->add( new \App\Middleware\Middleware($container))->setName('administration.medicine.add');
$app->post('/administration/medicine/add', '\App\Controllers\AdministrationController:postAddMedicine')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/medicine/edit/{id}', '\App\Controllers\AdministrationController:editMedicine')->add( new \App\Middleware\Middleware($container));
$app->post('/administration/medicine/edit', '\App\Controllers\AdministrationController:postEditMedicine')->add( new \App\Middleware\Middleware($container));
$app->get('/administration/medicine/remove/{id}', '\App\Controllers\AdministrationController:removeMedicine')->add( new \App\Middleware\Middleware($container));

//Consultas
$app->get('/query/list', '\App\Controllers\QueryController:index')->add( new \App\Middleware\Middleware($container));
$app->get('/query/markedquerys', '\App\Controllers\QueryController:markedQuerys');
$app->get('/query/add', '\App\Controllers\QueryController:queryAdd')->add( new \App\Middleware\Middleware($container))->setName('query.add');
$app->post('/query/add', '\App\Controllers\QueryController:add')->add( new \App\Middleware\Middleware($container));
$app->get('/query/edit/{id}', '\App\Controllers\QueryController:editQuery')->add( new \App\Middleware\Middleware($container));
$app->post('/query/edit', '\App\Controllers\QueryController:editPostQuery')->add( new \App\Middleware\Middleware($container));
$app->get('/query/remove/{id}', '\App\Controllers\QueryController:remove')->add( new \App\Middleware\Middleware($container));

//Financeiro
$app->get('/finances/{type}', '\App\Controllers\FinancesController:index')->add( new \App\Middleware\Middleware($container));
$app->post('/finances/add', '\App\Controllers\FinancesController:add')->add( new \App\Middleware\Middleware($container));
$app->get('/finances/print/{id}', '\App\Controllers\FinancesController:print')->add( new \App\Middleware\Middleware($container));
$app->get('/finances/printReceipt/{id}', '\App\Controllers\FinancesController:print')->add( new \App\Middleware\Middleware($container));
$app->get('/finances/remove/{id}', '\App\Controllers\FinancesController:remove')->add( new \App\Middleware\Middleware($container));
$app->get('/finances/receipts/', '\App\Controllers\FinancesController:listReceipts')->add( new \App\Middleware\Middleware($container));