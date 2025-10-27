# WoW Auth Service

This service replaces the legacy PHP login with a Node.js authentication microservice capable of Battle.net OAuth and local network integrations.

## Features
- Battle.net OAuth using `passport-bnet`.
- Session management backed by Express sessions.
- Postgres persistence for both OAuth users and local accounts through Sequelize, including WoW character rosters and smart device registries for Hue, SmartThings, Cync, and Amazon Alexa integrations.
- Z-Wave/Zigbee bridge via HTTP gateway adapters.
- CIFS/NAS media discovery via SMB.
- Health check endpoint at `/healthz`.

## Environment Variables
The service consumes the variables defined in [.env.example](./.env.example). Copy the file to `.env` and adjust values for your environment before running locally.

## Local Development
```bash
cd services/auth
npm install
npm run dev
```

The dev server runs on port `3000` by default.

## API Highlights

All API routes require an authenticated session (Battle.net OAuth or local credentials).

- `GET /api/wow/characters`: List the characters registered by the current user.
- `POST /api/wow/characters`: Create or update a character entry using `realmSlug`, `characterName`, and optional `summary` payload from the Blizzard API.
- `DELETE /api/wow/characters/:id`: Remove a toon from the user's roster.
- `GET /api/integrations`: View Hue, SmartThings, Cync, and Amazon integrations configured for the user along with their remote-access capability flags.
- `POST /api/integrations`: Upsert integration connection details (bridge IPs, tokens, remote access settings, etc.).
- `POST /api/integrations/:id/devices/sync`: Store device metadata discovered from a provider's API.
- `GET /api/devices`: Combine live Z-Wave/Zigbee discovery with stored provider devices.

## Container Build
```bash
docker build -t wow-auth-service:local services/auth
```

## Database
The service expects a Postgres database reachable via `DATABASE_URL`. Sequelize automatically migrates the schema on boot to maintain the following tables:

- `users`: Core account directory storing Battle.net profiles, optional local credentials, and OAuth tokens.
- `wow_characters`: Characters keyed by `userId`, `region`, `realmSlug`, and `characterName` for per-user toon rosters.
- `device_integrations`: Connection metadata and credentials for Hue, SmartThings, Cync, and Amazon controllers, plus a boolean flag describing whether the provider allows cloud-mediated remote access.
- `smart_devices`: Individual device records linked to integrations, capturing capabilities, location, reachability state, and provider (`hue`, `smartthings`, `cync`, `amazon`, `zwave`, or `zigbee`).

The schema evolves with `sync({ alter: true })` to preserve data across deployments while applying incremental changes.
