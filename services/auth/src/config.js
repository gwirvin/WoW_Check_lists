import 'dotenv/config';

export const config = {
  port: process.env.PORT || 3000,
  sessionSecret: process.env.SESSION_SECRET || 'change-this-secret',
  bnet: {
    clientID: process.env.BNET_CLIENT_ID || '',
    clientSecret: process.env.BNET_CLIENT_SECRET || '',
    callbackURL: process.env.BNET_CALLBACK_URL || 'http://localhost:3000/auth/bnet/callback',
    region: process.env.BNET_REGION || 'us',
    scope: (process.env.BNET_SCOPE || 'wow.profile account').split(' ')
  },
  database: {
    url: process.env.DATABASE_URL || 'postgres://wow_auth:wow_auth@db:5432/wow_auth',
    logging: process.env.DATABASE_LOGGING === 'true'
  },
  network: {
    zwaveGateway: process.env.ZWAVE_GATEWAY || 'http://zwave-gateway.local',
    zigbeeGateway: process.env.ZIGBEE_GATEWAY || 'http://zigbee-gateway.local',
    cifs: {
      host: process.env.CIFS_HOST || 'nas.local',
      share: process.env.CIFS_SHARE || 'wow-media',
      username: process.env.CIFS_USERNAME || '',
      password: process.env.CIFS_PASSWORD || ''
    }
  }
};
