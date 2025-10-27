import bcrypt from 'bcryptjs';
import { getModels } from '../db/index.js';

const SALT_ROUNDS = 12;

export function createUserService() {
  const { User, WowCharacter } = getModels();

  function sanitizeUser(user) {
    if (!user) {
      return null;
    }
    const data = user.toJSON ? user.toJSON() : user;
    const { passwordHash, ...safe } = data;
    return safe;
  }

  return {
    async findById(id) {
      const user = await User.findByPk(id);
      return sanitizeUser(user);
    },
    async findOrCreateFromBnet(profile, tokens) {
      const [user] = await User.findOrCreate({
        where: { bnetId: profile.id },
        defaults: {
          profile,
          tokens
        }
      });

      user.profile = profile;
      user.tokens = tokens;
      await user.save();
      return sanitizeUser(user);
    },
    async authenticateLocal(username, password) {
      const user = await User.findOne({ where: { username } });
      if (!user || !user.passwordHash) {
        return null;
      }
      const valid = await bcrypt.compare(password, user.passwordHash);
      return valid ? sanitizeUser(user) : null;
    },
    async registerLocalUser({ username, email, password }) {
      if (!username || !password) {
        throw new Error('username and password are required');
      }
      const passwordHash = await bcrypt.hash(password, SALT_ROUNDS);
      const profile = { username, email };
      const user = await User.create({ username, email, passwordHash, profile });
      return sanitizeUser(user);
    },
    async listCharactersForUser(userId) {
      const characters = await WowCharacter.findAll({ where: { userId } });
      return characters.map((character) => character.toJSON());
    }
  };
}
