namespace :symfony do
    desc 'Migrations'
    task :migrations do
        on roles :web do
            within release_path do
                execute :php, 'bin/console', 'doctrine:migrations:migrate'
            end
        end
    end

    desc 'Load Doctrine fixtures'
    task :load_fixtures do
        on roles :web do
            within release_path do
                execute :php, 'bin/console', 'doctrine:fixtures:load -n -e prod'
            end
        end
    end

    after 'deploy:updated', 'symfony:migrations'
    after 'deploy:updated', 'symfony:load_fixtures'
end