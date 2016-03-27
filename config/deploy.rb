set :application, 'pomoestimator'
set :repo_url, 'git@github.com:deleomotosho/pomoestimator.git'

# Branch options
# Prompts for the branch name (defaults to current branch)
#ask :branch, -> { `git rev-parse --abbrev-ref HEAD`.chomp }

# Hardcodes branch to always be master
# This could be overridden in a stage config file
set :branch, :master

#set :deploy_to, -> { "/srv/www/#{fetch(:application)}" }

set :log_level, :info
set :tmp_dir, '/home/dele/tmp'

SSHKit.config.command_map[:composer] = "php70 /home/dele/composer.phar"
set :composer_install_flags, '--no-dev --no-scripts --prefer-source --optimize-autoloader'


namespace :deploy do
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :service, :nginx, :reload
    end
  end
end

# The above restart task is not run by default
# Uncomment the following line to run it on deploys if needed
# after 'deploy:publishing', 'deploy:restart'


