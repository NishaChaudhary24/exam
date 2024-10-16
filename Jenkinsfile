pipeline {
    agent any
    stages {
        stage('Install Dependencies') {
            steps {
                sh 'composer install'
            }
        }
        stage('Run Tests') {
            steps {
                sh 'vendor/bin/phpunit'
            }
        }
        stage('Build') {
            steps {
                sh 'php artisan migrate'
            }
        }
    }
}
