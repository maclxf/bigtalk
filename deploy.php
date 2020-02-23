<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'wwwroot/bigtalk');

// Project repository
set('repository', 'git@github.com:maclxf/bigtalk.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

set_time_limit(0);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);

// 保存最近五次部署，这样的话回滚最多也只能回滚到前 5 个版本
set('keep_releases', 5);


// Hosts

host('120.79.27.89')
    ->user('deployer')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '~/{{application}}');

before('deploy:clear_paths', 'execphpfpm');

task('execphpfpm', function () {
    cd('/home/deployer/laradock/');
    run('sudo docker-compose exec workspace bash');
});




// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
