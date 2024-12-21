pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "bariq47/test-pipeline:${BUILD_NUMBER}"
		// DOCKER_USERNAME = credentials("docker-credential")
        // DOCKER_PASSWORD = credentials("docker-credential")
        DISCORD_WEBHOOK = credentials("discrod-webhook-id")
    }

    stages {
        stage('Clone Repository') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    bat "docker build -t ${DOCKER_IMAGE} ."
                }
            }
        }

        stage('push Docker Image') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'docker-credential',
                 usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]){
                    bat """
                    echo "${DOCKER_PASSWORD}" | docker login -u "${DOCKER_USERNAME}" --password-stdin
                    docker push ${DOCKER_IMAGE}
                    """
                }
            }
        }

        stage('test run container'){
            steps {
                script {
                    bat "docker run -d --name test-run-container ${DOCKER_IMAGE}"
                }

            }
        }

        stage('stop and remove container'){
            steps {
                script {
                    bat "docker stop test-run-container && docker test-run-container"
                }

            }
        }


        stage('Notify Discord') {
            steps {
                script {
                    def message = [
                        "content": "Pipeline berhasil",
                        "embeds": [
                            [
                                "title": "docker build dan push",
                                "description": "Image `${DOCKER_IMAGE}` berhasil di push",
                                "color": 3066993
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
            script {
                def message = [
                    "content": "Pipeline gagal",
                    "embeds": [
                        [
                            "title": "Pipeline gagal",
                            "description": "Tterdapat kesalahan",
                            "color": 15158332
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
