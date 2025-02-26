import axios from 'axios';
import { User } from '@/models/User';

const API_URL = 'http://127.0.0.1:8000/api/users';

export const userApi = {
  async getUsers(): Promise<User[]> {
    const response = await axios.get(API_URL);
    return response.data;
  },

  async createUser(name: string): Promise<User> {
    const response = await axios.post(API_URL, { name });
    return response.data;
  },
};
