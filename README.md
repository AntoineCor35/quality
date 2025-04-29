# Projet : Test d'outils d'intégration continue (Jenkins + SonarQube)

Ce projet a pour objectif de mettre en place un environnement d'intégration continue avec Jenkins et SonarQube, puis d'ajouter volontairement quelques bugs pour observer comment les outils détectent les problèmes.

## Prérequis

- Docker et Docker Compose installés
- S'assurer que le port **9000** est libre (utilisé par SonarQube)

## Lancement de l'environnement

1. Lancer Docker (exemple : Docker Desktop)

2. Vérifiez que le port 9000 est libre :
   ```bash
   docker ps
   ```
Si un conteneur utilise déjà le port, pensez à l'arrêter avant de continuer.

3. Placez vous dans le bon dossier :
    ```bash
    cd jenkins-docker-sonar
    ```
    Et lancer les conteneurs Jenkins et sonarQube
    ```bash
    docker compose up -d
    ```

4. Accédez aux interfaces :

    Jenkins : http://localhost:8080

    SonarQube : http://localhost:9000

## Utilisation
Sur Jenkins, vous pouvez consulter les tests déjà passés.

Vous pouvez également lancer manuellement de nouveaux tests pour vérifier la détection des bugs introduits.