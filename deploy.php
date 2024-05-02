<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'alias dep='vendor/bin/dep'');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts


// Hooks

after('deploy:failed', 'deploy:unlock');
