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
            tools {
                'OWASP Dependency-Check Vulnerabilities' 'latest'
            }
            steps {
                sh '''
                    # Créer le répertoire reports s'il n'existe pas
                    mkdir -p reports
                      # Exécuter OWASP Dependency Check avec l'outil Jenkins
                    dependency-check.sh --project "quality-app" \
                                       --scan . \
                                       --format HTML \
                                       --format JSON \
                                       --out reports/ \
                                       --enableRetired
                '''
                
                // Publier les rapports HTML
                publishHTML([
                    allowMissing: false,
                    alwaysLinkToLastBuild: true,
                    keepAll: true,
                    reportDir: 'reports',
                    reportFiles: 'dependency-check-report.html',
                    reportName: 'OWASP Dependency Check Report'
                ])
            }
        }
    }
}
