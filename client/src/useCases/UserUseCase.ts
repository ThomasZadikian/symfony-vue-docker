import { userApi } from '@/services/userApi';
import { User } from '@/models/User';

export const userUseCase = {
  async fetchUsers(): Promise<User[]> {
    return await userApi.getUsers();
  },

  async addUser(name: string): Promise<User> {
    return await userApi.createUser(name);
  },
};
