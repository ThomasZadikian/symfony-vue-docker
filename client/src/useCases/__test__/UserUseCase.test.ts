import { describe, it, expect, vi } from 'vitest';
import { userUseCase } from '../UserUseCase';
import { userApi } from '@/services/userApi';
import { User } from '@/models/User';

vi.mock('@/services/userApi');

describe('UserUseCase', () => {
  it('fetchUsers should return a list of users', async () => {
    const mockUsers: User[] = [{ id: 1, name: 'John Doe' }];
    (userApi.getUsers as any).mockResolvedValue(mockUsers);

    const users = await userUseCase.fetchUsers();

    expect(users).toEqual(mockUsers);
    expect(userApi.getUsers).toHaveBeenCalled();
  });

  it('addUser should add a new user and return it', async () => {
    const mockUser: User = { id: 1, name: 'John Doe' };
    (userApi.createUser as any).mockResolvedValue(mockUser);

    const user = await userUseCase.addUser('John Doe');

    expect(user).toEqual(mockUser);
    expect(userApi.createUser).toHaveBeenCalledWith('John Doe');
  });
});
