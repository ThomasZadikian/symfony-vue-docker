import { defineStore } from 'pinia';
import { User } from '@/models/User';
import { userUseCase } from '@/useCases/UserUseCase';

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as User[],
  }),

  actions: {
    async loadUsers() {
      this.users = await userUseCase.fetchUsers();
    },

    async addUser(name: string) {
      const newUser = await userUseCase.addUser(name);
      this.users.push(newUser);
    },
  },
});
