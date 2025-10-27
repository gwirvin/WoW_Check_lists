import express from 'express';
import { createCharacterService } from '../services/characterService.js';

const router = express.Router();
router.use(express.json());
const characterService = createCharacterService();

function ensureAuthenticated(req, res, next) {
  if (req.isAuthenticated()) {
    return next();
  }
  res.status(401).json({ message: 'Authentication required' });
}

router.get('/', ensureAuthenticated, async (req, res, next) => {
  try {
    const characters = await characterService.listForUser(req.user.id);
    res.json(characters);
  } catch (error) {
    next(error);
  }
});

router.post('/', ensureAuthenticated, async (req, res, next) => {
  try {
    const character = await characterService.upsertCharacter(req.user.id, req.body);
    res.status(201).json(character);
  } catch (error) {
    next(error);
  }
});

router.delete('/:id', ensureAuthenticated, async (req, res, next) => {
  try {
    const removed = await characterService.removeCharacter(req.user.id, req.params.id);
    if (!removed) {
      res.status(404).json({ message: 'Character not found' });
      return;
    }
    res.status(204).send();
  } catch (error) {
    next(error);
  }
});

export function registerCharacterRoutes(app) {
  app.use('/api/wow/characters', router);
}
