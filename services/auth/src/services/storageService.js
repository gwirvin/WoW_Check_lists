import SMB2 from 'smb2';
import { config } from '../config.js';

let smbClient;

function getClient() {
  if (!smbClient) {
    smbClient = new SMB2({
      share: `\\\\${config.network.cifs.host}\\${config.network.cifs.share}`,
      domain: process.env.CIFS_DOMAIN || undefined,
      username: config.network.cifs.username,
      password: config.network.cifs.password,
      autoCloseTimeout: 10000
    });
  }
  return smbClient;
}

export function createStorageService() {
  return {
    async listMedia(path = '/') {
      const client = getClient();
      return new Promise((resolve, reject) => {
        client.readdir(path, (err, files) => {
          if (err) {
            reject(err);
          } else {
            resolve(files.map((file) => ({ path: `${path}${file}` })));
          }
        });
      });
    }
  };
}
