PROJECT_PATH=$(pwd)
APP_PATH=$(PROJECT_PATH)/project
BRANCH=master
DOCKER_FILE=docker-compose.yml
SUDO=

.PHONY: docker project

dev-install: git docker project

git: 
	git fetch -p && git add . && git stash && git checkout $(BRANCH) && git rebase
        
docker:
	cd $(PROJECT_PATH) && docker-compose down && docker-compose -f $(DOCKER_FILE) up -d


project:
	-docker exec -it $(APP_URL)-web composer install
	-cd $(APP_PATH) && $(SUDO) rm -rf var/cache/* && $(SUDO) rm -rf var/logs/* && $(SUDO) chmod -R 777 var





