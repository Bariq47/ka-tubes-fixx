pipeline {
    agent any
    environment {
        DOCKER_CREDENTIALS = 'docker-hub-credentials-id' // Jenkins credentials ID for Docker Hub
    }
    stages {
        stage('Login to Docker Hub') {
            steps {
                script {
                    // Authenticate to Docker Hub
                    docker.withRegistry('', DOCKER_CREDENTIALS) {
                        echo 'Logged in to Docker Hub'
                    }
                }
            }
        }
        stage('Build Docker Image') {
            steps {
                script {
                    // Build the Docker image
                    docker.build("bariq47/pipeline-docker:${BUILD_NUMBER}")
                }
            }
        }
        stage('Push Docker Image') {
            steps {
                script {
                    // Push the image to Docker Hub
                    docker.push("bariq47/pipeline-docker:${BUILD_NUMBER}")
                }
            }
        }
    }
}
