import axios from 'axios';
import { User } from '../models/User';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/',
});

const API_URL = 'http://localhost:8000/api/users';

const delay = (ms: number) => new Promise((resolve) => setTimeout(resolve, ms));

let users: User[] = [
  { name: 'Thomas Zadikian' },
  { name: 'Maiekod Enterprise' },
  { name: 'Fake User Stop Here' },
];

export const userApi = {
  async getUsers(): Promise<User[]> {
    try {
      const response = await axiosInstance.get('api/users');
      const responseTexte = response.data;

      if (Array.isArray(response.data)) {
        return response.data;
      }

      if (typeof responseTexte === 'string') {
        const jsonMatch = responseTexte.match(/\[.*\]/);
        if (jsonMatch) {
          return JSON.parse(jsonMatch[0]);
        }
      }
      throw new Error('Invalid response format');
    } catch (error) {
      console.error('Error fetching users:', error);
      throw error;
    }
  },

  async addUser(name: string): Promise<User> {
    try {
      const response = await axiosInstance.post('api/users', { name });
      return response.data;
    } catch (error) {
      console.error('Error adding user:', error);
      throw error;
    }
  },
};
