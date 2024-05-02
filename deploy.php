<?php
namespace Deployer;

require 'recipe/laravel.php';

// Zone yhendus

set('application', 'SaareSpordiselts');
set('remote_user', 'virt118418');
set('http_user', 'virt118418');
set('keep_release', 2);

host('ta22pildre.itmajakas.ee')
    ->setHostname('saarespordiselts.ta22pildre.itmajakas.ee')
    ->set('http_user','virt118418')
    ->set('deploy_path','~/domeenid/www.ta22pildre.itmajakas.ee/saarespordiselts
')
    ->set('branch','main');

set('repository', 'git@github.com:siimpildre/SiimPildre-final-TA22.git');

// tasks

task('opcache:clear', function () {
    run('killall php82-cgi || true');
})->desc('Clear opcache');

task('build:node', function() {
    cd('{{release_path}}');
    run('npm i');
    run('npx vite build');
    run('rm -fr node_modules');
});

task('deploy',[
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'build:node',
    'deploy:publish',
    'opcache:clear',
    'artisan:cache:clear'
]);

// Hooks

after('deploy:failed', 'deploy:unlock');