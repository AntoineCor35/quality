pipeline {
    agent any

    environment {
        SONAR_TOKEN = credentials('sonarqube-token')
    }

    stages {
        stage('Install Dependencies') {
            steps {
                sh 'composer install'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
                sh 'php artisan migrate --force'
            }
        }

        stage('Run Tests') {
            steps {
                sh './vendor/bin/phpunit --coverage-clover=storage/coverage.xml'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    sh 'vendor/bin/sonar-scanner'
                }
            }
        }

        stage('OWASP Dependency Check') {
            steps {
                dependencyCheck additionalArguments: '--format HTML --out reports', 
                                scanpath: '.', 
                                odcInstallation: 'Default'
            }
        }
    }
}
