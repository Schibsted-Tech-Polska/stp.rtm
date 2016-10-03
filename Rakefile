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

##### Composer #####
namespace :composer do
    desc "Install composer's dependencies"
    task :install, [:params] do |task, args|
        puts task.comment
        unless File.exist?('composer.phar')
            system "curl -s http://getcomposer.org/installer | php -d \"apc.enable_cli=off\" "
        end

        system_check "php -d \"apc.enable_cli=off\" composer.phar self-update"
        system_check "if [ -n \"$GITHUB_OAUTH_TOKEN\" ]; then php composer.phar config github-oauth.github.com $GITHUB_OAUTH_TOKEN; php -d \"apc.enable_cli=off\" composer.phar update #{args.params} --prefer-dist; else php -d \"apc.enable_cli=off\" composer.phar update #{args.params} --prefer-source; fi"
    end

    desc "Install composer's dependencies for development"
    task :dev do |task|
        puts task.comment
        Rake::Task["composer:install"].invoke()
    end

    desc "Install composer's dependencies for production"
    task :prod do |task|
        puts task.comment
        Rake::Task["composer:install"].invoke('--no-dev -o --prefer-dist')
    end
end
desc "Install composer's dependencies"
task :composer, :env do |task, args|
    env = args.env || "development"
    if env == "production"
        Rake::Task['composer:prod'].invoke
    else
        Rake::Task['composer:dev'].invoke
    end
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
    system_check "cat config/environment.config.php.dist | sed -e 's/#APPLICATION_ENVIRONMENT#/#{args.newEnv}/g' > config/environment.config.php"
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

task :ci => ["prepare","prepareDeploy","composer:dev","lint","phploc","pdepend","phpmd","phpcs","phpcpd"] do
    Rake::Task["setEnv"].invoke("testing")
    Rake::Task["test"].invoke(testType)
end

task :build => ["prepare","prepareDeploy","composer:prod"] do
    Rake::Task["setEnv"].invoke("production")
end

task :herokubuild => ["prepare", "prepareDeploy"] do
    Rake::Task["setEnv"].invoke("production")
end

task :default => ["build"]
