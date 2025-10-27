import axios from 'axios';
import { config } from '../config.js';
import { createIntegrationService } from './integrationService.js';

function createGatewayClient(baseURL) {
  const client = axios.create({
    baseURL,
    timeout: 5000
  });

  return {
    async listDevices() {
      const { data } = await client.get('/devices');
      return data;
    },
    async toggleDevice(id) {
      const { data } = await client.post(`/devices/${id}/toggle`);
      return data;
    }
  };
}

export function createDeviceService() {
  const zwave = createGatewayClient(config.network.zwaveGateway);
  const zigbee = createGatewayClient(config.network.zigbeeGateway);
  const integrationService = createIntegrationService();

  return {
    async listDevices(userId, filters = {}) {
      const [zwaveDevices, zigbeeDevices, storedDevices] = await Promise.all([
        zwave.listDevices().catch(() => []),
        zigbee.listDevices().catch(() => []),
        integrationService.listDevices(userId, filters)
      ]);
      return {
        zwave: zwaveDevices,
        zigbee: zigbeeDevices,
        stored: storedDevices
      };
    },
    async toggleDevice(id) {
      const [protocol, deviceId] = id.split(':');
      const client = protocol === 'zwave' ? zwave : zigbee;
      return client.toggleDevice(deviceId);
    },
    async syncIntegrationDevices(userId, integrationId, provider, devices) {
      return integrationService.upsertDevices(userId, integrationId, provider, devices);
    },
    async listIntegrations(userId) {
      return integrationService.listIntegrations(userId);
    },
    async upsertIntegration(userId, payload) {
      return integrationService.upsertIntegration(userId, payload);
    },
    async deleteIntegration(userId, integrationId) {
      return integrationService.deleteIntegration(userId, integrationId);
    }
  };
}
