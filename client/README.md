# Country Flags CLIENT

- Vue.js v3.x

# Requirements

- Stable version of [Docker](https://docs.docker.com/engine/install/)
- Compatible version of [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

# Installation

Hardcoded environment variables in `.env` file for convenience
- `docker compose up -d`
- `docker-compose exec node npm ci`


# Development
- `docker-compose exec node npm run dev`
- URL: http://localhost:4040

# Production
- `docker-compose exec node npm run build`
- URL: http://localhost

