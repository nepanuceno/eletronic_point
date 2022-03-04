<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home > [Employees]
// Breadcrumbs::for('employees.index', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Servidores', route('employees.index'));
// });
// Breadcrumbs::for('employees.create', function (BreadcrumbTrail $trail) {
//     $trail->parent('employees.index');
//     $trail->push('Cadastro de Servidor', route('employees.create'));
// });
// Breadcrumbs::for('employees.edit', function (BreadcrumbTrail $trail, $employee) {
//     $trail->parent('employees.index');
//     $trail->push('Editar Servidor', route('employees.edit', $employee->id));
// });
// Breadcrumbs::for('employees.show', function (BreadcrumbTrail $trail, $employee) {
//     $trail->parent('employees.index');
//     $trail->push('Detalhes Servidor', route('employees.show', $employee->id));
// });

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > [Users]
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Usuários', route('users.index'));
});
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Cadastro de Usuário', route('users.create'));
});
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Editar Usuário', route('users.edit', $user->id));
});
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Detalhes do Usuário', route('users.show', $user->id));
});

// Home > [Roles]
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Perfis', route('roles.index'));
});
Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Cadastro de Perfis', route('roles.create'));
});
Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('roles.index');
    $trail->push('Editar Perfil', route('roles.edit', $user->id));
});
Breadcrumbs::for('roles.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('roles.index');
    $trail->push('Detalhes do Perfil', route('roles.show', $user->id));
});

// Home > [UserRoles]
Breadcrumbs::for('role_user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Perfis por Usuário', route('role_user.index'));
});
