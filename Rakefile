#!/bin/rake

#Needed for task desc rake/gem '= 0.9.2.2'
if defined? Rake::TaskManager.record_task_metadata
  Rake::TaskManager.record_task_metadata = true
end

rootPath = Rake.application.original_dir
buildPath = 'data/build'
cachePath = 'data/cache'
logPath = 'data/log'
srcPath = 'module'
codeStyle = 'PSR2'
testPath = "module/%s/test"
coveragePath = 'coverage'
testableModules = %w(Dashboard)
defaultTestType = "unit"
behatPath = 'behat'

buildDirs = %w(api code-browser coverage/html coverage/clover logs pdepend behat)

def is_composer_installed
  return system("composer --version > /dev/null 2>&1")
end

desc "Cleanup build artifacts"
task :clean do |task|
    puts task.comment
    FileUtils.rm_rf buildPath
    FileUtils.rm_rf "#{cachePath}/**"
    FileUtils.rm_rf "#{logPath}/**"
end

desc "Prepare for build"
task :prepare do |task|
    puts task.comment
    buildDirs.each do |dirName|
        FileUtils.mkdir_p("#{buildPath}/#{dirName}")
    end
end

desc "Setup configuration files - YOU NEED TO MODIFY THEM FOR YOUR APP!"
task :setupConfigFiles do |task|
    puts task.comment
    Dir.glob("#{srcPath}/Dashboard/config/autoload/dao/*-dist").each do |file|
        puts "Copying #{file} into #{file.gsub(/-dist$/, '')}"
        print `cp -n #{file} #{file.gsub(/-dist$/, '')}`
    end
end

desc "Prepare directories for deploy"
task :prepareDeploy do |task|
    puts task.comment
    unless File.directory? cachePath
        FileUtils.mkdir_p cachePath
    end
    FileUtils.chmod 0777, cachePath
    unless File.directory? logPath
        FileUtils.mkdir_p logPath
    end
    FileUtils.chmod 0777, logPath
end

desc "Perform syntax check of sourcecode files"
task :lint do |task|
    puts task.comment
    system_check "find #{srcPath} -name '*.php' -exec php -l {} \\; | grep  -v 'No syntax error' ; test $? -eq 1"
end

desc "Measure project size using PHPLOC"
task :phploc do |task|
    puts task.comment
    system_check "vendor/bin/phploc --log-csv #{buildPath}/logs/phploc.csv #{srcPath}"
end

desc "Calculate software metrics using PHP_Depend"
task :pdepend do |task|
    puts task.comment
    system_check "vendor/bin/pdepend --jdepend-xml=#{buildPath}/logs/jdepend.xml" +
             " --jdepend-chart=#{buildPath}/pdepend/dependencies.svg" +
             " --overview-pyramid=#{buildPath}/pdepend/overview-pyramid.svg" +
             " #{srcPath}"
end

desc "Perform project mess detection using PHPMD and print human readable output. Intended for usage on the command line before committing."
task :phpmd do |task|
    puts task.comment
    system "vendor/bin/phpmd #{srcPath} text scripts/php/phpmd.xml"
end

desc "Find coding standard violations using PHP_CodeSniffer and print human readable output. Intended for usage on the command line before committing."
task :phpcs do |task|
    puts task.comment
    system "vendor/bin/phpcs --standard=#{codeStyle} #{srcPath}"
end

desc "Find duplicate code using PHPCPD"
task :phpcpd do |task|
    puts task.comment
    system_check "vendor/bin/phpcpd  #{srcPath}"
end

namespace :composer do

    desc "Install composer's dependencies"
    task :install, [:params] do |task, args|
        if is_composer_installed
            system_check "composer install #{args.params}"
        else
            unless File.exist?('composer.phar')
                system "curl -s http://getcomposer.org/installer | php -d \"apc.enable_cli=off\" "
            end

            system_check "php -d \"apc.enable_cli=off\" composer.phar install #{args.params}"
        end

    end

    desc "Update composer's dependencies"
    task :update, [:params] do |task, args|
        if is_composer_installed
            system_check "composer update #{args.params}"
        else
            unless File.exist?('composer.phar')
                system "curl -s http://getcomposer.org/installer | php -d \"apc.enable_cli=off\" "
            end

            system_check "php -d \"apc.enable_cli=off\" composer.phar update #{args.params} --prefer-dist"
        end
    end

    desc "Update composer's dependencies for development"
    task :dev do |task|
        puts task.comment
        Rake::Task["composer:update"].invoke('--dev')
    end

    desc "Update composer's dependencies for production"
    task :prod do |task|
        puts task.comment
        Rake::Task["composer:update"].invoke('--no-dev')
    end
end

desc "Install composer's dependencies"
task :composer do |task|
    Rake::Task['composer:prod'].invoke
end

desc "Run tests on given type (unit|integration)"
task :test, [:testType] do |task, args|
    puts task.comment
    args.with_defaults :testType => defaultTestType
    cloverPath = "#{buildPath}/#{coveragePath}/clover"
    testableModules.each do |moduleName|
        currentModulePath = sprintf testPath, moduleName
        if (!File.exist?("./#{currentModulePath}/#{args.testType}/phpunit.xml"))
            system "cp #{currentModulePath}/#{args.testType}/phpunit.xml-dist #{currentModulePath}/#{args.testType}/phpunit.xml"
        end
        testCaseName = "#{moduleName}Test"

        coverageFullPath = "#{buildPath}/#{coveragePath}"
        coverageCovFile = "#{buildPath}/#{coveragePath}/#{moduleName.downcase}.cov"

        system_check "php vendor/bin/phpunit -c " +
                        " $PWD/#{currentModulePath}/#{args.testType}/phpunit.xml" +
                        " --coverage-clover $PWD/#{buildPath}/logs/clover-#{moduleName.downcase}.xml" +
                        " --coverage-php $PWD/#{coverageCovFile}" +
                        " --coverage-text" +
                        " $PWD/#{currentModulePath}/#{args.testType}/#{moduleName}Test/"

        system <<END
        php -d error_reporting=0 vendor/bin/phpcov merge --clover="#{buildPath}/logs/clover-stp.rtm.xml" #{coverageFullPath}
END
    end
end

desc "Run Behat with given profile (default|ci)"
task :behat, [:profile] do |task, args|
    puts task.comment
    args.with_defaults :profile => "default"
    behatPath = "#{buildPath}/#{behatPath}"

    system_check "vendor/behat/behat/bin/behat --config config/behat.yml --profile #{args.profile}"
end

desc "Make copy of config/environment.config.php.dist and set env to given one (development testing staging production)"
task :setEnv, [:newEnv] do |task, args|
    puts task.comment
    system_check "cat config/environment.config.php.dist | sed -r -e 's/#APPLICATION_ENVIRONMENT#/#{args.newEnv}/g' > config/environment.config.php"
end

module Rake
    class Application
        attr_accessor :current_task
    end
    class Task
        alias :old_execute :execute
        def execute(args=nil)
              Rake.application.current_task = @name
              old_execute(args)
        end
    end
end

module Kernel
    def system_check(args=nil)
        system(args)
        unless $?.success?
            puts "Task #{Rake.application.current_task} failed"
            exit!(1)
        end
    end
end

testType = ENV["testType"] || defaultTestType

task :ci => ["lint","phploc","pdepend","phpmd","phpcs","phpcpd"] do
    Rake::Task["test"].invoke(testType)
end

task :build => ["prepare","prepareDeploy","setupConfigFiles","composer:dev"]

task :default => ["build"]
