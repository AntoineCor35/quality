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
                'dependency-check' 'OWASP Dependency-Check Vulnerabilities'
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
                
                // Archiver les rapports générés (méthode simple)
                archiveArtifacts artifacts: 'reports/*', 
                                fingerprint: true,
                                allowEmptyArchive: true
                
                // Afficher un lien vers les rapports
                echo "OWASP Dependency Check reports generated:"
                echo "- HTML Report: reports/dependency-check-report.html"
                echo "- JSON Report: reports/dependency-check-report.json"
            }
        }
    }
    
    post {
        always {
            echo 'Cleaning up workspace...'
        }
        success {
            echo 'Pipeline completed successfully!'
            echo 'Check the archived artifacts for OWASP Dependency Check reports.'
        }
        failure {
            echo 'Pipeline failed. Check the logs for more details.'
        }
    }
}
