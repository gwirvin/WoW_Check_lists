import express from 'express';
import session from 'express-session';
import morgan from 'morgan';
import passport from 'passport';
import { Strategy as BnetStrategy } from 'passport-bnet';
import { config } from './config.js';
import { createUserService } from './services/userService.js';
import { registerAuthRoutes } from './routes/auth.js';
import { registerDeviceRoutes } from './routes/devices.js';
import { registerCharacterRoutes } from './routes/characters.js';
import { syncDatabase } from './db/index.js';

const app = express();
const userService = createUserService();

passport.serializeUser((user, done) => {
  done(null, user.id);
});

passport.deserializeUser(async (id, done) => {
  try {
    const user = await userService.findById(id);
    done(null, user);
  } catch (error) {
    done(error);
  }
});

passport.use(
  new BnetStrategy(
    {
      clientID: config.bnet.clientID,
      clientSecret: config.bnet.clientSecret,
      callbackURL: config.bnet.callbackURL,
      region: config.bnet.region,
      scope: config.bnet.scope
    },
    async (accessToken, refreshToken, profile, done) => {
      try {
        const user = await userService.findOrCreateFromBnet(profile, {
          accessToken,
          refreshToken
        });
        done(null, user);
      } catch (error) {
        done(error);
      }
    }
  )
);

app.use(morgan('dev'));
app.use(express.json());
app.use(
  session({
    secret: config.sessionSecret,
    resave: false,
    saveUninitialized: false,
    cookie: {
      sameSite: 'lax',
      secure: false
    }
  })
);
app.use(passport.initialize());
app.use(passport.session());

registerAuthRoutes(app, passport, userService);
registerDeviceRoutes(app);
registerCharacterRoutes(app);

app.get('/healthz', (req, res) => {
  res.json({ status: 'ok', service: 'auth', region: config.bnet.region });
});

async function start() {
  await syncDatabase();
  app.listen(config.port, () => {
    console.log(`Auth service listening on port ${config.port}`);
  });
}

start().catch((error) => {
  console.error('Failed to start auth service', error);
  process.exit(1);
});
