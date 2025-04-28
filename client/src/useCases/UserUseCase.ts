import { User } from '../models/User';
import { userApi } from '../services/userApi';

class UserUseCase {
  async fetchUsers(): Promise<User[]> {
    try {
      return await userApi.getUsers();
    } catch (error) {
      console.error('Error fetching users:', error);
      return [];
    }
  }

  async addUser(name: string): Promise<User> {
    if (!name || name.trim() === '') {
      throw new Error('User name cannot be empty');
    }

    try {
      const newUser = await userApi.addUser(name.trim());
      return newUser;
    } catch (error) {
      console.error('Error adding user:', error);
      throw error;
    }
  }
}

export const userUseCase = new UserUseCase();
