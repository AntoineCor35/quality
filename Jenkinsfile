pipeline {
    agent any

    environment {
        SONAR_TOKEN = credentials('sonarqube-token')
    }

    stages {
        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    sh 'sonar-scanner -Dsonar.login=$SONAR_TOKEN -Dsonar.projectKey=quality-app -Dsonar.sources=../'

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
