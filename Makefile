all: run

run:
	cp env.example .env
	docker-compose up -d

migrate:
	docker exec api_balance php yii migrate/up --interactive=0

stop:
	docker-compose down
