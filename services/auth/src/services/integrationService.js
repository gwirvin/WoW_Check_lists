import { getModels } from '../db/index.js';

const PROVIDERS = ['hue', 'smartthings', 'cync', 'amazon'];

export function createIntegrationService() {
  const { DeviceIntegration, SmartDevice } = getModels();

  return {
    async listIntegrations(userId) {
      const integrations = await DeviceIntegration.findAll({
        where: { userId },
        include: [{ model: SmartDevice, as: 'devices' }],
        order: [['name', 'ASC']]
      });
      return integrations.map((integration) => integration.toJSON());
    },
    async upsertIntegration(userId, payload) {
      const {
        provider,
        name,
        connectionInfo = {},
        credentials = {},
        allowsRemoteAccess = false
      } = payload;
      if (!PROVIDERS.includes(provider)) {
        throw new Error(`Unsupported provider: ${provider}`);
      }
      const [integration] = await DeviceIntegration.findOrCreate({
        where: { userId, provider, name },
        defaults: { connectionInfo, credentials, allowsRemoteAccess }
      });
      integration.connectionInfo = connectionInfo;
      integration.credentials = credentials;
      integration.allowsRemoteAccess = Boolean(allowsRemoteAccess);
      integration.lastValidatedAt = new Date();
      await integration.save();
      return integration.toJSON();
    },
    async deleteIntegration(userId, integrationId) {
      const deleted = await DeviceIntegration.destroy({
        where: { id: integrationId, userId }
      });
      return deleted > 0;
    },
    async upsertDevices(userId, integrationId, provider, devices = []) {
      const integration = await DeviceIntegration.findOne({
        where: { id: integrationId, userId }
      });
      if (!integration) {
        throw new Error('Integration not found');
      }
      if (integration.provider !== provider) {
        throw new Error(`Integration provider mismatch. Expected ${integration.provider}`);
      }
      const results = [];
      for (const device of devices) {
        const {
          externalId,
          displayName,
          location,
          type,
          capabilities,
          metadata,
          reachable,
          lastSeenAt
        } = device;
        const [record] = await SmartDevice.findOrCreate({
          where: { integrationId, externalId },
          defaults: {
            userId,
            provider,
            displayName,
            location,
            type,
            capabilities,
            metadata,
            reachable,
            lastSeenAt
          }
        });
        record.userId = userId;
        record.provider = provider;
        record.displayName = displayName;
        record.location = location;
        record.type = type;
        record.capabilities = capabilities;
        record.metadata = metadata;
        if (reachable !== undefined) {
          record.reachable = reachable;
        }
        if (lastSeenAt) {
          record.lastSeenAt = new Date(lastSeenAt);
        }
        await record.save();
        results.push(record.toJSON());
      }
      return results;
    },
    async listDevices(userId, filters = {}) {
      const { provider } = filters;
      const where = { userId };
      if (provider) {
        where.provider = provider;
      }
      const devices = await SmartDevice.findAll({ where });
      return devices.map((device) => device.toJSON());
    }
  };
}
