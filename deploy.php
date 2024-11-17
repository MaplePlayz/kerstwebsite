<?php

namespace Deployer;


set('repository', 'git@github.com:MaplePlayz/kerstwebsite.git');

set('branch', 'main');
set('default_stage', 'production');

set('git_tty', true);
set('git_cache', true);
set('ssh_multiplexing', false);
set('keep_releases', 5);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts

host('100.84.82.70')
    ->set('remote_user','kerst2024')
    ->set('deploy_path', '/home/luciousdev-kerst2024/htdocs/kerst2024.luciousdev.nl')
    ->set('branch', 'main');

// Tasks

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');