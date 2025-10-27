import { Sequelize, DataTypes } from 'sequelize';
import { config } from '../config.js';

let sequelizeInstance;
let models;

function getSequelize() {
  if (!sequelizeInstance) {
    sequelizeInstance = new Sequelize(config.database.url, {
      logging: config.database.logging
    });
  }
  return sequelizeInstance;
}

function defineModels(connection) {
  const User = connection.define(
    'User',
    {
      id: {
        type: DataTypes.UUID,
        defaultValue: DataTypes.UUIDV4,
        primaryKey: true
      },
      bnetId: {
        type: DataTypes.STRING,
        unique: true
      },
      username: {
        type: DataTypes.STRING,
        unique: true
      },
      email: {
        type: DataTypes.STRING,
        unique: true
      },
      passwordHash: DataTypes.STRING,
      profile: DataTypes.JSONB,
      tokens: DataTypes.JSONB
    },
    {
      tableName: 'users',
      indexes: [
        { unique: true, fields: ['bnetId'] },
        { unique: true, fields: ['username'] },
        { unique: true, fields: ['email'] }
      ]
    }
  );

  const WowCharacter = connection.define(
    'WowCharacter',
    {
      id: {
        type: DataTypes.UUID,
        defaultValue: DataTypes.UUIDV4,
        primaryKey: true
      },
      userId: {
        type: DataTypes.UUID,
        allowNull: false
      },
      region: {
        type: DataTypes.STRING,
        allowNull: false,
        defaultValue: 'us'
      },
      realmSlug: {
        type: DataTypes.STRING,
        allowNull: false
      },
      characterName: {
        type: DataTypes.STRING,
        allowNull: false
      },
      summary: DataTypes.JSONB,
      lastSyncedAt: DataTypes.DATE
    },
    {
      tableName: 'wow_characters',
      indexes: [
        {
          unique: true,
          fields: ['userId', 'region', 'realmSlug', 'characterName']
        }
      ]
    }
  );

  const DeviceIntegration = connection.define(
    'DeviceIntegration',
    {
      id: {
        type: DataTypes.UUID,
        defaultValue: DataTypes.UUIDV4,
        primaryKey: true
      },
      userId: {
        type: DataTypes.UUID,
        allowNull: false
      },
      provider: {
        type: DataTypes.ENUM('hue', 'smartthings', 'cync', 'amazon'),
        allowNull: false
      },
      name: {
        type: DataTypes.STRING,
        allowNull: false
      },
      connectionInfo: {
        type: DataTypes.JSONB,
        allowNull: false,
        defaultValue: {}
      },
      credentials: DataTypes.JSONB,
      allowsRemoteAccess: {
        type: DataTypes.BOOLEAN,
        allowNull: false,
        defaultValue: false
      },
      lastValidatedAt: DataTypes.DATE
    },
    {
      tableName: 'device_integrations',
      indexes: [
        {
          unique: true,
          fields: ['userId', 'provider', 'name']
        }
      ]
    }
  );

  const SmartDevice = connection.define(
    'SmartDevice',
    {
      id: {
        type: DataTypes.UUID,
        defaultValue: DataTypes.UUIDV4,
        primaryKey: true
      },
      userId: {
        type: DataTypes.UUID,
        allowNull: false
      },
      integrationId: {
        type: DataTypes.UUID,
        allowNull: false
      },
      provider: {
        type: DataTypes.ENUM('hue', 'smartthings', 'cync', 'amazon', 'zwave', 'zigbee'),
        allowNull: false
      },
      externalId: {
        type: DataTypes.STRING,
        allowNull: false
      },
      displayName: DataTypes.STRING,
      location: DataTypes.STRING,
      type: DataTypes.STRING,
      capabilities: DataTypes.JSONB,
      metadata: DataTypes.JSONB,
      reachable: {
        type: DataTypes.BOOLEAN,
        defaultValue: true
      },
      lastSeenAt: DataTypes.DATE
    },
    {
      tableName: 'smart_devices',
      indexes: [
        {
          unique: true,
          fields: ['integrationId', 'externalId']
        }
      ]
    }
  );

  User.hasMany(WowCharacter, {
    foreignKey: 'userId',
    as: 'characters',
    onDelete: 'CASCADE'
  });
  WowCharacter.belongsTo(User, { foreignKey: 'userId', as: 'owner' });

  User.hasMany(DeviceIntegration, {
    foreignKey: 'userId',
    as: 'integrations',
    onDelete: 'CASCADE'
  });
  DeviceIntegration.belongsTo(User, { foreignKey: 'userId', as: 'owner' });

  DeviceIntegration.hasMany(SmartDevice, {
    foreignKey: 'integrationId',
    as: 'devices',
    onDelete: 'CASCADE'
  });
  SmartDevice.belongsTo(DeviceIntegration, {
    foreignKey: 'integrationId',
    as: 'integration'
  });
  SmartDevice.belongsTo(User, { foreignKey: 'userId', as: 'owner' });

  return { User, WowCharacter, DeviceIntegration, SmartDevice };
}

export function getModels() {
  if (!models) {
    const connection = getSequelize();
    models = defineModels(connection);
  }
  return models;
}

export async function syncDatabase() {
  const connection = getSequelize();
  getModels();
  if (connection.getDialect() === 'postgres') {
    const statements = [
      "DO $$ BEGIN IF NOT EXISTS (SELECT 1 FROM pg_type t JOIN pg_enum e ON t.oid = e.enumtypid WHERE t.typname = 'enum_device_integrations_provider' AND e.enumlabel = 'amazon') THEN ALTER TYPE \"enum_device_integrations_provider\" ADD VALUE 'amazon'; END IF; END $$;",
      "DO $$ BEGIN IF NOT EXISTS (SELECT 1 FROM pg_type t JOIN pg_enum e ON t.oid = e.enumtypid WHERE t.typname = 'enum_smart_devices_provider' AND e.enumlabel = 'amazon') THEN ALTER TYPE \"enum_smart_devices_provider\" ADD VALUE 'amazon'; END IF; END $$;"
    ];
    for (const statement of statements) {
      await connection.query(statement);
    }
  }
  await connection.sync({ alter: true });
  return { sequelize: connection, ...models };
}
