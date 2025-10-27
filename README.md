# WoW_Check_lists

A place to hold the structure of my WoW personal project. The stack is being migrated from PHP to a microservice-oriented Node.js deployment designed for Kubernetes.

## Services

- **Auth Service** (`services/auth/`): Node.js Express application that provides Battle.net OAuth login, optional local credential authentication, a persistent Postgres-backed user directory, and bridge endpoints for on-prem Z-Wave/Zigbee gateways alongside Hue, SmartThings, Cync, and Amazon (Alexa) device registries. The service exposes `/auth/*` endpoints, `/api/devices`/`/api/integrations` management APIs, and `/api/wow/characters` for toon tracking once a user is authenticated. Integrations can record whether each vendor supports remote access so you can capture which clouds will proxy control traffic off your LAN.

## Kubernetes Manifests

Initial manifests for the authentication workflow live under [`k8s/`](./k8s):

- `auth-deployment.yaml` & `auth-secret.yaml`: Deploy the login service with the necessary credentials.
- `postgres-statefulset.yaml` & `postgres-secret.yaml`: Provision a Postgres database that backs the authentication service.

These manifests assume a namespace named `wow-checklists` and can be applied with `kubectl apply -f k8s/` once secrets are tailored to your environment.
