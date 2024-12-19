pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "bariq47/test-pipeline:${BUILD_NUMBER}" // Nama image Docker
		// DOCKER_USERNAME = credentials("docker-credential") // Masukkan username Docker Hub secara manual
        // DOCKER_PASSWORD = credentials("docker-credential")  // Masukkan password Docker Hub secara manual
        DISCORD_WEBHOOK = credentials("discrod-webhook-id") // ID Webhook dari Jenkins credentials
    }

    stages {
        stage('Clone Repository') {
            steps {
                // Clone kode sumber dari GitHub
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                // Build Docker image
                script {
                    bat "docker build -t ${DOCKER_IMAGE} ."
                }
            }
        }

        stage('push Docker Image') {
            steps {
                // Login ke Docker Hub dan pubat image
                withCredentials([usernamePassword(credentialsId: 'docker-credential', usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]){
                    bat """
                    echo "${DOCKER_PASSWORD}" | docker login -u "${DOCKER_USERNAME}" --password-stdin
                    docker push ${DOCKER_IMAGE}
                    """
                }
            }
        }

        stage('Notify Discord') {
            steps {
                // Kirim notifikasi ke Discord
                script {
                    def message = [
                        "content": "Pipeline succeeded! 🚀",
                        "embeds": [
                            [
                                "title": "Docker Image Built and Pubated",
                                "description": "Image `${DOCKER_IMAGE}` has been pubated to Docker Hub.",
                                "color": 3066993 // Warna hijau
                            ]
                        ]
                    ]
                    httpRequest(
                        httpMode: 'POST',
                        acceptType: 'APPLICATION_JSON',
                        contentType: 'APPLICATION_JSON',
                        requestBody: groovy.json.JsonOutput.toJson(message),
                        url: DISCORD_WEBHOOK
                    )
                }
            }
        }
    }

    post {
        failure {
            // Kirim notifikasi kegagalan ke Discord
            script {
                def message = [
                    "content": "Pipeline failed! ❌",
                    "embeds": [
                        [
                            "title": "Pipeline Error",
                            "description": "There was an issue during the pipeline.",
                            "color": 15158332 // Warna merah
                        ]
                    ]
                ]
                httpRequest(
                    httpMode: 'POST',
                    acceptType: 'APPLICATION_JSON',
                    contentType: 'APPLICATION_JSON',
                    requestBody: groovy.json.JsonOutput.toJson(message),
                    url: DISCORD_WEBHOOK
                )
            }
        }
    }
}
