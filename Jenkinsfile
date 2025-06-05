pipeline {
    agent any

    environment {
        SONAR_TOKEN = credentials('sonarqube-token')
    }

    stages {
        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    sh 'sonar-scanner -sonar.login=$SONAR_TOKEN -sonar.projectKey=quality-app -sonar.sources=../'

                }
            }
        }
    }
}
