import { describe, it, expect, vi } from 'vitest';
import axios from 'axios';
import { userApi } from '@/services/userApi';
import type { User } from '@/models/User';

vi.mock('axios');

describe('userApi Service', () => {
  describe('getUsers', () => {
    it('should fetch and return an array of users', async () => {
      const mockedUsers: User[] = [
        { id: 1, name: 'User One' },
        { id: 2, name: 'User Two' },
      ];
      (axios.get as any).mockResolvedValue({ data: mockedUsers });

      // Act
      const result = await userApi.getUsers();

      // Assert
      expect(result).toEqual(mockedUsers);
      expect(axios.get).toHaveBeenCalledWith('http://127.0.0.1:8000/api/users');
    });
  });

  describe('createUser', () => {
    it('should create a user and return the user data', async () => {
      const newUser: User = { id: 3, name: 'Alice' };
      (axios.post as any).mockResolvedValue({ data: newUser });

      // Act
      const result = await userApi.createUser('Alice');

      // Assert
      expect(result).toEqual(newUser);
      expect(axios.post).toHaveBeenCalledWith('http://127.0.0.1:8000/api/users', { name: 'Alice' });
    });
  });
});
