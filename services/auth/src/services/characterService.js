import { getModels } from '../db/index.js';

export function createCharacterService() {
  const { WowCharacter } = getModels();

  return {
    async listForUser(userId) {
      const characters = await WowCharacter.findAll({ where: { userId } });
      return characters.map((character) => character.toJSON());
    },
    async upsertCharacter(userId, payload) {
      const { region = 'us', realmSlug, characterName, summary } = payload;
      if (!realmSlug || !characterName) {
        throw new Error('realmSlug and characterName are required');
      }
      const [character] = await WowCharacter.findOrCreate({
        where: { userId, region, realmSlug, characterName },
        defaults: {
          summary,
          lastSyncedAt: summary?.lastModified ? new Date(summary.lastModified) : null
        }
      });

      if (summary) {
        character.summary = summary;
        character.lastSyncedAt = summary?.lastModified
          ? new Date(summary.lastModified)
          : new Date();
      } else if (!character.lastSyncedAt) {
        character.lastSyncedAt = new Date();
      }
      await character.save();
      return character.toJSON();
    },
    async removeCharacter(userId, characterId) {
      const deletedCount = await WowCharacter.destroy({
        where: { id: characterId, userId }
      });
      return deletedCount > 0;
    }
  };
}
