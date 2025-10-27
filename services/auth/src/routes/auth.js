import express from 'express';
import { config } from '../config.js';

export function registerAuthRoutes(app, passport, userService) {
  app.get('/auth/bnet', passport.authenticate('bnet'));

  app.get(
    '/auth/bnet/callback',
    passport.authenticate('bnet', {
      failureRedirect: '/auth/failure'
    }),
    (req, res) => {
      res.json({
        message: 'Battle.net authentication successful',
        profile: req.user.profile,
        accessToken: req.user.tokens.accessToken
      });
    }
  );

  app.get('/auth/failure', (req, res) => {
    res.status(401).json({ message: 'Authentication failed' });
  });

  app.post('/auth/logout', (req, res) => {
    req.logout(() => {
      req.session.destroy(() => {
        res.json({ message: 'Logged out' });
      });
    });
  });

  app.get('/auth/session', (req, res) => {
    if (!req.user) {
      return res.status(401).json({ message: 'Not authenticated' });
    }

    res.json({
      user: req.user.profile,
      tokens: config.bnet.scope.includes('wow.profile') ? req.user.tokens : undefined
    });
  });

  app.post('/auth/local', express.json(), async (req, res) => {
    const { username, password } = req.body;

    try {
      const user = await userService.authenticateLocal(username, password);
      if (!user) {
        return res.status(401).json({ message: 'Invalid credentials' });
      }
      req.login(user, (err) => {
        if (err) {
          return res.status(500).json({ message: 'Unable to create session' });
        }
        res.json({ message: 'Local authentication successful', user: user.profile });
      });
    } catch (error) {
      res.status(500).json({ message: 'Local authentication failed', error: error.message });
    }
  });

  app.post('/auth/local/register', express.json(), async (req, res) => {
    const { username, email, password } = req.body;

    try {
      const user = await userService.registerLocalUser({ username, email, password });
      res.status(201).json({ message: 'User registered', user });
    } catch (error) {
      if (error.message === 'username and password are required') {
        res.status(400).json({ message: error.message });
        return;
      }
      if (error.name === 'SequelizeUniqueConstraintError') {
        res.status(409).json({
          message: 'User already exists',
          details: error.errors?.map((err) => err.message)
        });
        return;
      }
      res.status(500).json({ message: 'Registration failed', error: error.message });
    }
  });
}
