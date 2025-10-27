import express from 'express';
import { createDeviceService } from '../services/deviceService.js';
import { createStorageService } from '../services/storageService.js';

const router = express.Router();
router.use(express.json());
const deviceService = createDeviceService();
const storageService = createStorageService();

function ensureAuthenticated(req, res, next) {
  if (req.isAuthenticated()) {
    return next();
  }
  res.status(401).json({ message: 'Authentication required' });
}

router.get('/devices', ensureAuthenticated, async (req, res, next) => {
  try {
    const devices = await deviceService.listDevices(req.user.id, req.query);
    res.json(devices);
  } catch (error) {
    next(error);
  }
});

router.post('/devices/:id/toggle', ensureAuthenticated, async (req, res, next) => {
  try {
    const result = await deviceService.toggleDevice(req.params.id);
    res.json(result);
  } catch (error) {
    next(error);
  }
});

router.get('/integrations', ensureAuthenticated, async (req, res, next) => {
  try {
    const integrations = await deviceService.listIntegrations(req.user.id);
    res.json(integrations);
  } catch (error) {
    next(error);
  }
});

router.post('/integrations', ensureAuthenticated, async (req, res, next) => {
  try {
    const integration = await deviceService.upsertIntegration(req.user.id, req.body);
    res.status(201).json(integration);
  } catch (error) {
    if (error.message?.startsWith('Unsupported provider')) {
      res.status(400).json({ message: error.message });
      return;
    }
    if (error.name === 'SequelizeUniqueConstraintError') {
      res.status(409).json({ message: 'Integration already exists' });
      return;
    }
    next(error);
  }
});

router.delete('/integrations/:id', ensureAuthenticated, async (req, res, next) => {
  try {
    const deleted = await deviceService.deleteIntegration(req.user.id, req.params.id);
    if (!deleted) {
      res.status(404).json({ message: 'Integration not found' });
      return;
    }
    res.status(204).send();
  } catch (error) {
    next(error);
  }
});

router.post(
  '/integrations/:id/devices/sync',
  ensureAuthenticated,
  async (req, res, next) => {
    try {
      const { provider, devices = [] } = req.body;
      if (!provider) {
        res.status(400).json({ message: 'provider is required to sync devices' });
        return;
      }
      const results = await deviceService.syncIntegrationDevices(
        req.user.id,
        req.params.id,
        provider,
        devices
      );
      res.json({ devices: results });
    } catch (error) {
      if (error.message?.startsWith('Unsupported provider')) {
        res.status(400).json({ message: error.message });
        return;
      }
      if (error.message === 'Integration not found') {
        res.status(404).json({ message: error.message });
        return;
      }
      if (error.message?.startsWith('Integration provider mismatch')) {
        res.status(409).json({ message: error.message });
        return;
      }
      next(error);
    }
  }
);

router.get('/media', ensureAuthenticated, async (req, res, next) => {
  try {
    const media = await storageService.listMedia();
    res.json(media);
  } catch (error) {
    next(error);
  }
});

export function registerDeviceRoutes(app) {
  app.use('/api', router);
}
