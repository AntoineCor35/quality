FROM jenkins/jenkins:lts

# Passer root pour installer les outils
USER root

# Installer PHP, Composer, Git, Curl, unzip, sonar-scanner
RUN apt-get update && \
    apt-get install -y \
    php php-cli php-mbstring php-xml php-curl \
    unzip curl git nodejs npm wget default-jdk && \
    # Installer Composer
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    # Installer SonarScanner CLI
    wget https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-5.0.1.3006-linux.zip && \
    unzip sonar-scanner-cli-5.0.1.3006-linux.zip && \
    mv sonar-scanner-5.0.1.3006-linux /opt/sonar-scanner && \
    ln -s /opt/sonar-scanner/bin/sonar-scanner /usr/local/bin/sonar-scanner && \
    rm sonar-scanner-cli-5.0.1.3006-linux.zip && \
    apt-get clean

# Ajouter sonar-scanner au PATH
ENV PATH="/opt/sonar-scanner/bin:$PATH"
ENV SONAR_SCANNER_HOME="/opt/sonar-scanner"

# Redonner la main à l'utilisateur jenkins
USER jenkins
