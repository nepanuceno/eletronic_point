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

// Home > [Departaments]
Breadcrumbs::for('departaments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Departamentos', route('departaments.index'));
});
Breadcrumbs::for('departaments.create', function (BreadcrumbTrail $trail) {
    $trail->parent('departaments.index');
    $trail->push('Novo Departamento', route('departaments.create'));
});
Breadcrumbs::for('departaments.edit', function (BreadcrumbTrail $trail, $departament) {
    $trail->parent('departaments.index');
    $trail->push('Aditar Departamento', route('departaments.edit', $departament->id));
});
Breadcrumbs::for('departaments.show', function (BreadcrumbTrail $trail, $departament) {
    $trail->parent('departaments.index');
    $trail->push('Detalhes do Departamento', route('departaments.edit', $departament->id));
});

// Home -> [Responsibility]
Breadcrumbs::for('responsibilities.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('responsibility.label_responsibility'), route('responsibilities.index'));
});

Breadcrumbs::for('responsibilities.create', function ($trail) {
    $trail->parent('responsibilities.index');
    $trail->push(__('responsibility.create-responsibility'), route('responsibilities.create'));
});

Breadcrumbs::for('responsibilities.edit', function ($trail, $responsibility) {
    $trail->parent('responsibilities.index');
    $trail->push(__('responsibility.edit-responsibility'), route('responsibilities.edit', $responsibility->id));
});
