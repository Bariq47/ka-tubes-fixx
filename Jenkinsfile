pipeline {
    agent any

    environment {
        DOCKER_CREDENTIALS = credentials('dockerhub-credentials-id')
        DOCKER_IMAGE = 'bariq47/pipeline-docker:latest'
    }

    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    bat "docker build -t ${DOCKER_IMAGE} ."
                }
            }
        }

        stage('Docker Login') {
            steps {
                script {
                    // Login ke DockerHub
                    bat "echo ${DOCKER_CREDENTIALS_PSW} | docker login -u ${DOCKER_CREDENTIALS_USR} --password-stdin"
                }
            }
        }

        stage('Push to DockerHub') {
            steps {
                script {
                    bat "docker push ${DOCKER_IMAGE}"
                }
            }
        }
    }
}
